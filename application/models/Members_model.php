<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 11/09/18
 * Time: 11:28
 */

class Members_model extends CI_Model
{
	public function retrieveMemberProfile($aCredentials){

		$this->load->database();

		$query = "
					SELECT 
						u.*, 
						r.short_name role, 
						r.long_name role_long_name 
					FROM 
						`users` u 
					INNER JOIN 
						`roles` r 
					ON 
						u.roles_id = r.id 
					WHERE 
						u.pseudo = ?
				";
		/*
		 * 	We search for user with password in $aCredentials has two entries
		 */
		if(count($aCredentials) == 2){
			$query.= "	AND
						u.password = ?
				";
		}


		if ( ! $query = $this->db->query($query, $aCredentials)){

			$this->load->helper('url');
			$error = $this->db->error(); // Has keys 'code' and 'message';
			redirect('errors/database', 'location', $error['code']);
		}
		else{
//			var_dump($this->db->last_query());
//			die();
			return $query->row();
		}
	}

	public function valid_current_password(){
		var_dump("hello world !!");
		$this->set_error('valid_current_password', 'your error message');
		return false;
	}

}
