<?php

class Search extends Controller {
	
	//var $_base_url	= base_url();

	function Search(){
		parent::Controller();	
		
		$this->view_data['base_url'] = base_url();
                
                $this->session->set_userdata('doing_search', FALSE);
		
		$this->view_data['fb_title'] = "Number Picture";
		$this->view_data['fb_description'] = "Crowd-sourcing new ways for people to visualize data";
		$this->view_data['fb_image'] = base_url() . "img/logo.png";
	}
	
	function index(){
                $this->keywords();
        }
        
        function keywords (){
            $this->view_data['search_term'] = $this->input->post('search_words');
            $this->load->view('view_header', $this->view_data);
            $this->load->view('view_search_decision', $this->view_data);
	    $this->load->view('view_footer', $this->view_data);
        }
	
	function picture_keywords (){
		$keywords = $this->input->post("keywords");
		redirect(base_url() . 'picture/search_keywords/' . $keywords);
	}
        
}
