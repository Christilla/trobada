<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 10/09/18
 * Time: 22:31
 */

class Members extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('members_model');
	}

	public function signIn(){

//		var_dump($this->securityByTkn);
		//	Title page
 		$datas['title'] = "Identification";

		$this->load->helper('form');
		$this->load->library('form_validation');

		if ($this->form_validation->run('members/signIn') == FALSE)
		{
//			echo password_hash('redivo', PASSWORD_DEFAULT);
//			die();
			/*
			 *	Errors were found in form user entries
			 * 	Reloading form
			 */
			$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
			$this->load->view('templates/header', $datas);
			$this->load->view('pages/signinForm', $datas);
			$this->load->view('templates/footer', $datas);
		}
		else
		{
			/*
			 * 	No Error found
			 * 	Let's check for an existing user
			 */
//			$this->load->model('members_model');

			/*
			 * Initialize session with surfer profile
			 */
			$oMember = $this->members_model->retrieveMemberProfile(array($this->input->post()['pseudo']));

			if(!is_null($oMember) && password_verify($this->input->post()['password'], $oMember->password) === true){
				$this->_initSession($oMember);
			}else{
				$this->session->set_flashdata('login_error', "<p class='error'>Vos identifiants de connexion ne sont pas correct !</p>");
				redirect('signin#signin');
			}
//			$_SESSION['oMember'] = $this->members_model->retrieveMemberProfile(array($this->input->post()['pseudo'], $this->input->post()['password']));

			/*
			 * Generating token cookie
			 */
			$this->securityByTkn->generateToken($_SESSION['oMember']);
			redirect('dashboard');
		}
	}

	public function logout(){

		/*
         * Deactivate token cookie
		 * Unset oMember session
		 * redirect to homepage
         */
		$this->securityByTkn->deactivate();
		$this->session->unset_userdata('oMember');
		redirect('home');
	}

	public function dashboard(){

		//	Title page
		$datas['title'] = 'Tableau de bord';
		
		//	Member
		$datas['member'] = $this->session->userdata['oMember'];

		//	helpers and libraries
		$this->load->helper('form');
		$this->load->helper('security');
		$this->load->library('form_validation');

		//	Which form has been posted
		$form_validation_rules = "";
		switch(true){

			//	Profile form
			case(isset($this->input->post()['update_profil'])):
				//	Is password get to be reset
				//	Is last_password field matches actual member password
				$form_validation_rules = (!empty($this->input->post()['last_password']) || !empty($this->input->post()['password']) || !empty($this->input->post()['confirm_password'])) ? 'dashboard/password' : 'dashboard/profile';
			break;

			// Informations form
			case(isset($this->input->post()['update_infos'])):
				$form_validation_rules = (isset($this->input->post()['company_name'])) ? 'dashboard/infos_com' : 'dashboard/infos';
			break;

			case(isset($this->input->post()['code_btn'])):
				$form_validation_rules = 'dashboard/code';
			break;
		}

		if ($this->form_validation->run($form_validation_rules) == FALSE)
		{
			$this->load->library('qrcodelib');
			$content = $datas['member']->id.'-'.$datas['member']->pseudo;
			$datas['member']->qrcode = $this->qrcodelib->store_qrcode_png('member/qr', $datas['member']->pseudo, $content, 'H');
			/*
			 *	Errors were found in form user entries
			 * 	Reloading form
//			 */
			$this->load->model('credits_model', 'credit');
			$this->load->model('transactions_model', 'trans');
			$this->load->model('User_model', 'users');


			$datas['payment'] = $this->load->view('modules/payment',$datas , true);
			$datas['payment_info'] = $this->credit->FindAllWhere($this->session->userdata('oMember')->id);

			if(is_null($datas['member']->secret_code)){
				$datas['my_account'] = $this->load->view('modules/new_card', $datas, true);
			} else {
				$datas['my_account'] = $this->load->view('modules/my_account', $datas, true);
			}

			if($datas['member']->role == 'COM'){
				if(empty($this->trans->findAllTransactionEventByCom($this->session->userdata('oMember')->id))){
					$datas['participation'] = "Aucune participation";
					$datas['CA'] = [
						'maxCA' => 'n/a',
						'minCA' => 'n/a'
					];
					$datas['averageCA'] = 0;
				} else {
					$datas['participation'] = count($this->trans->findAllTransactionEventByCom($this->session->userdata('oMember')->id));
					$datas['CA'] = $this->trans->findBiggestCa($this->session->userdata('oMember')->id);
					$datas['averageCA'] = (($this->trans->totalCom($this->session->userdata('oMember')->id)->average)/$datas['participation']);
				}
			}

			if($datas['member']->role == 'ADM'){
				$datas['nbrUser'] = $this->users->countAllUsers();
				if(empty($this->trans->findTotal())){
					$datas['CA'] = [
						'maxCA' => 'n/a',
						'minCA' => 'n/a'
					];
					$datas['CAtotal'] = 0;
				} else {
					$datas['CA'] = $this->trans->findBiggestTotal($this->session->userdata('oMember')->id);
					$datas['CAtotal'] = $this->trans->findTotal();
				}
			}

			$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
			/*     $this->load->view('members/member_header', $datas); */
			$this->load->view('templates/header_member', $datas);
			$this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $datas);
			$this->load->view('members/common_profile_and_infos', $datas);
			$this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/dashboard_features', $datas);
			$this->load->view('templates/footer_member',$datas);
		}
		else
		{
			//	Everything was right
			//	Let's update profile in DB

			//	Close where for member
			$where = "id = " . $datas['member']->id;

			//	Defining what it was posted
			switch($form_validation_rules){

				case('dashboard/password'):
					//	Setting datas to update password
					$hashedPawword = password_hash($this->input->post()['password'], PASSWORD_DEFAULT);
//					die($hashedPawword);
					$data = array('password' => $hashedPawword);
					//	There is no break instruction here
				case('dashboard/profile'):
					$update_message = "profile_update_message";
					//	Setting datas to update email
					$data['email'] = $this->input->post()['email'];
				break;

				case('dashboard/infos_com'):
					$data['company_name'] = $this->input->post()['company_name'];
				case('dashboard/infos'):
					$update_message = "infos_update_message";
					//	Setting datas to update
					$data['lastname'] = $this->input->post()['lastname'];
					$data['firstname'] = $this->input->post()['firstname'];
					$data['address'] = $this->input->post()['address'];
					$data['post_code'] = $this->input->post()['post_code'];
					$data['town'] = $this->input->post()['town'];
					$data['company_name'] = $this->input->post()['company_name'];
				break;

				case('dashboard/code'):
					$update_message = "card_code_message";
					$data['secret_code'] = password_hash($this->input->post()['code'], PASSWORD_DEFAULT);
				break;
			}
			//	Update datas in DB
			$dbResponse = $this->db->query($this->db->update_string('users', $data, $where));

//			var_dump($dbResponse);
			if($dbResponse == true){
				$this->session->set_flashdata($update_message, "<p>Votre profil a été modifié !</p>");
			}else{
				$this->session->set_flashdata($update_message, "<p>Votre profil n'a pas pu être modifié !</p>");
			}

			redirect('dashboard');
		}
	}

	public function incoming_events(){
		//	page Title
		$datas['title'] = "Les événements à venir";

		//	view
		$this->load->view('templates/header_member', $datas);
		$this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $datas);
		$this->load->view('members/org/incoming_festivals', $datas);
		$this->load->view('templates/footer_member', $datas);
	}


	public function last_events(){


		$this->load->model('festivals_model');
		
		/*  $datas['aoFestivals'] = $this->festivals_model->get_all(); */
		
		$datas['aoFestivals'] = $this->festivals_model->getByFestivalId($id);

 /*        Chargement de la vue */
		$this->load->view('templates/header_member', $datas);
		$this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $datas);
		$this->load->view('members/org/dashboard_features', $datas);
		$this->load->view('templates/footer_member', $datas);
	}

	public function printable(){
		$mpdf = new Mpdf\Mpdf;

		$member = $this->session->userdata('oMember');
		$this->load->library('qrcodelib');
		$content = $member->id.'-'.$member->pseudo;
		$qrcode = $this->qrcodelib->store_qrcode_png('member/qr', $member->pseudo, $content, 'H');

		$mpdf->WriteHTML("<h1>Votre QRCode à coller sur la carte sans cacher la montagne</h1>");
		$mpdf->WriteFixedPosHTML("<img src=".base_url().$qrcode.">", 20, 50, 20, 20, 'auto');
		$mpdf->output();
	}
}
