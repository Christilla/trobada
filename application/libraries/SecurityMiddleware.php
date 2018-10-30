<?php defined('BASEPATH') OR exit('No direct script access allowed');

//require_once 'application/third_party/jwt/src/BeforeValidException.php';
//require_once 'application/third_party/jwt/src/ExpiredException.php';
//require_once 'application/third_party/jwt/src/SignatureInvalidException.php';
//require_once 'application/third_party/jwt/src/JWT.php';

require_once 'BeforeValidException.php';
require_once 'ExpiredException.php';
require_once 'SignatureInvalidException.php';
require_once 'JWT.php';

/**
 * Le security middleware permet de s'occuper de l'identification du client
 * il s'appuie sur le JWT lors de la connexion pour faire transiter le token
 * avec les cookies.
 * 
 * Il propose la configuration par defaut (intégré dans le controlleur)
 * 
 * 
 *
 * @author loic
 */
class SecurityMiddleware {

    /**
     * 
     * @var array informations qui transitent entre le client et le serveur
     */
    private $payload;

    /**
     *
     * @var string La passphrase (il est important de la passer dans un 
     * mecanisme de hachage pour plus de securité
     *   
     */
    private $passport = "hello world";

    /**
     *
     * @var int durée du token. Par défaut 24h
     */
    private $expiration = (60*60*24);

    public function __construct()
    {
//		$privateKey = "Hello world !";
//
//		$token = array(
//			"iss" => "example.org",
//			"aud" => "example.com",
//			"iat" => 1356999524,
//			"nbf" => 1357000000
//		);
//
//		$jwt = JWT::encode($token, $privateKey, 'HS256');
//		echo "Encode:\n" . print_r($jwt, true) . "\n";
//
//		$decoded = JWT::decode($jwt, $privateKey, array('HS256'));
//
//		/*
//         NOTE: This will now be an object instead of an associative array. To get
//         an associative array, you will need to cast it as such:
//        */
//
//		$decoded_array = (array) $decoded;
//		echo "Decode:\n" . var_dump($decoded_array, true) . "\n";


    }

    /**
     * Setter pour modifier l'expiration du token
     * @param int $expiration
     */
    public function setExpiration($expiration) {
        $this->expiration = $expiration;
    }

    /**
     * Genere un token basé sur l'utilisateur passé en argument
     * et encapsule le cookie dans l'en-tête de la réponse.
     * 
     * Le coockie généré est disponible pour le domaine complet
     * 
     * @param UserInterface $user L'utilisateur pour lequel le token est généré
     */
//    public function generateToken(UserInterface $user) {
    public function generateToken($user) {
//        $this->payload = array(
//            "username" => $user->getPseudo(),
//            "role" => $user->getRole(),
//            "exp" => time() + $this->expiration
//        );
        $this->payload = array(
            "username" => $user->pseudo,
            "role" => $user->role,
            "exp" => time() + $this->expiration
        );
        $tkn = JWT::encode($this->payload, $this->passport);
        setcookie("tkn", $tkn, $this->payload['exp'], "/");
    }

    /**
     * verifie l'integrité du token envoyé par le client
     * 
     * @param string $jwt le token reçu par le serveur
     * @return boolean true si le token est validé, faux dans les cas contraires
     */
    private function verifyToken($jwt) {
        try {
            return JWT::decode($jwt, $this->passport, array('HS256'));
        } catch (Exception $ex) {
            return false;
        }
    }

    /**
     * La methode est invoquée dans la methode du contrôleur où
     * l'on veut effectuer la verification
     * 
     * @return boolean le retour de la methode verifyToken 
     */
    public function acceptConnexion() {
        $tkn = (isset($_COOKIE['tkn'])) ? $_COOKIE['tkn'] : null;

        return $this->verifyToken($tkn);
    }

    /**
     * Désactive le cookie du coté serveur
     * @return boolean true si la modification a fonctionnée, false dans le cas contraire
     */
    public function deactivate() {
        return setcookie("tkn", null, time());
    }
    
     /**
	  * Genere un token basé sur l'utilisateur passé en argument
	  * et envoyer pour utilisé la confirmation dans un email.
	  *
	  *
	  * @param UserInterface $user L'utilisateur pour lequel le token est généré
	  * @return string
      */
//    public function generateToken(UserInterface $user) {
    public function generateEmailToken($user) {
        $this->payload = array(
            "username" => $user->getPseudo(),
            "roles" => $user->getGroup(),
            "exp" => time() + $this->expiration
        );
        $tkn = JWT::encode($this->payload, $this->passport);
//        var_dump($tkn);
        return $tkn;
    }
    
    
    public function acceptConfirmEmail($tkn) {
        
        return $this->verifyToken($tkn);
        
    }

}
