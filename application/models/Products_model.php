<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 23/09/18
 * Time: 20:14
 */

class Products_model extends CI_Model
{
	public function get_all_by_COM_id($memberId){
		$this->db->select('
						p.id,
						p.name,
						p.price,
						p.description
						');
		$this->db->from('products AS  p');
		$this->db->where('p.users_id', $memberId);

		$query = $this->db->get();
//		var_dump($query);
		return $query->result();
	}

	public function get_all_by_COM_id_limit(Int $memberId, Int $limit){
		$this->db->select('
						p.id,
						p.name,
						p.price,
						p.description
						');
		$this->db->from('products AS  p');
		$this->db->where('p.users_id', $memberId);
		$this->db->limit(12, $limit);
		$query = $this->db->get();
//		var_dump($query);
		return $query->result();
	}

	public function count_product(Int $id){
		$query = $this->db->where(['users_id' => $id])->from('products')->count_all_results();
		return $query;
	}
}
