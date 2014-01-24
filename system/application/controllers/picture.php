<?php

class Picture extends Controller {
	
	function Picture(){
		parent::Controller();	
		
		$this->view_data['base_url'] = base_url();
		
		$this->view_data['fb_title'] = "Number Picture";
		$this->view_data['fb_description'] = "Crowd-sourcing new ways for people to visualize data";
		$this->view_data['fb_image'] = base_url() . "img/logo.png";
		
	}
	
	function index(){	
	    $this->search();
	}
        
        function new_picture($template_id)
        {
		//$this->output->enable_profiler(TRUE);
		
		require_once('/wwwroot/NumberPicture/web/recaptcha/recaptchalib.php');
		$publickey = "6Lc2U80SAAAAAI3U9WJuPh7P_sx1WffSoGfe6okB"; // you got this from the signup page
		$this->view_data['captcha'] = recaptcha_get_html($publickey);
			
            $this->load->model('Template_model');
            $this->load->helper('file');
            $this->view_data['excel_data'] = "";
            $this->view_data['processing_code'] = "";
            $this->view_data['template_id'] = $template_id;
	    
	    $this->view_data['template_data'] = $this->Template_model->get_details($template_id);
	    
	    $this->view_data['fb_title'] = "Number Picture";
	    $this->view_data['fb_description'] = "Crowd-sourcing new ways for people to visualize data";
	    $this->view_data['fb_image'] = base_url() . "template_images/" . $template_id . ".png";

            $this->form_validation->set_rules('excel_data', 'DATA',  'required|xss_clean');
	    $this->form_validation->set_rules('title', 'TITLE',  'required|xss_clean');
	    $this->form_validation->set_rules('blurb', 'BLURB',  'required|xss_clean');
	     $this->form_validation->set_rules('human', 'HUMAN TEST',  'xss_clean');
            
            if ($this->form_validation->run() == FALSE) {
                    $this->load->view('view_header', $this->view_data);
                    $this->load->view('new_picture', $this->view_data);
		    $this->load->view('view_back_to_top');
		    
                    $this->load->view('view_footer', $this->view_data);
            }
            
            elseif($this->form_validation->run() == TRUE && isset($_POST['save'])){
                    //$user_id = $this->session->userdata('user_id');
			require_once('/home/content/43/7739843/html/recaptcha/recaptchalib.php');
			$privatekey = "6Lc2U80SAAAAALT97VgouJMgCx4OpaYrHp4nbN1Y";
			$resp = recaptcha_check_answer ($privatekey,
						      $_SERVER["REMOTE_ADDR"],
						      $_POST["recaptcha_challenge_field"],
						      $_POST["recaptcha_response_field"]);
		      
			if (!$resp->is_valid) {
			  // What happens when the CAPTCHA was entered incorrectly
			  //die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
			   //    "(reCAPTCHA said: " . $resp->error . ")");
				$this->load->view('view_header', $this->view_data);
				$this->load->view('new_picture', $this->view_data);
				$this->load->view('view_back_to_top');
				
				$this->load->view('view_footer', $this->view_data);
			} else {
			  // Your code here to handle a successful verification
			
			
                    $excel_data = $this->input->post("excel_data");
		    $title = $this->input->post("title");
		    $blurb = $this->input->post("blurb");
                    $template_details = $this->Template_model->get_details($template_id);
		    
		    $canvas_width = 1000;
		    $canvas_height = 1000;
		    
		    $excel_data_clean = "String [][] data = {";
                    //echo ($excel_data);
                    $lines = explode("\n", trim($excel_data));
		    
		    $template_keyword_output = "";
		    
		    switch($template_details[0]['type']){
			case 1:
			    $template_keyword_output .= "Compare A Set Of Values";
			break;
			case 2:
			    $template_keyword_output .= "Track Rises And Falls Over Time";
			break; 
			case 3:
			    $template_keyword_output .= "Relationships Among Data Points";
			break; 
			case 4:
			    $template_keyword_output .= "Parts Of The Whole";
			break; 
			case 5:
			    $template_keyword_output .= "Analyze A Text";
			break; 
			case 6:
			    $template_keyword_output .= "See The World";
			break;
		    }
		    
		    $keyword_data = $template_keyword_output . " " . $lines[0] . " ";
		    
		      //echo $keyword_data . "<br>";
		    
		    $temp_keyword_data = explode(" ", trim($title));
		    
		    for ($c = 0; $c < count($temp_keyword_data); $c = $c +1){
			$keyword_data .= $temp_keyword_data[$c] . " ";
		    }
		    
		      //echo $keyword_data . "<br>";
		    
                    for($a = 0; $a < count($lines); $a = $a + 1)
                    {
                        $excel_data_clean .= '{"';
                        $bits_of_line[$a] = explode(" ", $lines[$a]);
                        for($b = 0; $b < count($bits_of_line[$a]); $b = $b + 1)
                        {
				if($b == 0 && $a != 0){
					$keyword_data .= $bits_of_line[$a][$b] . " ";
				}
                            $bits_of_line[$a][$b] = preg_replace('/_/', ' ', $bits_of_line[$a][$b]);
                            $excel_data_clean .= $bits_of_line[$a][$b] . '", "';
                        }
                        $excel_data_clean = substr($excel_data_clean, 0, strlen($excel_data_clean) - 4);
                        $excel_data_clean .= '"}, ';
                        
                    }
                    $excel_data_clean = substr($excel_data_clean, 0, strlen($excel_data_clean) - 2);
                    $excel_data_clean .= '};
		    int number_of_rows = data.length;
		    int number_of_columns = data[0].length;
		    String title = "' . $title . '";
		    String blurb = "' . $blurb . '";';
		    
		    $blurb = preg_replace("#/n#", " ", $blurb);
		    $blurb = preg_replace("#/t#", " ", $blurb);
		    $temp_keyword_data = explode(" ", trim($blurb));
		    
		    for ($c = 0; $c < count($temp_keyword_data); $c = $c +1){
			$keyword_data .= $temp_keyword_data[$c] . " ";
		    }
		    
		    $keyword_data_array = explode(" ", $keyword_data);
                    
                    $template_code = read_file('templates/' . $template_id . '.pde');
                    $excel_data_with_template =  $excel_data_clean . $template_code;
                    $processing_code = '<script type="application/processing" target="processing-canvas" >' . $excel_data_with_template . '</script> ';
                
                    $this->view_data['processing_code'] = $processing_code;
			
		$now = now();
		$user_id = 0;
		$is_private = 0;
		if($this->session->userdata('user_id') != NULL)
		{
			$user_id = $this->session->userdata('user_id');
			if($this->session->userdata('user_private') == 1)
			{
				$is_private = 1;
			}
			else {
				$is_private = 0;
			}
		}
		
		$query_str = "INSERT INTO pictures (template_id, user_id, title, description, type, discrete_inputs, continuous_inputs, created, is_private) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);"; // userid		
		$this->db->query($query_str, array($template_details[0]['template_id'], $user_id, $title, $blurb, $template_details[0]['type'], $template_details[0]['discrete_inputs'], $template_details[0]['continuous_inputs'], $now, $is_private));
		
		$auto_increment_id = $this->db->insert_id();
		
		for ($a = 0; $a < count($keyword_data_array); $a = $a + 1){
			if(!$keyword_data_array[$a] == ''){
				$res = preg_replace("/[^a-zA-Z0-9\s]/", "", $keyword_data_array[$a]);
				$query = "INSERT INTO picture_keywords (picture_id, keyword) VALUES ('$auto_increment_id', '$res')";
				$this->db->query($query);
			}
		    }
		
		$image = $this->input->post("save_image");
		$dataurl = str_replace(" ", "+", $image);
		$data = substr($dataurl, strpos($dataurl, ","));
		$file = fopen("picture_images/" . $auto_increment_id . ".png", "wb");
		fwrite($file, base64_decode($data));
		fclose($file);
	
		$this->save_picture_images($auto_increment_id);//generate thumbnails
		
		$query_str = "UPDATE templates SET number_of_uses = number_of_uses +1 WHERE template_id = '$template_id'";	
		$this->db->query($query_str);
                    
                redirect(base_url() . 'picture/view/' . $auto_increment_id);
			}
            }
            
            elseif ($this->form_validation->run() == TRUE) {
		
                    $excel_data = $this->input->post("excel_data");
		    $title = $this->input->post("title");
		    $blurb = $this->input->post("blurb");
                    $template_details = $this->Template_model->get_details($template_id);
		    
		    $canvas_width = 1000;
		    $canvas_height = 1000;
            
                    $excel_data_clean = "String [][] data = {";
                    //echo ($excel_data);
                    $lines = explode("\n", trim($excel_data));
                    for($a = 0; $a < count($lines); $a = $a + 1)
                    {
                        $excel_data_clean .= '{"';
                        $bits_of_line[$a] = explode(" ", $lines[$a]);
                        for($b = 0; $b < count($bits_of_line[$a]); $b = $b + 1)
                        {
                            $bits_of_line[$a][$b] = preg_replace('/_/', ' ', $bits_of_line[$a][$b]);
                            $excel_data_clean .= $bits_of_line[$a][$b] . '", "';
                        }
                        $excel_data_clean = substr($excel_data_clean, 0, strlen($excel_data_clean) - 4);
                        $excel_data_clean .= '"}, ';
                        
                    }
                    $excel_data_clean = substr($excel_data_clean, 0, strlen($excel_data_clean) - 2);
                    $excel_data_clean .= '};
		    int number_of_rows = data.length;
		    int number_of_columns = data[0].length;
		    String title = "' . $title . '";
		    String blurb = "' . $blurb . '";';
                                    
                    $template_code = read_file('templates/' . $template_id . '.pde');
                    $excel_data_with_template =  $excel_data_clean . $template_code;
                    $processing_code = '<script type="application/processing"   target="processing-canvas" >' . $excel_data_with_template . '</script> ';
                
                    $this->view_data['processing_code'] = $processing_code;
                    
                    $this->load->view('view_header', $this->view_data);
		    $this->load->view('view_font_loader');
                    $this->load->view('new_picture', $this->view_data);
		    $this->load->view('view_back_to_top');
		    
                    $this->load->view('view_footer', $this->view_data);
            }
        }
	
