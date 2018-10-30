<?php
/**
 * Created by nicolas
 * Controller de gestion de paiement
 */

class Payment extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('stripe', 'url');
		$this->load->library('stripelib');
		$this->load->model('user_model', 'user');
		$this->load->model('credits_model', 'credits');
	}

	public function payment(){
		$member = $this->session->userdata('oMember');
		$post = $this->input->post();
		$user = $this->user->findOneById($member->id);
		$token = $this->stripelib->get_token();
		$method = $this->input->method(true);
	
		if(!customer_exists($user)){
			$customer['id'] = $this->stripelib->create_customer($user);
		} else {
			$customer['id'] = $user->cus_id;
		}

		if($method == "POST" && !empty($post)){

			$this->credits->create([
				'amount' => $post['amount'],
				'users_id' => $member->id,
				'cus_id' => $customer['id']
			]);

			$customer['source'] = $this->stripelib->retrieve_source($token, $customer['id']);
		}

		if(isset($customer['source']) && is_object($customer['source'])){
			$uri = $customer['source']->redirect->url;
			redirect($uri);
		} else {
			$this->stripelib->proceed_payment($token, $customer);
		}

		redirect(base_url()."dashboard#moncompte");
	}

	public function testdump(){
		$this->stripelib->testdump();
	}
}
