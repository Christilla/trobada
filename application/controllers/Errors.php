<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 11/09/18
 * Time: 15:15
 */

class Errors extends CI_Controller
{
	public function database(){
		$this->load->view('errors/html/error_db');
	}

	public function _404(){
//		$this->load->helper('url');
//		$this->load->view('errors/html/error_404');
	}
}