	function save_picture_images($picture_id)
	{
		$this->output->enable_profiler(TRUE);
		$this->load->library('image_lib');
		
		$file_path = 'picture_images/';
		$raw_name = $picture_id;
		$file_ext = '.png';
		$full_path = $file_path . $raw_name . $file_ext;
		$width = 1000;
		$height = 1000;
		
		$config['source_image']	= $full_path;
		$config['quality'] = 100;
		$config['wm_text'] = 'NumberPicture.com';
		$config['wm_type'] = 'text';
		$config['wm_font_path'] = './system/fonts/code_bold-webfont.ttf';
		$config['wm_font_size']	= '12';
		$color_rand = rand(0, 1);
		if ($color_rand == 0) {
			$config['wm_font_color'] = 'ffffff';
		}
		else {
			$config['wm_font_color'] = '000000';
		}
		$config['wm_vrt_alignment'] = 'bottom';
		$config['wm_hor_alignment'] = 'right';
		$config['wm_padding'] = '0';
		
		$this->image_lib->initialize($config); 
		
		
		$this->image_lib->watermark();
		
		$this->image_lib->clear();
		

		$config2['source_image']	= $full_path;
		$config2['new_image'] = $file_path . $raw_name . "_thumb" . $file_ext;
		$config2['width']	 = 240;
		$config2['height']	 = 240;
		$config2['maintain_ratio'] = TRUE;
		
		$this->image_lib->initialize($config2); 
		$this->image_lib->resize();
		
		$query_str = "UPDATE pictures SET image_path = '" . $raw_name . $file_ext . "' WHERE picture_id LIKE '" . $picture_id . "'";
		
		$this->db->query($query_str);
		
		$query_str = "UPDATE pictures SET thumb_path = '" . $raw_name . "_thumb" .  $file_ext . "' WHERE picture_id LIKE '" . $picture_id . "'";
		
		$this->db->query($query_str);
	}
	
