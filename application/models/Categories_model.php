<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 11/09/18
 * Time: 11:28
 */

class Categories_model extends CI_Model
{
	public function get_all(){

		$this->load->database();

		$query = $this->db->get('partners_categories');
//		var_dump($query);
		return $query->result();
 
	
		
	}

}
