<?php 

class Events_model extends CI_Model
{
    /* INSERT QUERY */


    public function insert_events($data_events)
    {   
        $data = [];
        $data["query"] = $this->db->insert("events", $data_events);
        $data["events_id"] = $this->db->insert_id();
        
        return $data;
    }

    public function insert_events_places($data_events_places)
    {
        $query = $this->db->insert("events_places", $data_events_places);

        return $query;
    }

    public function insert_events_registrations($data_events_registration)
    {
        $query_events_registration = $this->db->insert("events_registrations", $data_events_registration);

        return $query_events_registration;
    }

    public function insert_registrations($data_events_registrations)
    {
        $query = $this->db->insert('events_registrations', $data_events_registrations);

        return $query();
    }


    /* GET QUERY */


    public function get_events_id()
    {
        $this->db->where("title =", $this->input->post('title'));
        $this->db->select("id");
        $query_events_id = $this->db->get("events");

        return $query_events_id->result();
    }

    public function get_all_events()
    {
        $this->db->select("e.title, e.description, e.users_id, e.id, u.pseudo");
        $this->db->from("events e");
        $this->db->join("users AS u", "e.users_id = u.id");
        $query = $this->db->get();

        return $query->result();
    }

    public function get_events_places_id()
    {
        $this->db->where("starting_date =", $this->input->post('starting_date'));
        $this->db->select("id");
        $query_events_places_id = $this->db->get("events_places");

        return $query_events_places_id->result();
    }

    public function get_all_events_by_ORG_id($orgId)
    {
		$this->db->select('
						e.id,
						e.title,
						e.description,
						ep.starting_date,
						ep.ending_date,
						ep.place
						');
		$this->db->from('events AS  e');
		$this->db->join('events_places AS ep','e.id = ep.events_id');
		$this->db->join('events_registrations AS er','er.events_places_id = e.id');
		$this->db->where('er.users_id', $orgId);

		$query = $this->db->get();
		return $query->result();
    }

    public function get_event_by_id($event_id)
	{
		$this->db->select('
						e.id,
						e.title,
						e.description,
						ep.starting_date,
						ep.ending_date,
						ep.place
						');
		$this->db->from('events AS  e');
		$this->db->join('events_places AS ep', 'e.id = ep.events_id');
		$this->db->join('events_registrations AS er', 'er.events_places_id = e.id');
		$this->db->where('e.id', $event_id);
        $query = $this->db->get();
        
		return $query->result();
	}

    public function get_all_events_by($id)
    {
    	$query = '
						SELECT 
							e.*,
							ep.id,
							ep.starting_date, 
							ep.ending_date, 
							ep.place 
						FROM 
							events e  
						LEFT JOIN 
							events_places ep 
						ON 
							e.id = ep.events_id 
						WHERE 
                            e.users_id =' . $id ;

        $this->db->query($query);

        return $query->result();
    }

    public function get_event($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->query('SELECT e.title, e.description, ep.id, ep.starting_date, ep.ending_date, ep.place, ep.events_id FROM events e LEFT JOIN events_places ep ON e.id = ep.events_id WHERE e.id =' . $id . '');

        return $query->result();
    }

    public function get_event_by_id_by_user($event_id, $event_user)
    {
        $this->db->where('id', $event_id);
        $this->db->where('users_id', $event_user);
		$query = $this->db->get('events');

        return $query->result();
    }

    public function get_events_places($id_places)
    {
        $this->db->where("id", $id_places);
        $query = $this->db->get("events_places");

        return $query->result();
    }

    public function get_event_registration_by($events_places_id, $users_id)
    {
        $query = "SELECT * FROM events_registrations WHERE events_places_id = $events_places_id AND users_id = $users_id";
        
        return $this->db->query($query)->result();
    }

    public function get_row_event_registration_by($events_places_id, $users_id)
    {
        $query = "SELECT * FROM events_registrations WHERE events_places_id = $events_places_id AND users_id = $users_id";
        return $this->db->query($query)->row();
    }

    public function get_all_places_by_event($events_id)
    {
        $data = array();
        foreach($events_id as $event_id)
        {
            $this->db->select("ep.id, ep.starting_date, ep.ending_date, ep.place, ep.events_id");
            $this->db->from("events AS e");
            $this->db->join("events_places AS ep", "ep.events_id = e.id");
            $this->db->where("events_id", $event_id);
            $query = $this->db->get();

            array_push($data, $query->result()); 
        }
        return $data;
    }

    public function get_event_by_places($events_places_id)
    {
        $this->db->where("id", $events_places_id);
        $query = $this->db->get("events_places");

        return $query->result();
    }

    public function get_all_events_by_users($id)
    {
        $this->db->where("users_id", $id);
		$this->db->order_by("id", 'DESC');
		//$this->db->limit(1);
        $query = $this->db->get("events");

        return $query->result();
    }

    public function get_users_by_events_id($users_id)
    {
        //$this->db->where("id", $id);
        //if(! $query = $this->db->delete("events_places")){
        //	return $this->db->error()['code'];
        //}
        //return $query;
        $this->db->select("pseudo");
        $this->db->from("users u");
        $this->db->join("events AS e", "u.id = e.users_id");
        $this->db->where("users_id", $users_id);

        return $this->db->get();
    }


    /* UPDATE QUERY */


    public function update_event($id, $dataDb_update_events)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('events', $dataDb_update_events);

        return $query;
    }

    public function update_event_place($id, $dataDb_update_events_places)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('events_places', $dataDb_update_events_places);

        return $query;
    }


    /* DELETE QUERY */


    public function delete_events_places_by_event($events_id)
    {
        try
        {
            $this->db->where("events_id", $events_id);
            return $this->db->delete("events_places");
        }
        catch(Exception $e)
        {
            var_dump($e);
        }
    }

    public function delete_event($id, $users_id)
    {
        $query = $this->db->query("DELETE FROM events WHERE id = $id AND not_deletable = 0 AND users_id = $users_id");

        if(!$query)
        {
            return $this->db->error()['code'];   
        }
        else
        {
            return $query;
        }
    }

    public function delete_events_registrations_by_places($events_places_id)
    {
        $this->db->where("events_places_id", $events_places_id);
        $query = $this->db->delete('events_registrations');

        return $query;
    }

    public function delete_events_places_by($id)
    {    
        $this->db->where("id", $id);
        $query = $this->db->delete("events_places");

        if(!$query)
        {
            return $this->db->error()['code'];   
        }
        else
        {
            return $query;
        }
    }
}

?>
