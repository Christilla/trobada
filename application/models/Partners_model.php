<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 11/09/18
 * Time: 11:28
 */

class Partners_model extends CI_Model
{
	public function get_all(){

		$this->load->database();
        
        $query = 'SELECT * FROM `partners` p LEFT JOIN `partners_categories` pc ON pc.id = p.partners_categories_id';
//        var_dump($query);
		$query = $this->db->query($query);
		/* $query = $this->db->get('partners'); */
        return $query->result();
		
    }
    
	public function getByCategoryId($id){

		$this->load->database();

        $query = 'SELECT * FROM `partners` p LEFT JOIN `partners_categories` pc ON pc.id=p.partners_categories_id WHERE p.partners_categories_id = ' . $id;
//		var_dump($query);
		$query = $this->db->query($query);
        return $query->result();

	}

}
