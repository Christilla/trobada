<?php

class Form
{
    public function __construct()
    {
        //$this->get_role();
        $this->open = form_open("signup", "'class = 'signUp' id = 'sign_up'");
        $this->submit = form_submit("submit","S'inscrire", "class='btn btn-info'");
    }

    private function createFormSignUp()
    {
        $input = self::createInput();
        $label = self::createLabel();
        $error = self::createError();
        $input_key = array_keys($input);
        $label_key = array_keys($label);
        $error_key = array_keys($error);
        $count = count($input_key);
        $data["form"] = [];

        if(!empty($input && $label))
        {
            foreach($input_key as $inputs_key)
            {
                for($i = 0; $i < $count; $i++)
                {
                    $data["form"]["input"][$inputs_key] = "$input[$inputs_key]";
                }
            }
            foreach($label_key as $labels_key)
            {
                for($i = 0; $i < $count; $i++)
                {
                    $data["form"]["label"][$labels_key] = "$label[$labels_key]";
                }
            }
            foreach($error_key as $errors_key)
            {
                for($i = 0; $i < $count; $i++)
                {
                    $data["form"]["error"][$errors_key] = "$error[$errors_key]";
                }
            }
        }
        else
        {
            $this->load->view("form/error");
        }   

        return $data["form"];
    }

    public function showForm()
    {
        $data = self::createFormSignUp();
        $input = array_values($data["input"]);
        $label = array_values($data["label"]);
        $error = array_values($data["error"]);
        $count = count($data["input"]);
        $formContent = '';

        for($i = 0; $i < $count; $i++)
        {
            $formContent.= "<div class=form-group row>" . $error[$i].$label[$i].$input[$i] . "</div>";
        }  
        $formContent.= "<div class=form-group row>" . $this->submit . "</div>";

        return $formContent;
    }

    private function createInput()
    {

        return array(
            "last" => form_input(array('name' => 'lastname', 'class' => 'form-control', 'placeholder' => 'Votre nom')),
            "first" => form_input(array('name' => 'firstname', 'class' => 'form-control', 'placeholder' => 'Votre prenom')),
            "pseudo" => form_input(array('name' => 'pseudo', 'class' => 'form-control', 'placeholder' => 'Saississez un pseudo')),
            "email" => form_input(array('name' => 'email', 'class' => 'form-control', 'placeholder' => 'Saississez un mail valide')),
            "password" => form_input(array('name' => 'password', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Votre mot de passe')),
            "verif_password" => form_input(array('name' => 'verif_password', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirmer le mot de passe')),
            "address" => form_input(array('name' => 'address', 'class' => 'form-control', 'placeholder' => 'Votre adresse')),
            "town" => form_input(array('name' => 'town', 'class' => 'form-control', 'placeholder' => 'Votre ville')),
            "postal_code" => form_input(array('name' => 'postal_code', 'class' => 'form-control', 'placeholder' => 'Votre code postal'))
        );
    }

    private function createLabel()
    {
        $class = [
            "class" => "col-sm-3 col-form-label"
        ];

        return array(
            "label_last" => form_label('Nom: ', 'lastname', $class),
            "label_first" => form_label('Prénom: ', 'firstname', $class),
            "label_pseudo" => form_label('Pseudo:', 'pseudo', $class),
            "label_email" => form_label('E-mail: ', 'email', $class),
            "label_password" => form_label('Mot de passe: ', 'password', $class),
            "label_verif_password" => form_label('Confirmation: ', 'verif_password', $class),
            "label_address" => form_label('Adresse: ', 'address', $class),
            "label_town" => form_label('Ville: ', 'town', $class),
            "label_postal_code" => form_label('Code postal: ', 'postal_code', $class)
        );
    }

    private function createError()
    {
        return array(
            "error_last" => form_error('lastname'),
            "error_first" => form_error('firstname'),
            "error_pseudo" => form_error('pseudo'),
            "error_email" => form_error('email'),
            "error_password" => form_error('password'),
            "error_verif_password" => form_error('verif_password'),
            "error_address" => form_error('address'),
            "error_town" => form_error('town'),
            "error_postal_code" => form_error('postal_code')

        );
    }
}

?> 