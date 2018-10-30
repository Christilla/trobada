<?php

class Festmember extends MY_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function mycard(){

		//	Title page
		$datas['title'] = 'Ma carte';
		
		//	Member
        $datas['member'] = $this->session->userdata['oMember'];
        
        $this->load->view('members/member_header', $datas);
        $this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $datas);
        $this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/mycard', $datas);
        $this->load->view('members/member_footer', $datas);
    }

}