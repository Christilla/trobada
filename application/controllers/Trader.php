<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 10/09/18
 * Time: 22:31
 * Arranged by: Niko
 */

class Trader extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		
	}


	public function index(){
		var_dump("<h1>product index</h1>");
	}

	public function select_qrcodes(){
		$this->load->model('Events_model', 'aoEvents');
        
        $datas = array(
						'title' => "Impression de mes QR Codes",
						'aoEvents' => $this->aoEvents->get_all_events_by_ORG_id($this->session->userdata('oMember')->id)
					);
		//	view
		$this->load->view('templates/header_member', $datas);
		$this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $datas);
		$this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/config_qrcodes_print', $datas);
		$this->load->view('templates/footer_member', $datas);
	}

	public function get_qrcodes($member_id, $event_id){
        $this->load->library('qrcodelib');
        $this->load->library('pagination');
        $this->load->model('events_model', 'aoEvents');
        $this->load->model('products_model', "aoProducts");

        $page = 0;
        $get = $this->input->get();
        if(!empty($get)){
            $page = $get['per_page'];
        }

        $datas = array(
            'title' => "Impression de mes QR Codes",
            'oEvent' => $this->aoEvents->get_event_by_id($event_id)[0],
            'aoProducts' => $this->aoProducts->get_all_by_COM_id_limit($member_id, $page)
		);

        $this->qrcodelib->create_qrcode_dir(str_replace(' ', '-', $datas['oEvent']->title));

        foreach($datas['aoProducts'] as $product){
            $dir = "productQR/".str_replace(' ', '-', $datas['oEvent']->title);
            $name = str_replace(' ', '-', $datas['oEvent']->title);
            $content = $event_id."-".$product->id."-".$product->name."-".$product->price;
            $img = $this->qrcodelib->store_qrcode_png($dir, $name, $content);

            $product->qrcode = $img;
        }

        $config = array(
            'base_url' => current_url(),
            'total_rows' => $this->aoProducts->count_product($member_id),
            'per_page' => 12,
            'page_query_string' => true,
            'cur_tag_open' => '<li class="page-item active"><a class="page-link">',
            'cur_tag_close' => '</a></li>',
            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',
            'attributes' => array('class' => 'page-link')
		);
        $this->pagination->initialize($config);

        $datas['pagination'] = $this->pagination->create_links();

		$this->load->view('templates/header_member', $datas);
		$this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $datas);
        $this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/get_qrcodes', $datas);
		$this->load->view('templates/footer_member', $datas);
    }
    
    public function print_qrcode($member_id, $event_id){
        $this->load->library('qrcodelib');
		$this->load->model('events_model', 'aoEvents');
		$this->load->model('products_model', "aoProducts");
        //$this->load->library('mpdflib');

        $datas = [
            'oEvent' => $this->aoEvents->get_event_by_id($event_id)[0],
            'title' => "Liste des produits pour le festival \"".$datas['oEvent']->title."\"",
		    'aoProducts' => $this->aoProducts->get_all_by_COM_id($member_id)
        ];

        $this->qrcodelib->create_qrcode_dir(str_replace(' ', '-', $datas['oEvent']->title));

        foreach($datas['aoProducts'] as $product){
            $dir = "productQR/".str_replace(' ', '-', $datas['oEvent']->title);
            $name = str_replace(' ', '-', $datas['oEvent']->title);
            $content = $event_id."-".$product->id."-".$product->name."-".$product->price;
            $img = $this->qrcodelib->store_qrcode_png($dir, $name, $content);

            $product->qrcode = $img;
        }

        try{
            $mpdf = new Mpdf\Mpdf;
            ob_start();
                $this->load->view('members/com/printable_product', $datas);

                $html = ob_get_contents();
                
                $mpdf->WriteHTML($html);
                $mpdf->setHTMLFooter('{PAGENO}');
                $mpdf->shrink_tables_to_fit = 1;
                $mpdf->Output();
            ob_end_flush();

        } catch (Mpdf\Mpdf\Exception $e){
            echo $e->get_message();
        }
    }
}
