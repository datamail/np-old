<?php
class Template_model extends Model
{
	function Template_model()
	{
		parent::Model();
		
		$this->load->helper('date');
	}
	
        function save_template($user_id, $name, $description, $image_path, $thumb_path, $codeorfilelocation, $type, $orientation, $aspect, $discrete_inputs, $continuous_inputs, $last_edited, $open_source){
            
            $query_str = "INSERT INTO templates (user_id, name, description, image_path, thumb_path, codeorfilelocation, type, orientation, aspect, discrete_inputs, continuous_inputs, last_edited) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $now = now();
		
		$this->db->query($query_str, array($user_id, $name, $description, $image_path, $thumb_path, $codeorfilelocation, $type, $orientation, $aspect, $discrete_inputs, $continuous_inputs, $now));
        }
	
	function get_details($template_id)
	{
		$this->db->select('*')->from('templates')->where('template_id', $template_id);
		$get = $this->db->get();
		$row = $get->result_array();
		return ($row);
	}
	
	function get_user_id($template_id)
	{
		$this->db->select('user_id')->from('templates')->where('template_id', $template_id);
		$get = $this->db->get();
		$row = $get->result_array();
		return ($row[0]['user_id']);
	}
	
        
}