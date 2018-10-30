<?php

class Festivals_model extends CI_Model{

    public function get_all(){

		$this->load->database();
        
        $query = 'SELECT * FROM `events` INNER JOIN `events_places` ON events.id = events_places.events_id'; 

      
       
		$query = $this->db->query($query);
	
        return $query->result();

    }

    public function getByFestivalId($id){

		$this->load->database();

        $query = 'SELECT * FROM `events`  INNER JOIN events_places ON events.id = events_places.events_places_id WHERE `users_id`= '.  $member->id;



		$query = $this->db->query($query);
        return $query->result();

	}


}