	function search(){
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'picture/search/';
		$config['per_page'] = '40';
		$config['cur_tag_open'] = '&nbsp;&nbsp;<strong>';
		$config['cur_tag_close'] = '&nbsp;&nbsp;</strong>';
			
		$this->form_validation->set_rules('discrete', 'Category-type Inputs',  'trim|xss_clean');
		$this->form_validation->set_rules('continuous', 'Amount-type Inputs',  'trim|xss_clean');
		$this->form_validation->set_rules('type', 'Type',  'xss_clean');
		$this->form_validation->set_rules('orderby', 'Order',  'xss_clean');
		
		if($this->input->post("submit"))
		{
			$array_items = array('type' => '', 'discrete' => '', 'continuous' => '', 'orientation' => '', 'aspect' => '', 'orderby' => '', 'doing_search' => '');
			$this->session->unset_userdata($array_items);

			$this->session->set_userdata('doing_search', TRUE);
			$this->session->set_userdata('type', $this->input->post("type"));
			$this->session->set_userdata('discrete', $this->input->post("discrete"));
			$this->session->set_userdata('continuous', $this->input->post("continuous"));
			$this->session->set_userdata('orderby', $this->input->post("orderby"));
		}
		
		if ($this->form_validation->run() == FALSE && $this->session->userdata('doing_search') != TRUE) {
			$limit = $config['per_page'];
			$offset = $this->uri->segment(3, 0);
			$this->db->order_by('created', 'desc');
			$this->db->where('is_private !=', '1');
			$row = $this->db->get('pictures', $limit, $offset);
			
			$this->view_data['data'] = $row;
			
			$config['total_rows'] = $this->db->count_all('pictures');
			
			if($config['total_rows'] > 0)
			{
				$this->view_data['is_data'] = 1;
				$query = $this->db->query("SELECT * FROM pictures WHERE is_private LIKE '0' ORDER BY created DESC");
				$this->view_data['slideshow_start'] = $query->row();
			}
			else
			{
				$this->view_data['is_data'] = 0;
			}
			$this->pagination->initialize($config);
			$this->view_data['pagination'] = $this->pagination->create_links();
			
			$this->load->view('view_header', $this->view_data);
			$this->load->view('view_search_pictures', $this->view_data);
			$this->load->view('view_back_to_top');
			
			$this->load->view('view_footer', $this->view_data);
		}
		else{
			$type =$this->session->userdata('type');
			$discrete = $this->session->userdata('discrete');
			$continuous = $this->session->userdata('continuous');
			$orderby = $this->session->userdata('orderby');
			
			if($type == 0){
				$type_query = "(type = '1' OR type = '2' OR type = '3' OR type = '4' OR type = '5' OR type = '6')";
			}
			else{
				$type_query = "(type = '$type')";
			}
			if($continuous == "")
			{
				$continuous_query = "";
			}
			else{
				$continuous_query = " AND (continuous_inputs = '$continuous')";
			}
			if($discrete == "")
			{
				$discrete_query = "";
			}
			else{
				$discrete_query = " AND (discrete_inputs = '$discrete')";
			}
			$limit = $this->uri->segment(3, 0);
			$offset = $config['per_page'];
			
			$num_rows_query = "SELECT * FROM pictures WHERE " . $type_query . $continuous_query . $discrete_query . " AND is_private LIKE '0'";
			
			$full_query = "SELECT * FROM pictures WHERE " . $type_query . $continuous_query . $discrete_query . " AND is_private LIKE '0' ORDER BY created DESC LIMIT " . $limit . ", " . $offset;
				
			$rowsdbquery = $this->db->query($num_rows_query);
			$num_rows = $rowsdbquery->num_rows();
			$config['total_rows'] = $num_rows;
			$config['total_rows'] = $num_rows;
			$this->pagination->initialize($config);
			$this->view_data['pagination'] = $this->pagination->create_links();
			
			$dbquery = $this->db->query($full_query);
		
			if ($dbquery->num_rows > 0)
			{
				$row = $dbquery; 
				$this->view_data['is_data'] = 1; 
				$this->view_data['data'] = $row;
				$this->view_data['slideshow_start'] = $dbquery->row();
			}
			else
			{
				$this->view_data['is_data'] = 0; 
			}
			
			
			$this->load->view('view_header', $this->view_data);
			$this->load->view('view_search_pictures', $this->view_data);			
			$this->load->view('view_back_to_top');
			
			$this->load->view('view_footer', $this->view_data);
		}
	}
	
