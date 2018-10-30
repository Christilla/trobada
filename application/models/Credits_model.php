<?php

class Credits_model extends CI_Model {

    public $id;
    public $users_id;
    public $amount;
    public $approved;
    public $success;
    public $cus_id;
    public $ch_id;

    public function create(Array $data){
        $this->users_id = $data['users_id'];
        $this->amount = $data['amount'];
        $this->cus_id = $data['cus_id'];

        $this->db->insert('credits_amounts', $this);
    }

    public function findOneById(Int $id){
        $query = $this->db->get_where('credits_amounts', ['id' => $id])->row();
        return $query;
    }

    public function findOneWhere(Array $where){
        $query = $this->db->select('*')->where($where)->order_by('id DESC')->limit(1)->get('credits_amounts')->row();
        return $query;
    }

    public function updateOneById(Int $id, Array $data){
        $query = $this->db->where(['id' => $id])->update('credits_amounts', $data);
        return $query;
    }

    public function findAllWhere(Int $id){
        $query = $this->db->order_by('id DESC')->get_where('credits_amounts', ['users_id' => $id]);
        return $query->result();
    }

}