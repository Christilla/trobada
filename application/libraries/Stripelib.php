<?php 

/**
 * Library created by nicolas lopez for trobada
 * Library used for payment using stripe
 * beweb : 09/2018
 * mail: niko34310@gmail.com
 */

Use Stripe\Stripe;
Use Stripe\Customer;
Use Stripe\Charge;
Use Stripe\Source;

class Stripelib extends CI_Model{

    private $Stripe;

    public function __construct(){
        $apiKey = $this->config->config['secret_key'];
        Stripe::setApiKey($apiKey);
        $this->load->model('credits_model', 'credit');
        $this->load->model('user_model', 'user');
    }

    /**
     * Création d'un customer en prenant l'email de l'utilisateur connecté
     * Utilisé une seule fois pour crée le client et l'enregistrer en base de donnée
     * Après il garde le même ID
     */
    public function create_customer(Object $user){
        $customer = Customer::create(array(
            "description" => "Recharge de la carte Trobada",
            "email" => $user->email
            ));

        $this->store_customer($customer, $user->id);
        return $customer->id;
    }

    /**
     * Stockage de l'ID client de l'utilisateur en base de donnée
     */
    private function store_customer(Object $customer, Int $id){
        $this->db->where('id', $id);
        $this->db->update('users', ['cus_id' => $customer->id]);
    }

    /**
     * Met a jour l'utilisateur avec une nouvelle source si il veut la modifier
     * (la source = sa carte)
     */
    public function update_customer(String $token, String $cus_id){
        $customer = Customer::Update($cus_id, [
            'source' => $token
        ]);
    }

    /**
     * Procède au paiement
     * Défini le montant choisi par l'utilisateur au préalable
     * Met a jour la transaction dans la base de donnée avec un ID de transaction
     * Catch les exception si il en a pour enregistrer l'erreur et ainsi pouvoir avoir un message
     */
    public function proceed_payment(String $token, Array $customer){

        $credit = $this->credit->findOneWhere(["cus_id" => $customer['id']]);
        $amount = $credit->amount * 100;

        try{
            $charge = Charge::create([
                "amount" => $amount,
                "currency" => "eur",
                "description" => "Rechargement carte",
                "customer" => $customer['id'],
                "source" => $token
                ]);
            $ch_id = $charge->id;
        } catch(Exception $e){
            if(!empty($e->jsonBody['error']['charge'])){
                $ch_id = $e->jsonBody['error']['charge'];
            } else {
                $this->credit->updateOneById($credit->id, [
                    "message" => "3dSecure not validate",
                    "success" => false
                ]);
                redirect(base_url()."dashboard#moncompte");
            }
        }

        $this->credit->updateOneById($credit->id, [
            "ch_id" => $ch_id,
        ]);

        $this->retrieve_charge($ch_id, $credit->id);
    }

    /**
     * Vérifie si la source est correct et/ou si elle possède la fonction 3DSecure
     * Si c'est le cas lui crée une source spécialement pour cette occasion et ainsi
     * pouvoir le redirigé vers sa plateforme bancaire pour la validation
     */
    public function retrieve_source(String $token, String $cus_id){

        $credit = $this->credit->findOneWhere(["cus_id" => $cus_id]);
        $amount = $credit->amount * 100;
        $source = Source::retrieve($token);
        $this->credit->updateOneById($credit->id, [
            "approved" => true
        ]);
        if(!is_null($source->card->three_d_secure) && $source->card->three_d_secure != "not_supported"){
            $source = $this->create_3d_source($token, $amount);
            return $source;
        } else {
            return $source->id;
        }
    }

    /**
     * Crée la source pour la 3DSecure (systeme de double authentification bancaire)
     * Récupere le lien de retour, défini le montant et la carte
     */
    public function create_3d_source(String $token, Int $amount){
        $source = Source::create([
            "amount" => $amount,
            "currency" => "eur",
            "type" => "three_d_secure",
            "three_d_secure" => [
                "card" => $token
            ],
            "redirect" => [
                "return_url" => base_url() . "payment"
            ]
        ]);
        return $source;
    }

    /**
     * Récupere le token crée par la carte ou par la plateforme de validation
     */
    public function get_token(){
        $get = $this->input->get();
        $post = $this->input->post();

        if(!empty($get)){
			$token = $get['source'];
		} elseif(!empty($post)){
			$token = $post['stripeToken'];
        }

        return $token;
    }

    /**
     * Récupere les donnée d'une transaction pour vérifié le bon deroulement de celle ci
     * Si elle c'est bien dérouler, ajoute les crédit a son compte 
     * Sinon retourne un message d'erreur
     */
    public function retrieve_charge(String $charge, Int $cr_id){
        $charge = Charge::retrieve($charge);
        if($charge->status != "succeeded"){
            $success = false;
        } else {
            $success = true;
            $this->add_to_balance($cr_id);
            $this->session->set_flashdata('payment', 'Paiement réalisé');
        }

        if(!empty($charge->outcome->reason)){
            $message = $charge->outcome->reason;
        } else {
            $message = $charge->outcome->seller_message;
        }
        $this->credit->updateOneById($cr_id, [
            'success' => $success,
            'message' => $message
        ]);
    }

    /**
     * Servait pour les tests
     */
    public function testdump(){
        var_dump($this->input->method(true));
    }

    /**
     * Ajoute le montant de la transaction au porte-feuille du client
     */
    private function add_to_balance(Int $cr_id){
		$member = $this->session->userdata('oMember');
		$user = $this->user->findOneById($member->id);
        $credit = $this->credit->findOneById($cr_id);

        $old_balance = $user->balance;
        $new_balance = ($old_balance + $credit->amount);

        $this->user->updateOneById($member->id, [
            'balance' => $new_balance
        ]);
    }

}
