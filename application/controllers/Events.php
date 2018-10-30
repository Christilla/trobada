<?php

class Events extends MY_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('form_validation_date');
        $this->load->model('events_model');
    }

    public function setEvent()
    {
        $data = array();
        $data['title'] = 'Création d\'évènement';
        $data['class_label'] = array("class" => "label");
        $data['addedCssFiles'] = base_url() . 'assets/css/add_event.css';
        $events_id_flash = "events_id";
        $message_success = "success";

        if($this->form_validation->run('events/setEvent') == FALSE)
        {
            $this->form_validation->set_error_delimiters('<p class="error">', '</p>'); 
            $this->load->view('templates/header_member', $data);
            $this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $data);
            $this->load->view('members/org/event_form', $data);
            $this->load->view('templates/footer_member', $data);
        }
        else
        {
            $data_events = array(
                "title" => $this->input->post('title'),
                "description" => $this->input->post('description'),
                "users_id" => $_SESSION['oMember']->id
			);

            $update_form = "date-error";
            $data_events = $this->events_model->insert_events($data_events);

            if($data_events["query"] == true)
            {
                $events_id = $data_events['events_id'];

                $this->session->set_flashdata($message_success, "<p class='notification is-success'>Votre évènement a était crée !</p>'");
                redirect("manage-event/$events_id");
            }
        }
    }

    public function datasEventPlaces($events_id)
    {
        $data_events_places = array(
            "starting_date" => $this->input->post('starting_date'),
            "ending_date" => $this->input->post('ending_date'),
            "place" => $this->input->post('place'),
            "events_id" => $events_id
		);

        return $data_events_places;
    }

    public function datasEventRegistrations()
    {
        $ao_id_events = $this->events_model->get_events_id();
        $id_session = $_SESSION['oMember']->id;

        foreach($ao_id_events as $o_id_events)
        {
            $data_id_events[] = $o_id_events->id;    
        }

        $data_events_registration = array(
            "events_id" => $data_id_events[0],
            "users_id" => $id_session
		);

        return $data_events_registration;
    }

    public function allEventsBy()
    {
        $data_id = array();
        $data['title'] = "Mes évènements";
        $data['events'] = $this->events_model->get_all_events_by_users($_SESSION['oMember']->id);
        $data['addedCssFiles'] = "assets/css/add_event.css";
        $data['addedJsFiles'] = "assets/js/manage_events.js";

        $this->load->view('templates/header_member', $data);
        $this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $data);
        $this->load->view('members/org/manage-events', $data);
        $this->load->view('templates/footer_member', $data);

        return $data;
    }

    public function manage_event($event_id)
    {
        $data_id = array();
        $data['title'] = "Mes évènements";
        $data['events_id'] = $event_id;
        $data['events'] = $this->events_model->get_event_by_id_by_user($event_id, $this->session->userdata('oMember')->id);
        $data['places'] = array();
        $data['addedCssFiles'] = "assets/css/add_event.css";
        $data['addedJsFiles'] = "assets/js/manage_events.js";

        foreach($data['events'] as $events)
        {
			$data['events'] = $events;
        }
		$data_id[] = $event_id;

        $ao_places = $this->events_model->get_all_places_by_event($data_id);

        foreach($ao_places as $o_places)
        {
            foreach($o_places as $places)
            {
                array_push($data['places'], $places);
            }
        }

        $this->load->view('templates/header_member', $data);
        $this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $data);
        $this->load->view('members/org/manage-event', $data);
        $this->load->view('templates/footer_member', $data);

        return $data;
    }

    public function allEvents()
    {
        $data = [];
        $data['title'] = "Festivals à venir";
        $data['title'] = "Évènements à venir";
        $data['events'] = $this->events_model->get_all_events();
        $data['places'] = [];

        if($data['events'] != null){
			foreach($data['events'] as $events)
			{
				$data_id[] = $events->id;
			}

			if(isset($data_id)){

				$values = array_unique($data_id);

				$data_id = $values;

				$ao_places = $this->events_model->get_all_places_by_event($data_id);
			}

			foreach($ao_places as $o_places)
			{
				foreach($o_places as $places)
				{
					$reg = $this->events_model->get_row_event_registration_by($places->id, $this->session->userdata('oMember')->id);
					$places->reg = $reg;
					array_push($data['places'], $places);
				}
			}
		}else{

		}

        $this->load->view('templates/header_member', $data);
        $this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $data);
        $this->load->view('members/incoming-events', $data);
        $this->load->view('templates/footer_member', $data);      
    }

    public function event($id)
    {
        $ao_event = $this->events_model->get_event($id);
        $data['event'] = [];

        foreach($ao_event as $o_event)
        {
            $data['event'] = $o_event;
        }

        return $data['event'];
    }

    public function updateEvent($id_event)
    {
        $event = $this->event($id_event);
        $id_place = $event->id;
        $message_update_success = "success";
        $message_update_error = "error";

        $data = array(
            'event' => $event,
            'title' => "Modification",
            'class_label' => array("class" => "col-sm-3 col-form-label")
		);

        if($this->form_validation->run('events/updateEvent') == FALSE)
        {
            $this->form_validation->set_error_delimiters('<p class="error">', '</p>'); 
            $this->load->view('templates/header_member', $data);
            $this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $data);
            $this->load->view('members/org/update_event_form', $data);
            $this->load->view('templates/footer_member', $data);
        }
        else
        {
        	$query = $this->events_model->update_event($id_event, $this->data_update_events());
            if($query == true)
            {
                $this->session->set_flashdata($message_update_success, "<p class='notification is-success'>Cet évènement a bien été modifié !</p>");
                redirect('manage-event/' . $id_event . '#title');
            }
            else{
                $this->session->set_flashdata($message_update_error, "<p class='notification is-danger'>Cet évènement n'a pas été modifié !</p>");
                redirect('manage-event/' . $id_event . '#title');
			}
        }
    }

    public function data_update_events()
    {
        $data_update_events = array(
            "title" => $this->input->post('new_title'),
            "description" => $this->input->post('new_description')
		);

        return $data_update_events;
    }

    public function deleteEvent($id)
    {
        $users_id = $this->session->userdata('oMember')->id;
        $message_delete_success = "success";
        $message_delete_error = "error";

        $test = $this->events_model->delete_event($id, $users_id);
        
        if($test === 1451)
        {
            $this->session->set_flashdata($message_delete_error, "<p class='notification is-warning'>Des transactions liées à cet évènement interdisent la suppression de ce dernier.</p>");
            redirect("manage-event/$id");
        }
        else
        {
            if($this->events_model->delete_events_places_by_event($id) == true)
            {
                $this->session->set_flashdata($message_delete_success, "<p class='notification is-success'>Votre évènement à bien été supprimé</p>");
            }
            redirect("manage-events");
        }
    }

    public function toPositionYourself($events_places_id, $events_id)
    {
        $data = [];
        $data_events_registrations = array(
            "events_places_id" => $events_places_id,
            "users_id" => $_SESSION['oMember']->id
		);

        $registrations = $this->events_model->get_event_registration_by($events_places_id, $_SESSION['oMember']->id);

        if(empty($registrations))
        {
            if($this->events_model->insert_events_registrations($data_events_registrations) == true)
            {
                $message_subscribe_success = "success";
                $this->session->set_flashdata($message_subscribe_success, "<p class='notification is-success'>Vous êtes positionné sur le festival</p>");
                redirect('incoming-events');
            }
        }
        else
        {
            $this->positionFailed($events_places_id, $events_id);
        }
    }
    
    private function positionFailed($events_places_id, $events_id)
    {
        $data = [];
        $data['title'] = "Déjà positionné";
        $data['places'] = $this->events_model->get_events_places($events_places_id);
        $data['events'] = $this->events_model->get_event($events_id);
        $message_subscribe_error = "error";

        foreach($data['events'] as $event)
        {
            $this->session->set_flashdata($message_subscribe_error, "<p class='notifiction is-warning'>Vous êtes déjà inscrit sur le festival <strong>" . $event->title . "</strong> sur les emplacements suivants :</p>");
        }

        $this->load->view('templates/header_member', $data);
        $this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $data);
        $this->load->view('members/com/position-failed', $data);
        $this->load->view('templates/footer_member', $data);
    }

    public function deleteEventsRegistrations($events_places_id)
    {
        $this->events_model->delete_events_registrations_by_places($events_places_id);
        
        $message_unsubscribe_event = "success";

        $this->session->set_flashdata($message_unsubscribe_event, "<p class='notification is-warning'>Vous n'êtes plus incrit sur le festival</p>");
        redirect('incoming-events');

    }

    public function addEventsPlaces($events_id)
    {
        $message_date = "date-error";
        $message_add_error = "error";
        $message_add = "success";
        $event = $this->event($events_id);
        $data = array(
            'event' => $event,
            'class_label' => array("class" => "col-sm-3 col-form-label")
        );

        if($this->form_validation->run('events/addEventsPlaces') == false)
        {
            $this->form_validation->set_error_delimiters('<p class="error">', '</p>'); 
            $this->load->view('templates/header_member', $data);
            $this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $data);
            $this->load->view('members/org/update_event_form', $data);
            $this->load->view('templates/footer_member', $data);
        }
        else
        {
            if($this->form_validation_date->form_date($this->input->post('add_starting_date'), $this->input->post('add_ending_date')) == true)
            {
                if($this->events_model->insert_events_places($this->addDataEventsPlaces($events_id)) == TRUE)
                {
                    $this->session->set_flashdata($message_add, "<p class='notification is-success'>Votre emplacement a bien été ajouté !</p>");
                }
                else
                {
                    $this->session->set_flashdata($message_add_error, "<p class='notification is-warning'>L'emplacement n'a pas pu être créé</p>");
                }
            }
            else
            {
                $this->session->set_flashdata($message_date, "<p class='notification is-danger'>Les dates saisies ne sont pas valides !</p>");
            }
            redirect("manage-event/$events_id");
        }
    }

    public function addDataEventsPlaces($events_id)
    {
        $data_add_events_places = array(
            "starting_date" => $this->input->post('add_starting_date'),
            "ending_date" => $this->input->post('add_ending_date'),
            "place" => $this->input->post('add_place'),
            "events_id" => $events_id
		);

        return $data_add_events_places;
    }

    public function deleteEventPLaces($id_places, $events_id)
    {
        $delete_message_success = "success";
        $delete_message_error = "error";

        if($this->events_model->delete_events_places_by($id_places) === 1451)
        {
            $this->session->set_flashdata($delete_message_error, "<p class='notification is-warning'>Vous ne pouvez pas supprimer cet emplacement, il peut-être lié à des transactions en cours !</p>");
            redirect("manage-event/$events_id");
        }
        else
        {
            $this->session->set_flashdata($delete_message_success, "<p class='notification is-success'>Votre emplacement à bien été supprimé !");
            redirect("manage-event/$events_id");
        }
    }

    public function updateEventPlaces($events_places_id)
    {
        $ao_places = $this->events_model->get_event_by_places($events_places_id);
        $message_date = "date-error";
        $message_update = "success";
        $message_update_error = "error";
        $data['title'] = "Mes évènements";
        foreach($ao_places as $o_places)
        {
            $events_id = $o_places->events_id;
        }

        $data = $this->manage_event($events_id);

        if($this->form_validation->run('events/updateEventsPlaces') == false)
        {
            $this->form_validation->set_error_delimiters('<p class="error">', '</p>'); 
            $this->load->view('templates/header_member', $data);
            $this->load->view('members/' . strtolower($this->session->userdata('oMember')->role) . '/submenu', $data);
            $this->load->view('members/org/manage-event', $data);
            $this->load->view('templates/footer_member', $data);
        }
        else
        {
            if($this->form_validation_date->form_date($this->input->post('new_starting_date'), $this->input->post('new_ending_date')) === true)
            {
                   
                if($this->events_model->update_event_place($events_places_id, $this->data_update_events_places()) == TRUE)
                {
                    $this->session->set_flashdata($message_update, "<p class='notification is-success'>La modification a été effectuée !</p>");
                }
                else
                {
                    $this->session->set_flashdata($message_update_error, "<p class='notification is-warning'>La modification n'a pas été effectuée !</p>");
                }    
            }
            else
            {
                $this->session->set_flashdata($message_date, "<p class='notification is-danger'>Les dates saisies ne sont pas valides !</p>");
            }
            redirect("manage-event/$events_id#title");
        }
    }

    public function data_update_events_places()
    {
        $data_update_events_places = array(
            "starting_date" => $this->input->post('new_starting_date'),
            "ending_date" => $this->input->post('new_ending_date'),
            "place" => $this->input->post('new_place')
		);

        return $data_update_events_places;
    }
}

?>
