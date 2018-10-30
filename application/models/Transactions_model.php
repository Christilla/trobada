<?php
    /**
     * Created by Niko
     */

class Transactions_model extends CI_Model {

    CONST table = 'transactions';

    public $id;
    public $amount;
    public $created_at;
    public $events_id;
    public $id_fest;
    public $id_com;

    public function findAll(){
        $query = $this->db->get(table);
        return $query->result();
    }

    public function findAllWhere(Array $where){
        $query = $this->db->get_where(table, $where);
        return $query->result();
    }

    public function customQuery(String $sql){
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function findAllTransactionEventByCom(Int $id){
        $sql = "SELECT e.title, ep.id, ep.place
                    FROM transactions t
                INNER JOIN events_places ep
                    ON t.events_places_id = ep.id
                INNER JOIN events e
                    ON ep.events_id = e.id
                WHERE t.id_com = $id
                GROUP BY e.title";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function findAllTransactionEventByFest(Int $id){
        $sql = "SELECT e.title, ep.id, ep.place 
                    FROM transactions t 
                INNER JOIN events_places ep 
                    ON t.events_places_id = ep.id 
                INNER JOIN events e 
                    ON ep.events_id = e.id 
                WHERE t.id_fest = $id
                GROUP BY ep.id"; 
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function findAllTransactionEventByEvent(Int $id){
        $sql = "SELECT e.title, ep.id, SUM(t.amount) AS amount, DATE_FORMAT(t.created_at, \"%d/%m/%Y %H\h%i\") AS created_at, u.firstname, u.lastname, u.company_name, ep.place, t.id_com, t.events_places_id AS place_id, t.checked
                    FROM transactions t 
                INNER JOIN events_places ep 
                    ON t.events_places_id = ep.id 
                INNER JOIN events e 
                    ON ep.events_id = e.id 
                INNER JOIN users u 
                    ON t.id_com = u.id 
                WHERE ep.id = $id 
                GROUP BY t.id_com";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function findAllFestTransactionByEvent(Int $id, Int $event_id){
        $sql = "SELECT t.amount, u.firstname, u.lastname, u.company_name, DATE_FORMAT(t.created_at, \"%d/%m/%Y %H\h%i\") AS created_at, e.title, t.id AS id_trans, t.id_com, u.id, ep.place
                    FROM transactions t 
                INNER JOIN users u 
                    ON t.id_com = u.id 
                INNER JOIN events_places ep 
                    ON t.events_places_id = ep.id
                INNER JOIN events e
                    ON ep.events_id = e.id 
                WHERE t.id_fest = $id 
                AND ep.id = ".$event_id;

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function findAllComTransactionByEvent(Int $id, Int $event_id){
        $sql = "SELECT t.amount, u.firstname, u.lastname, u.company_name, DATE_FORMAT(t.created_at, \"%d/%m/%Y %H\h%i\") AS created_at, e.title, t.id_com, u.id, ep.place
                    FROM transactions t 
                INNER JOIN users u 
                    ON t.id_fest = u.id 
                INNER JOIN events_places ep 
                    ON t.events_places_id = ep.id
                INNER JOIN events e
                    ON ep.events_id = e.id 
                WHERE t.id_com = $id 
                AND ep.id = ".$event_id;

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function findAllTotalEventByEvent(Int $id_ep, String $id_com = null){
        $sql = "SELECT e.title, SUM(t.amount) AS amount, ep.place 
                    FROM transactions t 
                INNER JOIN events_places ep 
                    ON t.events_places_id = ep.id 
                INNER JOIN events e 
                    ON ep.events_id = e.id 
                WHERE t.events_places_id = $id_ep ";
                if($id_com){
                    $sql .= "AND t.$id_com";
                }
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function findAllTransactionEvent(){
        $sql = "SELECT e.title, ep.id, ep.place  
                    FROM transactions t 
                INNER JOIN events_places ep 
                    ON t.events_places_id = ep.id 
                INNER JOIN events e 
                    ON ep.events_id = e.id 
                GROUP BY ep.id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function findBiggestCa(Int $id){
        $sql = "SELECT e.title, ep.id, SUM(t.amount) AS amount, DATE_FORMAT(t.created_at, \"%d/%m/%Y %H\h%i\") AS created_at, u.firstname, u.lastname, u.company_name, ep.place
                    FROM transactions t 
                INNER JOIN events_places ep 
                    ON t.events_places_id = ep.id 
                INNER JOIN events e 
                    ON ep.events_id = e.id 
                INNER JOIN users u 
                    ON t.id_com = u.id 
                WHERE t.id_com = $id
                GROUP BY t.events_places_id
                ORDER BY amount DESC";
        $query = $this->db->query($sql);
        $data = [
            'maxCA' => $query->first_row(),
            'minCA' => $query->last_row()
        ];
        return $data;
    }

    public function findBiggestTotal(Int $id){
        $sql = "SELECT e.title, ep.id, SUM(t.amount) AS amount, DATE_FORMAT(t.created_at, \"%d/%m/%Y %H\h%i\") AS created_at, u.firstname, u.lastname, u.company_name, ep.place
                    FROM transactions t 
                INNER JOIN events_places ep 
                    ON t.events_places_id = ep.id 
                INNER JOIN events e 
                    ON ep.events_id = e.id 
                INNER JOIN users u 
                    ON t.id_com = u.id 
                GROUP BY t.events_places_id
                ORDER BY amount DESC";
        $query = $this->db->query($sql);
        $data = [
            'maxCA' => $query->first_row(),
            'minCA' => $query->last_row()
        ];
        return $data;
    }

    public function findTotal(){
        $sql = "SELECT SUM(amount) AS amount FROM transactions";
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function totalCom(Int $id){
        $avg = "SELECT SUM(amount) AS average
                    FROM transactions
                WHERE id_com = $id
                GROUP BY id_com";

        return $this->db->query($avg)->row();
    }

    public function findDetailByTrans(Int $id_trans){
        $sql = "SELECT te.price, te.qty, p.name, te.products_name
                    FROM transactions_entries te
                INNER JOIN products p
                    ON te.products_id = p.id
                WHERE te.transactions_id = $id_trans";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function updateChecked(Array $where){
        $this->db->set('checked', true)->where($where);
        $query = $this->db->update('transactions');
        return $query;
    }
}