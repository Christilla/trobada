<?php

/**
 * 
 * La classe MY_Controller sert de conteneur pour les developpeurs souhaitant beneficier
 * d'un cadre de developpement de la couche "active".
 * Le fonctionnement est que le client web utilise le protocole http 
 * pour executer la bonne methode du contrôleur.
 * Le contrôleur effectue le traitement et si besoin, s'appuie sur le dao.
 * à la fin du traitement le contrôleur retourne la réponse au client.
 *
 * @author Padbrain
 */
class MY_Controller extends CI_Controller {

    /**
	 * ##	Cette classe hérite de la classe CI_Controller
     * Le constructeur sera invoqué a la création des objets heritant de cette classe
     * il récupère le jwt du client
     * et initialise le profil de l'utilisateur
     *
     * 
     */
	/**
	 * Verify if a token is set
	 *
	 * if it is, init member retrieving him in BDD
	 * querying by token content
	 */

    public function __construct() {
    	parent::__construct();
    	/*
    	 * Session library is autoLoaded
    	 * Member_model library is autoLoaded
         * views_rights config is autoLoaded
    	 * Url helper if autoloaded
    	 */


		/*
         * First thing is loading security library
		 * And verifying if a cookie was previously set
		 * If it was, $acceptConnexion variable contains user's pseudo and role,
		 * Else $acceptConnexion receives null value.
         */
		$this->load->library('securityMiddleware', null, 'securityByTkn');
		/* $this->securityByTkn->deactivate(); */
		$acceptConnexion = $this->securityByTkn->acceptConnexion();
		/*
		 * Retrieving necessary rights for the requested uri
		 * defined in application/config/views_rights.php file
         */
		$aRights = $this->_match_uri_from_config();

		if($aRights === false){
			show_404();
//			redirect('errors/_404', 'location');
		}else{
//			continue;
		}

		/*
		 * Let's have a look if the surfer have the goods rights
		 * to display the requested uri
		 */
		if(! $acceptConnexion){
			/* $this->securityByTkn->generateToken($_SESSION['oMember']); */
			//	The surfer isn't logged
			//	Let's see if ALL surfer are authorized to display the requested uri
			if(array_key_exists('ALL', $aRights) && $aRights['ALL'] === true){
				//	continue
			}else{
				//	The surfer try to access non authorised uri without connection
				show_404();
			}
		}else{
			/*
			 * The surfer have a valid token
			 * Retrieving user profile in bdd
			 * and init session with member profile
			 */
			$oMember = $this->members_model->retrieveMemberProfile(array($acceptConnexion->username));
			if(!is_null($oMember)){
				$this->_initSession($oMember);
			}else{
				
				$this->session->set_flashdata('login_error', "<p class='error'>Vos identifiants de connexion ne sont pas corrects !</p>");
				/* show_404(); */
			}
//			$this->_initSession($this->members_model->retrieveMemberProfile(array($acceptConnexion->username)));

			/*
			 * 		Checking if user right matches with one needed to display the view
			 * 		or if everyone is authorized to display uri
			 */
			if(array_key_exists($this->session->userdata('oMember')->role, $aRights) && $aRights[$this->session->userdata('oMember')->role] === true
				||
				array_key_exists('ALL', $aRights) && $aRights['ALL'] === true){
				//	continue
			}else{
				//	The surfer try to access non authorised uri
				show_404();
//				redirect('errors/_404', 'location');
			}
		}
    }

	protected function _initSession($oMember = null){
		if(! is_null($oMember)){
			$this->session->set_userdata('oMember', $oMember);
			return;
		}

	}

	protected function _match_uri_from_config(){

    	//	Routes for rigths views set in application/config/views_rights.php
    	$routes = $this->config->config['views_rights'];

		//	Requested URI
		$uri = uri_string();

		// Loop through the routes array looking for wildcards
		foreach ($routes as $key => $val)
		{
			// Convert wildcards to RegEx
			$key = str_replace(array(':any', ':num'), array('[^/]+', '[0-9]+'), $key);

			// Does the RegEx match?
			if (preg_match('#^'.$key.'$#', $uri, $matches))
			{
				//	A wildcard was found
				// Convert wildcard to views_rights format
				$key = str_replace( array('[^/]+', '[0-9]+'), array(':any', ':num'), $key);

				//	Return an array of the wildcard user rights
//				var_dump($routes[$key]);
				return $routes[$key];
			}
		}

		//	No wildcard found
		return false;
	}
}
