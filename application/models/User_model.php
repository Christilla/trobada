<?php

class User_model extends CI_Model
{
    public function insert_user($dataUser)
    {
        $query = $this->db->insert('users', $dataUser);

        return $query;
    }

    public function get_all_users()
    {
        $query = $this->db->get("users");

        return $query->result();
    }

    public function get_role()
    {
        if(isset($_SESSION['oMember']))
        {
            if($this->session->userdata('oMember')->role == "ADM")
            {
                $query = $this->db->get("roles");
            }
        }
        else
        {
            $this->db->where("short_name !=", "ADM");
            $query = $this->db->get("roles");
        }

        return $query->result();
    }

    public function findOneById(Int $id){
        $this->db->select('id, lastname, firstname, pseudo, email, balance, address, town, post_code, cus_id');
        $query = $this->db->get_where('users', array('id' => $id))->row();
        return $query;
    }

    public function updateOneById(Int $id, Array $data){
        $query = $this->db->update('users', $data, "id = $id");
        return $query;
    }

    public function countAllUsers(){
        $query = $this->db->count_all_results('users');
        return $query;
    }
}

?>