	function view ($picture_id)
	{
		$query = "SELECT * FROM pictures WHERE picture_id LIKE '$picture_id'";
		$result = $this->db->query($query);
		$this->view_data['data'] = $result->result();
		if (!$this->view_data['data'] == '')
		{
			$this->view_data ['is_data'] =  1 ;
			$this->view_data['fb_title'] = "NUMBERPICTURE.COM: " . $this->view_data['data'][0]->title;
			$this->view_data['fb_description'] = $this->view_data['data'][0]->description;
			$this->view_data['fb_image'] = base_url() . "picture_images/" . $picture_id . ".png";
		}
		else{
			$this->view_data ['is_data'] =  0 ; 
		}
		
		
		
		$this->view_data['picture_id'] = $picture_id;
		$this->load->view('view_header', $this->view_data);
		$this->load->view('view_single_picture', $this->view_data);
		
		$this->load->view('view_back_to_top');
		$this->load->view('view_footer', $this->view_data);
	}
	
	function next_picture ($picture_id){
		$all_pictures = $this->db->get('pictures');
		$last_row = $all_pictures->last_row();
		$proposed = $picture_id + 1;
		$found_match = FALSE;
		while($found_match == FALSE){
			$query = "SELECT * FROM pictures WHERE picture_id LIKE '$proposed'";
			$result = $this->db->query($query);
			if($result->num_rows() > 0){
				$row = $result->row();
				if(!$row->is_private == 1){
					redirect('picture/view/' . $proposed);
					$found_match = TRUE;
				}
				else{
					if($proposed < $last_row->picture_id)
					{
						$proposed += 1;
					}
					else{
						$proposed = 0;
					}
				}
			}
			else {
				if($proposed < $last_row->picture_id)
				{
					$proposed += 1;
				}
				else{
					$proposed = 0;
				}
			}
		}
	}
	
