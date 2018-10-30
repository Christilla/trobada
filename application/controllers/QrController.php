<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 23/09/18
 * Time: 23:56
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class QrController extends CI_Controller
{

	function __construct ()
	{
		parent::__construct();
//		$this->load->library('phpqrcode/qrlib');
		include(BASEPATH . '../application/libraries/phpqrcode/qrlib.php');
	}

	public function index()
	{
		$this->load->view('qrcodetext.php');
	}

	public function qrcodeGenerator ( )
	{


		$qrtext = $this->input->post('qrcode_text');
//
		if(isset($qrtext))
		{
//
//			//file path for store images
//			$SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/qrcodeci/images/';
			$text = $qrtext;
//			$text1= substr($text, 0,9);
//
//			$folder = $SERVERFILEPATH;
//			$file_name1 = $text1."-Qrcode" . rand(2,200) . ".png";
//			$file_name = $folder.$file_name1;
			QRcode::png($text);

//			echo"<center><img src=".base_url().'images/'.$file_name1."></center";
		}
		else
		{
			echo 'No Text Entered';
		}
	}
}
