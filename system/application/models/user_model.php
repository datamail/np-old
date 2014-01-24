<?php
class User_model extends Model
{
	function User_model()
	{
		parent::Model();
	}
	
	function register_user($username, $email, $password)
	{
		$sha1_password = sha1($password);
		
		$query_str = "INSERT INTO applied_users (user_name, user_email, user_password, secret_code1, secret_code2) VALUES (?, ?, ?, ?, ?)";
		$secret_code1 = rand(9999999, 9999999999999999);
		$secret_code2 = rand(9999999, 9999999999999999);
		$this->db->query($query_str, array($username, $email, $sha1_password, $secret_code1, $secret_code2));
		return ($secret_code1 . "/" . $secret_code2);
	}

	function _get_user_id($email){
		$query = $this->db->query("SELECT user_id FROM users WHERE user_email LIKE '".$email."'");
	
		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
		
		   return $row->user_id;
		}
		else {
			return false;
		}
		
	}
	
	function _get_user_details($user_id){
		$query = $this->db->query("SELECT * FROM users WHERE user_id LIKE '".$user_id."'");
	
		if ($query->num_rows() > 0)
		{
		
		   return $query;
		}
		else {
			return false;
		}
		
	}
	
	function _check_login_details($email, $password)
	{
		$user_id = $this->_get_user_id($email);
		$user_details = $this->_get_user_details($user_id);
		$row = $user_details->row_array(); 

		$enc_password = sha1($password);
		
		if($enc_password == $row['user_password'])
		{
			return(1);
		}
		else
		{
			return(0);
		}
	}
}