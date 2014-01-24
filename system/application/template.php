<?php

class Template extends Controller {
	
	function Template(){
		parent::Controller();	
		
		$this->view_data['base_url'] = base_url();
		
		$this->view_data['fb_title'] = "Home";
		$this->view_data['fb_description'] = "Number Picture";
		$this->view_data['fb_image'] = base_url() . "img/logo.jpg";
		
	}
	
	function index(){	
		$this->load->view('view_header', $this->view_data);
		$this->load->view('view_home');
		
		$this->load->view('view_footer');
	}
	
	function new_template(){
            if($this->session->userdata('logged_in') == TRUE)
	    {
		$this->view_data['processing_code'] = "";
		$this->view_data['example_data_table'] = "";
		
		$template_type = 1;
		$template_number_discrete = 2;
		$template_number_continuous = 2;
		
		$short_side = 1000;
		$long_side = 1000;
		$canvas_width = $short_side;
		$canvas_height = $long_side;
		$background_colour = 0;
		$fill_colour = 255;
		$stroke_colour = 255;
		$font = 'courier';		
	
		$this->form_validation->set_rules('edit_template_code', 'CODE',  'trim|required|xss_clean|callback_user_code_check');
		$this->form_validation->set_rules('edit_template_discrete', 'NUMBER CATEGORY-TYPE INPUTS', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('edit_template_continuous', 'NUMBER AMOUNT-TYPE INPUTS', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('edit_template_type', 'TYPE OF DATA', 'trim|required|xss_clean');
		$this->form_validation->set_rules('edit_template_notes', 'TEMPLATE NOTES', 'xss_clean');
		$this->form_validation->set_rules('edit_template_map_name', 'MAP', 'trim|xss_clean');

		
		
		if ($this->form_validation->run() == FALSE) {
			
			$random_data = $this->generate_random_data($template_type, $template_number_discrete, $template_number_continuous);
			$example_data_table = $random_data['example_data_table'];
			$this->view_data['example_data_table'] = $example_data_table;
			$this->view_data['imageurl'] = $this->session->userdata('imageurl');
			$processing_data_string = $random_data['processing_data_string'];
			$this->load->view('view_header', $this->view_data);
			$this->load->view('view_font_loader', $this->view_data);
			$this->load->view('new_template', $this->view_data);
			$this->load->view('view_back_to_top');
			$this->load->view('view_footer', $this->view_data);
		}
		
		elseif($this->form_validation->run() == TRUE && isset($_POST['save'])){
			
			$code_from_user = $this->input->post("edit_template_code");	
			$template_number_discrete = $this->input->post("edit_template_discrete");
			$template_number_continuous = $this->input->post("edit_template_continuous");
			$template_type = $this->input->post("edit_template_type");
			$template_notes = $this->input->post("edit_template_notes");
			
			$canvas_width = 1000;
			$canvas_height = 1000;
		
			$auto_setup_code = 'void setup()  
{  
	size(' . $canvas_width . ',' . $canvas_height . ');  
	background(' . $background_colour . ');
	smooth();
	fill(255);  
	noLoop();
	noStroke();
	PFont fontA = loadFont("' . $font . '");  
	textFont(fontA, 14);     
}  
	  
void draw(){
';
				$auto_end_code = '
}
void textblock(String textblockstring, int textblockx, int textblocky, int textblockwidth)
{
	String [] textblock = split(textblockstring, " ");
	float textblockw = 0;
	float textblockynow = textblocky;
	for(int a = 0; a < textblock.length; a++)
	{
		textblockw += textWidth(textblock[a] + " ");
		if(textblockw > textblockwidth)
		{
			textblockynow += 15;
			textblockw = textWidth(textblock[a] + " ");
		}	
		text(textblock[a]+ " ", textblockw + textblockx - textWidth(textblock[a] + " "), textblockynow);
	}
} ';
			$processing_code = $auto_setup_code . $code_from_user . $auto_end_code;

			$this->load->helper('date');
			$this->load->helper('file');
			$now = now();

			$query_str = "INSERT INTO templates (type, user_id, discrete_inputs, continuous_inputs, notes, last_edited) VALUES (?, ?, ?, ?, ?, ?);"; 		
			$this->db->query($query_str, array($template_type, $this->session->userdata('user_id'), $template_number_discrete, $template_number_continuous, $template_notes, $now)); 
			
			$auto_increment_id = $this->db->insert_id();
			
			write_file('templates/' . $auto_increment_id . '.pde', $processing_code);
			write_file('templates/' . $auto_increment_id . 'usercode.pde', $code_from_user);
			
			
			$image = $this->input->post("save_image");
			$dataurl = str_replace(" ", "+", $image);
			$data = substr($dataurl, strpos($dataurl, ","));
			$file = fopen("template_images/" . $auto_increment_id . ".png", "wb");
			fwrite($file, base64_decode($data));
			fclose($file);
			
			//generate thumbnails
			$this->save_template_images($auto_increment_id);
			
			redirect(base_url() . 'picture/new_picture/' . $auto_increment_id);
		}
		
		elseif ($this->form_validation->run() == TRUE){
			$code_from_user = $this->input->post("edit_template_code");	
			$template_number_discrete = $this->input->post("edit_template_discrete");
			$template_number_continuous = $this->input->post("edit_template_continuous");
			$template_type = $this->input->post("edit_template_type");
			
			$random_data = $this->generate_random_data($template_type, $template_number_discrete, $template_number_continuous);
			$example_data_table = $random_data['example_data_table'];
			$this->view_data['example_data_table'] = $example_data_table;
			$processing_data_string = $random_data['processing_data_string'];
		
			$canvas_width = 1000;
			$canvas_height = 1000;
			
		
			$auto_setup_code = $processing_data_string . '  void setup()  
				{			  
				  size(' . $canvas_width . ',' . $canvas_height . ');  
				  background(' . $background_colour . ');
				  smooth();
				  fill(255);  
				  noLoop();
				  noStroke();    
				}  
				  
				void draw(){';
			$auto_end_code = ' }void textblock(String textblockstring, int textblockx, int textblocky, int textblockwidth)
				{
				String [] textblock = split(textblockstring, " ");
				float textblockw = 0;
				float textblockynow = textblocky;
				for(int a = 0; a < textblock.length; a++)
				{
				textblockw += textWidth(textblock[a] + " ");
				if(textblockw > textblockwidth)
				{
				  textblockynow += 15;
				  textblockw = textWidth(textblock[a] + " ");
				}
				
				text(textblock[a]+ " ", textblockw + textblockx - textWidth(textblock[a] + " "), textblockynow);
				}
				}';
			$all_auto_code =  $auto_setup_code . $code_from_user . $auto_end_code;
			$processing_code = '<script type="application/processing"   target="processing_canvas" >' . $all_auto_code . '</script> ';
		    
			$this->view_data['processing_code'] = $processing_code;
			$this->view_data['example_data_table'] = $example_data_table;
			$this->view_data['imageurl'] = $this->session->userdata('imageurl');
			$this->load->view('view_header', $this->view_data);
			$this->load->view('view_font_loader', $this->view_data);
			$this->load->view('new_template', $this->view_data);
			$this->load->view('view_back_to_top');
			$this->load->view('view_footer', $this->view_data);
		}
	    }
	    else{
		$this->session->set_userdata('redirect', 'template/new_template');
		redirect('user/login');
	    }
	}
	
	function user_code_check($str)
	{
		$pos1 = strpos(strtolower($str), ';size(');
		$pos2 = strpos(strtolower($str), ';link(');
		$pos3 = strpos(strtolower($str), ';saveStrings(');
		$pos4 = strpos(strtolower($str), ';loadBytes(');
		$pos5 = strpos(strtolower($str), ';loadStrings(');
		$pos6 = strpos(strtolower($str), ';save(');
		$pos7 = strpos(strtolower($str), ';saveFrame(');
		$pos8 = strpos(strtolower($str), ';saveStrings(');

		if(!$pos1 === false) {
			$this->form_validation->set_message('user_code_check', 'Sorry, but you may not use the size() function');
			return FALSE;
		}

		elseif(!$pos2 === false) {
			$this->form_validation->set_message('user_code_check', 'Sorry, but you may not use the link() function');
			return FALSE;
		}

		elseif(!$pos3 === false) {
			$this->form_validation->set_message('user_code_check', 'Sorry, but you may not use the saveStrings() function');
			return FALSE;
		}

		elseif(!$pos4 === false) {
			$this->form_validation->set_message('user_code_check', 'Sorry, but you may not use the loadBytes() function');
			return FALSE;
		}

		elseif(!$pos5 === false) {
			$this->form_validation->set_message('user_code_check', 'Sorry, but you may not use the loadStrings() function');
			return FALSE;
		}

		elseif(!$pos6 === false) {
			$this->form_validation->set_message('user_code_check', 'Sorry, but you may not use the save() function');
			return FALSE;
		}

		elseif(!$pos7 === false) {
			$this->form_validation->set_message('user_code_check', 'Sorry, but you may not use the saveFrame() function');
			return FALSE;
		}

		elseif(!$pos8 === false) {
			$this->form_validation->set_message('user_code_check', 'Sorry, but you may not use the saveStrings() function');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	
	
	function generate_random_data($template_type, $template_number_discrete, $template_number_continuous){
		$example_data_num_rows = rand(1, 50);
		$example_data_num_columns = $template_number_discrete + $template_number_continuous;
		$example_data_table = '';
            
		$processing_data_string = 'String data [][] = {';
		if($template_type == 1 || $template_type == 3 || $template_type == 4)
		{
			$processing_data_string .= '{';
			for($columns = 1; $columns < $example_data_num_columns+1; $columns = $columns +1){
				$example_data_table .= '|&nbsp;&nbsp;';
					if($columns < $template_number_discrete + 1)
					{
						$column_title = 'Cat/Name Col ' . $columns . " [" . ($columns - 1) . "]" ;
						$column_title_clean = $column_title;
					}else{
						$column_title = '&nbsp;&nbsp;Number Col ' . ($columns - $template_number_discrete) . " [" . ($columns - 1) . "]&nbsp;&nbsp;&nbsp;";
						$column_title_clean = 'Num Col ' . $columns . " [" . $columns . "]";
					}
				$example_data_table .= $column_title . '&nbsp;&nbsp;';
				$processing_data_string .= '"' . $column_title_clean . '",';
			}
			$processing_data_string = substr($processing_data_string, 0, strlen($processing_data_string) - 1);
			$processing_data_string .= '},';
			
			//$example_data_table = substr($example_data_table, 0, strlen($example_data_table) - 36);
			$example_data_table .= '|<br />';
				
			for($rows = 1; $rows < $example_data_num_rows+1; $rows = $rows +1){
				$processing_data_string .= '{';
				
				for($columns = 1; $columns < $example_data_num_columns+1; $columns = $columns +1){
					$example_data_table .= '';
					if($columns < $template_number_discrete + 1)
					{
						${$rows . '_' . $columns} = 'Cat/Name ' . rand(1, 10);
						${$rows . '_' . $columns . '_clean'} = 'Cat/Name ' . rand(1, 10);
					}else{
						${$rows . '_' . $columns} = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . rand(1, 10000) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					${$rows . '_' . $columns . '_clean'} = rand(1, 10000);
					}
					$example_data_table .= "|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . ${$rows . '_' . $columns} . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					$processing_data_string .= '"' . ${$rows . '_' . $columns . '_clean'} . '",';
				}
				$example_data_table .= '|<br>';
				$processing_data_string = substr($processing_data_string, 0, strlen($processing_data_string) - 1);
				$processing_data_string .= '},';
			}
			$processing_data_string = substr($processing_data_string, 0, strlen($processing_data_string) - 1);
			$processing_data_string .= '};';
		}
		elseif($template_type == 2)
		{
			$processing_data_string .= '{"Date [0]", ';
			$example_data_table = "|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date [0]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			
			for($columns = 1; $columns < $example_data_num_columns+1; $columns = $columns +1){
				$example_data_table .= '|';
					if($columns < $template_number_discrete + 1)
					{
						$column_title = '&nbsp;&nbsp;Cat/Name Col ' . $columns . " [" . $columns . "]";
						$column_title_clean = 'Cat/Name Col ' . $columns . " [" . $columns . "]";
					}else{
						$column_title = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Num Col ' . ($columns - $template_number_discrete) . " [" . $columns . "]";
						$column_title_clean = 'Num Col ' . $columns . " [" . $columns . "]";
					}
				$example_data_table .= $column_title . '&nbsp;';
				$processing_data_string .= '"' . $column_title_clean . '",';
			}
			$processing_data_string = substr($processing_data_string, 0, strlen($processing_data_string) - 1);
			$processing_data_string .= '},';
			
			$example_data_table .= "|<br>";
			
			$random_year = rand(1950, 2050);
			
			for($rows = 1; $rows < $example_data_num_rows+1; $rows = $rows +1){
				$processing_data_string .= '{"' . $random_year . '", ';
				$example_data_table .= "|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $random_year . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				for($columns = 1; $columns < $example_data_num_columns+1; $columns = $columns +1){
					if($columns < $template_number_discrete + 1)
					{
						${$rows . '_' . $columns} = "Cat/Name " . rand(1, 10);
						${$rows . '_' . $columns . '_clean'} = "Cat/Name " . rand(1, 10);
					}else{
						${$rows . '_' . $columns} = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . rand(1, 10000) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						${$rows . '_' . $columns . '_clean'} = rand(1, 10000);	
					}
					$example_data_table .= "|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . ${$rows . '_' . $columns} . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					$processing_data_string .= '"' . ${$rows . '_' . $columns . '_clean'} . '",';
					
				}
				$random_year += 1;
				$example_data_table .= '|<br />';
				$processing_data_string = substr($processing_data_string, 0, strlen($processing_data_string) - 1);
				$processing_data_string .= '},';
			}
			$processing_data_string = substr($processing_data_string, 0, strlen($processing_data_string) - 1);
			$processing_data_string .= '};';
		}
		elseif($template_type == 5)
		{
			$this->load->helper('string');
			$rand = rand(10, 152);
			$processing_data_string = 'String data [] = {';
			$number_picture = 'A number is a mathematical object used to count and measure. A notational symbol that represents a number is called a numeral but in common use, the word number can mean the abstract object, the symbol, or the word for the number. A picture may be two-dimensional, such as a photograph, screen display, and as well as a three-dimensional, such as a statue or hologram. They may be captured by optical devices-such as cameras, mirrors, lenses, telescopes, microscopes, etc. and natural objects and phenomena, such as the human eye or water surfaces.
The word picture is also used in the broader sense of any two-dimensional figure such as a map, a graph, a pie chart, or an abstract painting. In this wider sense, images can also be rendered manually, such as by drawing, painting, carving, rendered automatically by printing or computer graphics technology, or developed by a combination of methods, especially in a pseudo-photograph.';
			$number_picture_exploded = explode(" ", $number_picture);
			for($rows = 0; $rows < $rand; $rows = $rows+1){
				
			
					${'value_' . $rows} = $number_picture_exploded[$rows];
					
					$example_data_table .= ${'value_' . $rows} . ' ';
					$processing_data_string .= '"' . ${'value_' . $rows} . '", ';
			}
			$processing_data_string = substr($processing_data_string, 0, strlen($processing_data_string) - 2);
			$processing_data_string .= '};';
		}
		else{
			$processing_data_string .= '};';//predefined arrays for different places
		}
		$processing_data_string .= '
						int number_of_rows = data.length;
						int number_of_columns = data[0].length;
						String title = "This Is The Title";
						String blurb = "this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb this is the blurb ";';
		$return = array('example_data_table' => $example_data_table, 'processing_data_string' => $processing_data_string);
		return $return;
	}
	
	function edit_template($template_id)
	{
	    $this->load->model('Template_model');
	    if($this->session->userdata('logged_in') == TRUE && $this->session->userdata('user_id') == $this->Template_model->get_user_id($template_id))
	    {
		$this->view_data['template_id'] = $template_id;
		$this->load->helper('file');
		//check is logged in
		$this->view_data['processing_code'] = "";
		$this->view_data['example_data_table'] = "";
		$this->view_data['details'][0] = array('continuous_inputs' => '', 'discrete_inputs' => '', 'type' => '',  'notes' => '', 'name' => '', 'description' => '', 'last_edited' => '');
		$this->view_data['code'] = "";
		$this->view_data['discrete'] = '';
		
		$template_type = 1;
		$template_number_discrete = 2;
		$template_number_continuous = 2;
		
		$short_side = 1000;
		$long_side = 1000;
		$canvas_width = $short_side;
		$canvas_height = $long_side;
		$background_colour = 0;
		$fill_colour = 255;
		$stroke_colour = 255;
		$font = 'courier';		
	
		$this->form_validation->set_rules('edit_template_code', 'CODE',  'trim|required|xss_clean|callback_user_code_check');
		$this->form_validation->set_rules('edit_template_discrete', 'NUMBER CATEGORY-TYPE INPUTS', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('edit_template_continuous', 'NUMBER AMOUNT-TYPE INPUTS', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('edit_template_type', 'TYPE OF DATA', 'trim|required|xss_clean');
		$this->form_validation->set_rules('edit_template_map_name', 'MAP', 'trim|xss_clean');
		$this->form_validation->set_rules('edit_template_notes', 'TEMPLATE NOTES', 'xss_clean');
		
			if ($this->form_validation->run() == FALSE) {
				if($_POST){
					$this->view_data['code'] = '';
					$this->view_data['type'] = '';
					$this->view_data['continuous'] = '';
					$this->view_data['discrete'] = '';
					$this->view_data['notes'] = '';
				}
				else{
					$this->view_data['code'] = read_file('templates/' . $template_id . 'usercode.pde');
					$this->view_data['details'] = $this->Template_model->get_details($template_id);
				} 
				$random_data = $this->generate_random_data($template_type, $template_number_discrete, $template_number_continuous);
				$example_data_table = $random_data['example_data_table'];
				$this->view_data['example_data_table'] = $example_data_table;
				$processing_data_string = $random_data['processing_data_string'];
				$this->load->view('view_header', $this->view_data);
				$this->load->view('view_font_loader', $this->view_data);
				$this->load->view('edit_template', $this->view_data);
				$this->load->view('view_back_to_top');
				$this->load->view('view_footer', $this->view_data);
			}
		
		
		elseif($this->form_validation->run() == TRUE && isset($_POST['save'])){
			$code_from_user = $this->input->post("edit_template_code");	
			$template_number_discrete = $this->input->post("edit_template_discrete");
			$template_number_continuous = $this->input->post("edit_template_continuous");
			$template_type = $this->input->post("edit_template_type");
			$template_notes = $this->input->post("edit_template_notes");
			
			$canvas_width = 1000;
			$canvas_height = 1000;
		
			$auto_setup_code = 'void setup()  
{  
	size(' . $canvas_width . ',' . $canvas_height . ');  
	background(' . $background_colour . ');
	smooth();
	fill(255);  
	noLoop();
	noStroke();    
}  
	  
void draw(){
';
				$auto_end_code = '
}
				
void textblock(String textblockstring, int textblockx, int textblocky, int textblockwidth)
{
	String [] textblock = split(textblockstring, " ");
	float textblockw = 0;
	float textblockynow = textblocky;
	for(int a = 0; a < textblock.length; a++)
	{
		textblockw += textWidth(textblock[a] + " ");
		if(textblockw > textblockwidth)
		{
			textblockynow += 15;
			textblockw = textWidth(textblock[a] + " ");
		}
		text(textblock[a]+ " ", textblockw + textblockx - textWidth(textblock[a] + " "), textblockynow);
	}
}';
			$processing_code = $auto_setup_code . $code_from_user . $auto_end_code;

			$this->load->helper('date');
			$this->load->helper('file');
			$now = now();
			
			$query_str = "UPDATE templates SET type = '$template_type', discrete_inputs = '$template_number_discrete', continuous_inputs = '$template_number_continuous', notes = '$template_notes', last_edited = '$now' WHERE template_id = '$template_id'"; 
			
			$this->db->query($query_str);
			
			write_file('templates/' . $template_id . '.pde', $processing_code);
			write_file('templates/' . $template_id . 'usercode.pde', $code_from_user);
			
			$image = $this->input->post("save_image");
			$dataurl = str_replace(" ", "+", $image);
			$data = substr($dataurl, strpos($dataurl, ","));
			$file = fopen("template_images/" . $template_id . ".png", "wb");
			fwrite($file, base64_decode($data));
			fclose($file);
			
			//generate thumbnails
			$this->save_template_images($template_id);
			///////////
			
			redirect('picture/new_picture/' . $template_id);
		}
		
		elseif ($this->form_validation->run() == TRUE){
			$this->view_data['type'] = '';
			$this->view_data['continuous'] = '';
			$this->view_data['discrete'] = '';
			$code_from_user = $this->input->post("edit_template_code");	
			$template_number_discrete = $this->input->post("edit_template_discrete");
			$template_number_continuous = $this->input->post("edit_template_continuous");
			$template_type = $this->input->post("edit_template_type");
			
			$random_data = $this->generate_random_data($template_type, $template_number_discrete, $template_number_continuous);
			$example_data_table = $random_data['example_data_table'];
			$this->view_data['example_data_table'] = $example_data_table;
			$processing_data_string = $random_data['processing_data_string'];
				
			$canvas_width = 1000;
			$canvas_height = 1000;
			
			$auto_setup_code = $processing_data_string . '  void setup()  
				{
				  size(' . $canvas_width . ',' . $canvas_height . ');  
				  background(' . $background_colour . ');
				  smooth();
				  fill(255);  
				  noLoop();
				  noStroke();    
				}  
				  
				void draw(){';
			$auto_end_code = ' }void textblock(String textblockstring, int textblockx, int textblocky, int textblockwidth)
				{
				String [] textblock = split(textblockstring, " ");
				float textblockw = 0;
				float textblockynow = textblocky;
				for(int a = 0; a < textblock.length; a++)
				{
				textblockw += textWidth(textblock[a] + " ");
				if(textblockw > textblockwidth)
				{
				  textblockynow += 15;
				  textblockw = textWidth(textblock[a] + " ");
				}
				
				text(textblock[a]+ " ", textblockw + textblockx - textWidth(textblock[a] + " "), textblockynow);
				}
				}';
			$all_auto_code =  $auto_setup_code . $code_from_user . $auto_end_code;
			$processing_code = '<script type="application/processing"   target="processing_canvas" >' . $all_auto_code . '</script> ';
		    
			$this->view_data['processing_code'] = $processing_code;
			$this->view_data['example_data_table'] = $example_data_table;
			$this->view_data['imageurl'] = $this->session->userdata('imageurl');
			$this->load->view('view_header', $this->view_data);
			$this->load->view('view_font_loader', $this->view_data);
			$this->load->view('edit_template', $this->view_data);
			$this->load->view('view_back_to_top');
			$this->load->view('view_footer', $this->view_data);
		}
		
	    }
	    else{
		$this->session->set_userdata('redirect', 'template/edit_template/' . $template_id);
		redirect('user/login');
	    }
	}
	
	function search(){
		$this->output->enable_profiler(TRUE);
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'template/search/';
		$config['per_page'] = '12';
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
			$this->db->orderby('last_edited', 'DESC');
			$get = $this->db->get('templates', $limit, $offset);
			
			$this->view_data['data'] = $get;
			
			$config['total_rows'] = $this->db->count_all('templates');
			
			if($config['total_rows'] > 0)
			{
				$this->view_data['is_data'] = 1;
				$query = $this->db->query("SELECT * FROM templates ORDER BY last_edited DESC");
				$this->view_data['slideshow_start'] = $query->row();
			}
			else
			{
				$this->view_data['is_data'] = 0;
			}
			$this->pagination->initialize($config);
			$this->view_data['pagination'] = $this->pagination->create_links();
			
			$this->load->view('view_header', $this->view_data);
			$this->load->view('view_search_templates', $this->view_data);
			
			$this->load->view('view_footer', $this->view_data);
		}
		else{
			$type =$this->session->userdata('type');
			$discrete = $this->session->userdata('discrete');
			$continuous = $this->session->userdata('continuous');
			$orderby = $this->session->userdata('orderby');
			
			
			$this->db->select('*');
			
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
			
			$num_rows_query = "SELECT * FROM templates WHERE " . $type_query . $continuous_query . $discrete_query;			
			$full_query = "SELECT * FROM templates WHERE " . $type_query . $continuous_query . $discrete_query . " ORDER BY last_edited " . $orderby  . " LIMIT " . $limit . ", " . $offset;	
			
			$rowsdbquery = $this->db->query($num_rows_query);
			$num_rows = $rowsdbquery->num_rows();
			$config['total_rows'] = $num_rows;
			$config['total_rows'] = $num_rows;
			$this->pagination->initialize($config);
			$this->view_data['pagination'] = $this->pagination->create_links();
			
			$dbquery = $this->db->query($full_query);
		
			if ($dbquery->num_rows > 0)
			{
				$this->view_data['slideshow_start'] = $dbquery->row();
				$row = $dbquery; 
				$this->view_data['is_data'] = 1; 
				$this->view_data['data'] = $row;
			}
			else
			{
				$this->view_data['is_data'] = 0; 
			}
			
			
			$this->load->view('view_header', $this->view_data);
			$this->load->view('view_search_templates', $this->view_data);
			$this->load->view('view_back_to_top');
			
			$this->load->view('view_footer', $this->view_data);
		}
	}
	
	function save_template_images($template_id)
	{
		$this->load->library('image_lib');
		
		$file_path = 'template_images/';
		$raw_name = $template_id;
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
		
		$query_str = "UPDATE templates SET image_path = '" . $raw_name . $file_ext . "' WHERE template_id LIKE '" . $template_id . "'";
		
		$this->db->query($query_str);
		
		$query_str = "UPDATE templates SET thumb_path = '" . $raw_name . "_thumb" .  $file_ext . "' WHERE template_id LIKE '" . $template_id . "'";
		
		$this->db->query($query_str);
	}
	
	function search_keywords($keywords)
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'template/search_keywords/' . $keywords . '/';
		$config['per_page'] = '12';
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
			$query = "SELECT DISTINCT template_id FROM template_keywords WHERE keyword LIKE '$keyword[$a]'";
			$dbquery = $this->db->query($query);
			$num_rows = $dbquery->num_rows();
			print_r($dbquery->row_data);
			for ($b = 0; $b < $num_rows; $b = $b + 1){
				$row = $dbquery->row($b);
				$id_list[$id_list_counter] = $row->template_id;
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
		
		$page = $this->uri->segment(4, 0);
		$total_shown = $config['per_page'] * $page;
		
		$config['total_rows'] = count($this->session->userdata('search_id_list'));
		$this->pagination->initialize($config);
		$this->view_data['pagination'] = $this->pagination->create_links();
	
		$view_id_list = array();
		for($a = 0; $a < $config['total_rows'] - $total_shown; $a = $a + 1)
		{
			$view_id_list[$a] = $id_list[$a];
		}
		
		//clean up view id list - duplicates
		$view_data = array();
		
		for ($b = 0; $b < count($view_id_list); $b = $b + 1){
			$query = "SELECT * FROM templates WHERE template_id LIKE '$view_id_list[$b]'";
			$view_data[$b] = $this->db->query($query)->row();
			
		}
		
		$this->view_data['data'] = $view_data;
		
		$this->load->view('view_header', $this->view_data);
		$this->load->view('view_search_templates_keywords', $this->view_data);
		$this->load->view('view_back_to_top');
		
		$this->load->view('view_footer', $this->view_data);
		
	}
	
	function view_template_source($template_id){
		$this->load->helper('file');
		$this->view_data['template_id'] = $template_id;
		$this->view_data['source'] = read_file('./templates/' . $template_id . 'usercode.pde');
		$this->load->view('view_header', $this->view_data);
		$this->load->view('view_template_source', $this->view_data);
		$this->load->view('view_back_to_top', $this->view_data);
		$this->load->view('view_footer', $this->view_data);
	}
	
}