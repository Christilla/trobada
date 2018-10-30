<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grocery_admin extends MY_Controller {

    public function __construct()
	{
        parent::__construct();
        
        $this->load->database();
        $this->load->helper('url');
        
        $this->load->library('grocery_CRUD');
        $this->config->load('grocery_crud');
    }
 

    public function partners(){

        $datas['title'] = 'Gestion des partenaires';

		$crud = new grocery_CRUD();
		$crud->set_subject('Partenaire');

        $crud->set_table('partners');
        $crud->set_relation('partners_categories_id','partners_categories','name_categories');

        $crud->columns('name','description','partners_categories_id');
        $crud->display_as('name','Nom')
			 ->display_as('partners_categories_id','Catégories');

		$crud->fields('name','description','logo_location','site_url','partners_categories_id'); 
		
		/* $crud->field_type('logo_location', 'text');
		$crud->unset_texteditor('logo_location','full_text'); */
       
       
        $output = $crud->render();
		$datas['css_files'] = $output->css_files;

        $this->load->view('templates/header_member', $datas);
        $this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $datas);
        $this->load->view('members/adm/partners-management',$output);
		$this->load->view('templates/footer_member', $datas);
    }
 

    public function categories_partners(){

        $datas['title'] = 'Gestions des catégories partenaires';

		$crud = new grocery_CRUD();
        $crud->set_subject('Catégories partenaires');
        $crud->set_table('partners_categories');
        

        $crud->columns('name_categories');
        $crud->display_as('name_categories','Catégories');
        $crud->fields('name_categories');

        $output = $crud->render();
		$datas['css_files'] = $output->css_files;
		$datas['message'] = "	<p class='notification is-warning'>
									Avant de supprimer une catégorie, vous devez vous assurer qu'aucun
									partenaire ne lui est lié.
								</p>";

        $this->load->view('templates/header_member', $datas);
        $this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $datas);
        $this->load->view('members/adm/categories-partners-management',$output);
        $this->load->view('templates/footer_member', $datas);
    }



    public function members() {
        /* var_dump($this->session->userdata()); */

        $datas['title'] = 'Liste des membres';

		$crud = new grocery_CRUD();

        $crud->set_subject('membre');
        $crud->set_table('users');
        $crud->set_relation('roles_id','roles','long_name');
 
        $crud->columns('pseudo','email','firstname','lastname','address','post_code','town','roles_id','company_name');
        $crud->fields('pseudo','email','password','firstname','lastname','address','post_code','town','roles_id','company_name');
        $crud->display_as('firstname','Prénom')
                ->display_as('lastname','Nom')
                ->display_as('post_code','Code Postal')
                ->display_as('town','Ville')
                ->display_as('address','Adresse')
				->display_as('roles_id','Role')
				->display_as('company_name','Entreprise');

        $crud->field_type('password', 'hidden', 'password'); /**Pour cacher le champ password de read */

        $crud->unset_add(); /* Pour enlever la méthode ADD */
		$crud->unset_clone();
        $crud->unset_delete(); 

        $output = $crud->render();
        $datas['css_files'] = $output->css_files;

        $this->load->view('templates/header_member', $datas);
        $this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $datas);
        $this->load->view('members/adm/members-management',$output);
		$this->load->view('templates/footer_member', $datas);

     }

	public function product_management(){
		
		//	page Title
		$datas['title'] = "Gestion de mes produits";

		$crud = new grocery_CRUD();


		$crud->set_subject('Produits');
		$crud->set_table('products'); 
        $crud->where('users_id', $this->session->userdata('oMember')->id);


		$crud->columns('name','description','price');
		$crud->display_as('name','Nom du produit')
			 ->display_as('price','Prix');

		$crud->fields('name','description','price','users_id');

		$crud->unset_delete(); /* Désactive la méthode delete */
		
		$crud->field_type('users_id','hidden', $this->session->userdata('oMember')->id);

		$output = $crud->render();
		$datas['css_files'] = $output->css_files;
	
		$this->load->view('templates/header_member', $datas);
		$this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $datas);
		$this->load->view('members/com/products_management', $output);
		$this->load->view('templates/footer_member', $datas);
	}

	public function events(){
		$datas['title'] = 'Liste des évènements';

		$crud = new grocery_CRUD();

		$crud->set_subject('Évènements');
		$crud->set_table('events');

		$crud->set_relation('users_id','users','{company_name} - {lastname} {firstname}');

		$crud->columns('title', 'description', 'users_id');
		$crud->fields('title', 'description','users_id');
		$crud->display_as('title', 'Évènement');
		$crud->display_as('users_id', 'Organisateur');

		//	inhiber la suppression
		if($crud->callback_before_delete(array($this, 'is_deletable')) !== false){
			$output = $crud->render();
		}else{
			$datas['deletion_aborted'] = "<p class='notification is-danger'>Vous ne pouvez pas supprimer cet évènement</p>";
			redirect('events-management');
		}

//        $crud->set_relation('users_id','users','id');

		$crud->columns('title','description');
		$crud->fields('title','description','users_id'); 

		 /* $crud->unset_texteditor('description','full_text');  */
		 
        $crud->unset_delete(); 
        $crud->unset_clone();

		$datas['css_files'] = $output->css_files;

		$this->load->view('templates/header_member', $datas);
		$this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $datas);
		$this->load->view('members/adm/events-management',$output);

		$this->load->view('templates/footer_member', $datas);
	}

	private function is_deletable(){
    	return false;
	}
    
    public function events_places(){
//		$state = $this->grocery_crud->getState();
//		var_dump($this->grocery_crud->getState());

        $datas['title'] = 'Liste des lieux et dates des festivals';

       
		$crud = new grocery_CRUD();

		$crud->set_subject('dates et lieux');
		$crud->set_table('events_places');
        $crud->set_relation('events_id','events','{title}');

		$crud	->columns('events_id', 'place', 'starting_date', 'ending_date')
				->display_as('place', 'Lieu de l\'évènement')
				->display_as('starting_date', 'Date de début')
				->display_as('ending_date', 'Date de fin')
				->display_as('events_id', 'Évènement');
	    $crud->fields('place', 'starting_date', 'ending_date', 'events_id');
//		$crud->field_type('events_id','hidden','events_id');


		$output = $crud->render();
		$datas['css_files'] = $output->css_files;
		if($this->grocery_crud->getState() == 'list'){
			$datas['message'] = "	<p class='notification is-warning'>
										Une date d'évènement ne pourra pas être supprimée 
										si des transactions existent pour cette dernière.
									</p>";
		}else{
			$datas['message'] = "";
		}
//		var_dump($datas);

        $this->load->view('templates/header_member', $datas);
		$this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $datas);
		$this->load->view('members/adm/events_places-management',$output);

		$this->load->view('templates/footer_member', $datas);


    }
}