	function previous_picture ($picture_id){
		$all_pictures = $this->db->get('pictures');
		$first_row = $all_pictures->first_row();
		$last_row = $all_pictures->last_row();
		$proposed = $picture_id - 1;
		$found_match = FALSE;
		while($found_match == FALSE){
			$query = "SELECT * FROM pictures WHERE picture_id LIKE '$proposed'";
			$result = $this->db->query($query);
			if($result->num_rows() > 0){
				$row = $result->row();
				if(!$row->is_private == 1){
					redirect('picture/view/' . $proposed);
					$found_match = TRUE;
				}
				else{
					if($proposed > $first_row->picture_id)
					{
						$proposed -= 1;
					}
					else{
						$proposed = $last_row->picture_id;
					}
				}
			}
			else {
				if($proposed > $first_row->picture_id)
				{
					$proposed -= 1;
				}
				else{
					$proposed = $last_row->picture_id;
				}
			}
		}
	}
	
	function previous_template ($template_id){
		$all_templates = $this->db->get('templates');
		$first_row = $all_templates->first_row();
		$last_row = $all_templates->last_row();
		$proposed = $template_id - 1;
		$found_match = FALSE;
		while($found_match == FALSE){
			$query = "SELECT * FROM templates WHERE template_id LIKE '$proposed'";
			$result = $this->db->query($query);
			if($result->num_rows() > 0){
				redirect('picture/new_picture/' . $proposed);
				$found_match = TRUE;
			}
			else{
				if($proposed > $first_row->template_id)
				{
					$proposed -= 1;
				}
				else{
					$proposed = $last_row->template_id;
				}
			}
		}
	}
	
