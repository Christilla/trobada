<?php
;
class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->library('form');
        $this->load->model('user_model');
    }

    public function signUp()
    { 
        $role = $this->user_model->get_role();
        $option = [];

        foreach($role as $oRoles)
        {
            $option[$oRoles->id] = $oRoles->long_name;
        }

        if($this->form_validation->run('user/signUp') == FALSE)
        {
            $data['class_label'] = ["class" => "col-form-label"];
            $data['title'] = 'Inscription';
            $data['role'] = form_dropdown("role", $option, $this->input->post('role'), "class='col-sm-3 col-form-label'");

            $this->form_validation->set_error_delimiters('<p class="error">', '</p>'); 
            $this->load->view("templates/header", $data);
            $this->load->view("pages/signup_form", $data);
            $this->load->view("templates/footer", $data);
        }
        else
        {
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

            if($this->user_model->insert_user($this->dataUser()) == true)
            {
                redirect('signin#signin');
            }
        } 
    }

    private function dataUser()
    {
        $data = [
            "lastname" => $_POST['lastname'],
            "firstname" => $_POST['firstname'],
            "pseudo" => $_POST['pseudo'],
            "email" => $_POST['email'],
            "password" => $_POST['password'],
            "address" => $_POST['address'],
            "town" => $_POST['town'],
            "post_code" => $_POST['postal_code'],
            "roles_id" => $_POST['role'],
        ];

        return $data;
    }

    public function allUser()
    {
        $data = [];
        $aoUser = $this->user_model->get_all_users();

        foreach($aoUser as $oUser)
        {
            $data['user'] = $oUser;
        }
    }
}
