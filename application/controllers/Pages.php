<?php
class Pages extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
	}

    public function view($page='home')
    {
//    	echo $page;
        $this->load->helper('html');
        $this->load->helper('url');
        $this->load->database(); /* à charger uniquement pour les pages partenaires et festival */
        $this->load->helper('form');  
    

        if (! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
          /*   affiche une page d'erreur si la vue n'existe pas */
            show_404();
        }

        $data['title'] = ucfirst($page);  /* met en majuscule la première lettre */

     	/*    charge les différentes vues */
        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer',$data);
    }

    public function sendMessage()
    {
        $datas['title'] = "Contact";
            $this->load->helper('form');

            $this->load->library('form_validation');

          /*   $this->form_validation->set_rules('lastname', 'Lastname', 'required');
                $this->form_validation->set_rules('firstname', 'Firstname', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('message', 'Message', 'required'); */

            if ($this->form_validation->run('pages/contact') == FALSE)
            {	
                     $this->form_validation->set_error_delimiters('<p class="error">', '</p>');  
                

                   $this->load->view('templates/header',$datas); 
                    $this->load->view('pages/contact',$datas);
                    $this->load->view('templates/footer');
               

            }
            else
            {
                    $this->load->view('pages/formsuccess');

            }
    }

    public function partenaire(){

        $datas['title'] = "Partenaires";
        $this->load->helper('form');
        
        //  Récupération des catégories en BDD pour la génération du select
        $this->load->model('categories_model');
        $datas['aoCategories'] = $this->categories_model->get_all(); 
      


        $this->load->model('partners_model');
        if ($this->input->post('categories') == null){
            $datas['aoPartners'] = $this->partners_model->get_all();
           $query = $this->db->query('SELECT * FROM `partners` INNER JOIN partners_categories'); 
          
        }
       else {
            $datas['aoPartners'] = $this->partners_model->getByCategoryId($this->input->post('categories'));
           
       } 
       
       /*  echo "<pre>";
        var_dump($datas);
        echo "</pre>";
 */
            $this->load->view('templates/header', $datas);
            $this->load->view('pages/partenaire', $datas);
            $this->load->view('templates/footer');

    }


    public function festival(){

        $datas['title'] = "Festival";
        
        $this->load->model('festivals_model');
         $datas['aoFestivals'] = $this->festivals_model->get_all();


 /*        Chargement de la vue */
        $this->load->view('templates/header', $datas);
        $this->load->view('pages/festival', $datas);
        $this->load->view('templates/footer');

    }

}