	function next_template ($template_id){
		$all_templates = $this->db->get('templates');
		$first_row = $all_templates->first_row();
		$last_row = $all_templates->last_row();
		$proposed = $template_id + 1;
		$found_match = FALSE;
		while($found_match == FALSE){
			$query = "SELECT * FROM templates WHERE template_id LIKE '$proposed'";
			$result = $this->db->query($query);
			if($result->num_rows() > 0){
				redirect('picture/new_picture/' . $proposed);
				$found_match = TRUE;
			}
			else{
				if($proposed < $first_row->template_id)
				{
					$proposed += 1;
				}
				else{
					$proposed = $first_row->template_id;
				}
			}
		}
	}
	
	function search_keywords($keywords)
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'picture/search_keywords/' . $keywords . '/';
		$config['per_page'] = '40';
		$config['uri_segment'] = '4';
		$config['cur_tag_open'] = '&nbsp;&nbsp;<strong>';
		$config['cur_tag_close'] = '&nbsp;&nbsp;</strong>';
		$this->view_data['is_data'] = FALSE;
		
		if($this->session->userdata('doing_search') == FALSE){
		$keyword = explode(" ", $keywords);
		$id_list = array();
		$id_list_counter = 0;
		for($a = 0; $a < count($keyword); $a = $a + 1)
		{
			$query = "SELECT DISTINCT picture_id FROM picture_keywords WHERE keyword LIKE '$keyword[$a]'";
			$dbquery = $this->db->query($query);
			$num_rows = $dbquery->num_rows();
			print_r($dbquery->row_data);
			for ($b = 0; $b < $num_rows; $b = $b + 1){
				$row = $dbquery->row($b);
				$id_list[$id_list_counter] = $row->picture_id;
				$id_list_counter = $id_list_counter + 1;
			}
			
		}
			$this->session->set_userdata('search_id_list', $id_list);
			$this->session->set_userdata('doing_search', TRUE);
		}
		
		$id_list = $this->session->userdata('search_id_list');
		if(count($id_list) > 0){
			$this->view_data['is_data'] = TRUE;
		}
		
		
		$total_shown = $this->uri->segment(4, 0);
		
		$config['total_rows'] = count($this->session->userdata('search_id_list'));
		$this->pagination->initialize($config);
		$this->view_data['pagination'] = $this->pagination->create_links();
	
		$view_id_list = array();
		for($a = 0; $a < $config['total_rows'] - $total_shown; $a = $a + 1)
		{
			$view_id_list[$a] = $id_list[$total_shown + $a];
		}
		
		//clean up view id list - duplicates
		$view_data = array();
		
		for ($b = 0; $b < count($view_id_list); $b = $b + 1){
			$query = "SELECT * FROM pictures WHERE picture_id LIKE '$view_id_list[$b]' AND is_private LIKE '0' ORDER BY created DESC";
			$view_data[$b] = $this->db->query($query)->row();
		}
		
		$this->view_data['data'] = $view_data;
		
		$this->load->view('view_header', $this->view_data);
		$this->load->view('view_search_pictures_keywords', $this->view_data);
		$this->load->view('view_back_to_top');
		
		$this->load->view('view_footer', $this->view_data);
		
	}
    }