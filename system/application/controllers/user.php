<?php

class User extends Controller {
	

	function User(){
		parent::Controller();	
		
		$this->view_data['base_url'] = base_url();	
		
		$this->load->model('User_model');
		
		$this->view_data['fb_title'] = "Number Picture";
		$this->view_data['fb_description'] = "Crowd-sourcing new ways for people to visualize data";
		$this->view_data['fb_image'] = base_url() . "img/logo.png";
	}
	
	function index(){
		$this->login();
	}
	
	function register(){
		if($this->session->userdata('logged_in') == FALSE)
		{
			require_once('/wwwroot/NumberPicture/web/recaptcha/recaptchalib.php');
			$publickey = "6Lc2U80SAAAAAI3U9WJuPh7P_sx1WffSoGfe6okB"; // you got this from the signup page
			$this->view_data['captcha'] = recaptcha_get_html($publickey);
			
			$this->load->library('form_validation');
			//$this->load->helper('captcha');
			/*$vals = array(
			    'img_path'	 => './captcha/',
			    'img_url'	 => 'http://numberpicture.com/captcha/',
			    'font_path'	 => './system/fonts/code_bold-webfont.ttf',
			    'img_width'	 => '170',
			    'img_height' => 40
			    );
			
			$cap = create_captcha($vals);
			
			$data = array(
			    'captcha_time'	=> $cap['time'],
			    'ip_address'	=> $this->input->ip_address(),
			    'word'	 => $cap['word']			    
			    );
			
			$query = $this->db->insert_string('captcha', $data);
			$this->db->query($query);
			$this->view_data['cap_image'] = $cap['image'];
			*/
			$this->form_validation->set_rules('reg_username', 'Username', 'trim|required|min_length[8]|xss_clean');
			$this->form_validation->set_rules('reg_email', 'Email', 'trim|required|valid_email|xss_clean|callback_user_email_exists');
			$this->form_validation->set_rules('reg_password', 'Password', 'trim|required|alpha_numeric|min_length[8]|xss_clean');
			$this->form_validation->set_rules('reg_password_conf', 'Password Confirm', 'matches[reg_password]|xss_clean');
			//$this->form_validation->set_rules('captcha', 'CAPTCHA', 'callback_check_captcha|xss_clean');
			
			
			if($this->form_validation->run() == FALSE)
			{
				//hasnt been run or validation errors
				$this->load->view('view_header', $this->view_data);
				$this->load->view('view_register', $this->view_data);
				
				$this->load->view('view_footer');
				
			}
			else
			{
				//all good - process form - input into db
				require_once('/wwwroot/NumberPicture/web/recaptcha/recaptchalib.php');
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
					$this->load->view('view_register', $this->view_data);
					$this->load->view('view_footer');
				} else {
					
				$username = $this->input->post('reg_username');
				$email = $this->input->post('reg_email');
				$password = $this->input->post('reg_password');
				$redirect = $this->input->post('redirect');
				
				$secret_code_string = $this->User_model->register_user($username, $email, $password);
				$this->load->library('email');
				$mailConfig['protocol'] = "smtp";
				$mailConfig['smtp_host'] = "smtpout.europe.secureserver.net";
				$mailConfig['smtp_user'] = "hello@numberpicture.com";
				$mailConfig['smtp_pass'] = "panther1";
				$mailConfig['smtp_port'] = "80";
				$mailConfig['mailtype'] = "text";
				$mailConfig['validate'] = "TRUE";
				$this->email->initialize($mailConfig);

				$this->email->from('hello@numberpicture.com', 'Number Picture');
				$this->email->bcc('hello@numberpicture.com');
				$this->email->to($email);
				
				$this->email->subject('Confirm your registration');
				$this->email->message('Dear ' . $username . ". Thanks for registering with Number Picture. To activate your account please go to the address:" . base_url() . "user/confirm_register/" . $secret_code_string . "/0 - Happy Visualizing!"); //And if privacy is an issue then you can also sign up for a private account by going to the address:" . base_url() . "user/confirm_register/" . $secret_code_string . "/1");	
				
				$this->email->send();
				$this->load->view('view_header', $this->view_data);
				$this->load->view('view_register_thanks', $this->view_data);
				$this->load->view('view_footer');
				}
			}
		}
		else{
			$this->session->set_userdata('redirect', 'user/register');
			redirect('user/already_logged_in');
		}


	}
	
	function confirm_register($secret_code1, $secret_code2, $redirect){
		$query1 = $this->db->query("SELECT * FROM applied_users WHERE secret_code1 LIKE '$secret_code1'");
		$query2 = $this->db->query("SELECT * FROM applied_users WHERE secret_code2 LIKE '$secret_code2'");
		if($query1->num_rows() > 0 && $query2->num_rows() > 0){
			$result1 = $query1->result();
			$result2 = $query2->result();
			if($result1[0]->applied_user_id == $result2[0]->applied_user_id){
				$update_query = "INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)";
				$this->db->query($update_query, array($result1[0]->user_name, $result1[0]->user_email, $result1[0]->user_password));
				$auto_increment_id = $this->db->insert_id();
				$user_email_to_delete = $result1[0]->user_name;
				$delete_query = "DELETE FROM applied_users WHERE user_email LIKE '$user_email_to_delete' LIMIT 1";
				$this->db->query($delete_query);
				
				$newdata = array(
						   'user_id'   => $auto_increment_id,
						   'user_name'  => $result1[0]->user_name,
						   'user_email'     => $result1[0]->user_email,
						   'logged_in' => TRUE
						 );
		
				$this->session->set_userdata($newdata);
				if($redirect == 1){
					$this->sign_up_for_privacy();
				}else{
					redirect('');
				}
				
			}
			else{
				$this->load->view('view_header', $this->view_data);
				$this->load->view('view_register_fail', $this->view_data);
				$this->load->view('view_footer');
			}
		}
		else{
			$this->load->view('view_header', $this->view_data);
			$this->load->view('view_register_fail', $this->view_data);
			$this->load->view('view_footer');
		}
		
	}
	
	function check_captcha(){
		// First, delete old captchas
		$expiration = time()-7200; // Two hour limit
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);	
		
		// Then see if a captcha exists:
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();
		
		if ($row->count == 0)
		{
			$this->form_validation->set_message('check_captcha', 'The CAPTCHA field is incorrect.');
			return FALSE;
		}
	}
	
	function user_email_exists($email) {          
		$query = $this->db->query("SELECT * FROM users WHERE user_email LIKE '$email'");
		if ($query->num_rows() > 0){
			$this->form_validation->set_message('user_email_exists', 'This EMAIL ADDRESS has already been registered.');
			return FALSE;
		}
		$query = $this->db->query("SELECT * FROM applied_users WHERE user_email LIKE '$email'");
		if ($query->num_rows() > 0){
			$this->form_validation->set_message('user_email_exists', 'This EMAIL ADDRESS has already been registered.');
			return FALSE;
		}
	}
	
	function user_details($user_id){
		$user_details = $this->User_model->_get_user_details($user_id);
		return $user_details;
	}
	
	function login(){
		if($this->session->userdata('logged_in') == FALSE)
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('login_email', 'Email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('login_password', 'Password', 'trim|required|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				//hasnt been run or validation errors
				$this->load->view('view_header', $this->view_data);
				$this->load->view('view_login', $this->view_data);
				
				$this->load->view('view_footer');
			}
			else
			{
				//check details match those is db
				$email = $this->input->post('login_email');
				$password = $this->input->post('login_password');
				$redirect = $this->input->post('redirect');
				
				$login_successful = $this->User_model->_check_login_details($email, $password);
				
				if($login_successful)
				{
					//set session variables
					$user_id = $this->User_model->_get_user_id($email);
					$user_details = $this->User_model->_get_user_details($user_id)->row();
					
					$newdata = array(
						   'user_id'   => $user_id,
						   'user_name'  => $user_details->user_name,
						   'user_email'     => $email,
						   'user_private'     => $user_details->user_private,
						   'logged_in' => TRUE
						 );
		
					$this->session->set_userdata($newdata);
					
					if(!$this->session->userdata('redirect') == "")
					{
						$this->view_data['error'] = "";
						
						$redirect = $this->session->userdata('redirect');
						$this->session->unset_userdata('redirect', '');
						redirect($redirect);
					}
					else
					{
						redirect ('user/dashboard');
					}
				}
				else
				{
				$this->view_data['error'] = "Your username and / or password is incorrect";
				$this->load->view('view_header', $this->view_data);
				$this->load->view('view_login', $this->view_data);
				$this->load->view('view_footer', $this->view_data);
				}
			}
		}
		else{
			$this->session->set_userdata('redirect', 'user/login');
			redirect('user/already_logged_in');
		}
	}
	
	function logout(){
		$array_items = array('username' => '', 'email' => '', 'user_id' => '', 'user_private' => '0');
		
		$this->session->unset_userdata($array_items);
		$this->session->set_userdata('logged_in', FALSE);
		
		if(!$this->session->userdata('redirect') == "")
		{
			$this->view_data['error'] = "";
			$redirect = $this->session->userdata('redirect');
			$this->session->unset_userdata('redirect', '');
			redirect($redirect);
		}
		else
		{
			redirect(base_url());
		}
		
	}
	
	function forgotten_password(){
		$this->load->library('form_validation');
			
		$this->form_validation->set_rules('forgot_email', 'Email', 'trim|required|valid_email|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			//hasnt been run or validation errors
			$this->load->view('view_header', $this->view_data);
			$this->load->view('view_forgot_password', $this->view_data);
			$this->load->view('view_footer');
		}
		else
		{
			$forgot_email = $this->input->post('forgot_email');
			
			$this->load->library('email');
			$mailConfig['protocol'] = "smtp";
			$mailConfig['smtp_host'] = "smtpout.europe.secureserver.net";
			$mailConfig['smtp_user'] = "hello@numberpicture.com";
			$mailConfig['smtp_pass'] = "panther1";
			$mailConfig['smtp_port'] = "80";
			$mailConfig['mailtype'] = "text";
			$mailConfig['validate'] = "TRUE";
			$this->email->initialize($mailConfig);

			$this->email->from('admin@numberpicture.com', 'NUMBER PICTURE ADMIN');
			$this->email->to($forgot_email);
			
			$this->email->subject('NUMBER PICTURE: Password Reminder');
			
			$this->load->model('User_model');
			$user_id = $this->User_model->_get_user_id($forgot_email);
			if($user_id != false) {
				$user_details = $this->User_model->_get_user_details($user_id);
				$result = $user_details->row();
			}
			$message = "Hello " . $result->user_name . ". Your password for Number Picture is as follows: " . $result->user_password . "Go to numberpicture.com/user/login to log in. Happy visualizing...";
			$this->email->message($message);
			
			$this->email->send();
			
			redirect('user/login');
		}
	}
	
	function dashboard (){
		if($this->session->userdata('logged_in') == TRUE)
		{
			$user_id = $this->session->userdata('user_id');
			$template_query = "SELECT * FROM templates WHERE user_id LIKE '$user_id' ORDER BY last_edited DESC";
			$picture_query = "SELECT * FROM pictures WHERE user_id LIKE '$user_id' ORDER BY created DESC";
			
			$template_result = $this->db->query($template_query);
			if ($template_result->num_rows() > 0)
			{
				$this->view_data['template_data'] = $template_result;
			}
			else{
				$this->view_data['template_data'] = "noresult";
			}
			$picture_result = $this->db->query($picture_query);
			if ($picture_result->num_rows() > 0)
			{
				$this->view_data['picture_data'] = $picture_result;
			}
			else{
				$this->view_data['picture_data'] = "noresult";
			}
		
			$this->load->view('view_header', $this->view_data);
			$this->load->view('view_dashboard', $this->view_data);
			$this->load->view('view_back_to_top');
			
			$this->load->view('view_footer', $this->view_data);
		}
		else{
			$this->login();
		}
	}
	
	function already_logged_in(){
		$this->load->view('view_header', $this->view_data);
		$this->load->view('view_already_logged_in', $this->view_data);
		
		$this->load->view('view_footer', $this->view_data);
	}
	
	function learn ()
	{
		$this->about();
	}
	
	function about ()
	{
		$this->load->view('view_header', $this->view_data);
		$this->load->view('view_learn', $this->view_data);
		$this->load->view('view_about', $this->view_data);
		$this->load->view('view_learn_end', $this->view_data);
		$this->load->view('view_back_to_top');
		
		$this->load->view('view_footer', $this->view_data);
	}
	
	function coding ()
	{
		$this->coding_intro();
	}
	
	function coding_intro ()
	{
		$this->load->view('view_header', $this->view_data);
		$this->load->view('view_learn', $this->view_data);
		$this->load->view('view_coding_intro', $this->view_data);
		$this->load->view('view_learn_end', $this->view_data);
		$this->load->view('view_back_to_top');
		
		$this->load->view('view_footer', $this->view_data);
	}
	
	function coding_things_to_know ()
	{
		$this->load->view('view_header', $this->view_data);
		$this->load->view('view_learn', $this->view_data);
		$this->load->view('view_coding_things_to_know', $this->view_data);
		$this->load->view('view_learn_end', $this->view_data);
		$this->load->view('view_back_to_top');
		
		$this->load->view('view_footer', $this->view_data);
	}
	
	function coding_fonts ()
	{
		$this->load->view('view_header', $this->view_data);
		$this->load->view('view_font_loader', $this->view_data);
		$this->load->view('view_learn', $this->view_data);
		$this->load->view('view_coding_fonts', $this->view_data);
		$this->load->view('view_learn_end', $this->view_data);
		$this->load->view('view_back_to_top');
		
		$this->load->view('view_footer', $this->view_data);
	}
	
	function coding_important_snippets ()
	{
		$this->load->view('view_header', $this->view_data);
		$this->load->view('view_learn', $this->view_data);
		$this->load->view('view_coding_important_snippets', $this->view_data);
		$this->load->view('view_learn_end', $this->view_data);
		$this->load->view('view_back_to_top');
		
		$this->load->view('view_footer', $this->view_data);
	}
	
	function coding_examples ()
	{
		$this->load->view('view_header', $this->view_data);
		$this->load->view('view_learn', $this->view_data);
		$this->load->view('view_coding_examples', $this->view_data);
		$this->load->view('view_learn_end', $this->view_data);
		$this->load->view('view_back_to_top');
		
		$this->load->view('view_footer', $this->view_data);
	}
	
	function faq ()
	{
		$this->load->view('view_header', $this->view_data);
		$this->load->view('view_learn', $this->view_data);
		$this->load->view('view_faq', $this->view_data);
		$this->load->view('view_learn_end', $this->view_data);
		$this->load->view('view_back_to_top');
		
		$this->load->view('view_footer', $this->view_data);
	}
	
	function inspiration ()
	{
		$this->load->view('view_header', $this->view_data);
		$this->load->view('view_learn', $this->view_data);
		$this->load->view('view_inspiration', $this->view_data);
		$this->load->view('view_learn_end', $this->view_data);
		$this->load->view('view_back_to_top');
		
		$this->load->view('view_footer', $this->view_data);
	}
	
	function contact ()
	{ 
		$this->load->library('form_validation');
			
		$this->form_validation->set_rules('contact_email', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('contact_message', 'Password', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('view_header', $this->view_data);
			$this->load->view('view_learn', $this->view_data);
			$this->load->view('view_learn_end', $this->view_data);
			$this->load->view('view_contact', $this->view_data);
			
			$this->load->view('view_footer');
		}
		else
		{
			$email = $this->input->post('contact_email');
			$message = $this->input->post('contact_message');
			
			$this->load->library('email');
			$mailConfig['protocol'] = "smtp";
			$mailConfig['smtp_host'] = "smtpout.europe.secureserver.net";
			$mailConfig['smtp_user'] = "hello@numberpicture.com";
			$mailConfig['smtp_pass'] = "panther1";
			$mailConfig['smtp_port'] = "80";
			$mailConfig['mailtype'] = "text";
			$mailConfig['validate'] = "TRUE";
			$this->email->initialize($mailConfig);

			$this->email->from($email, $email);
			$this->email->to('admin@numberpicture.com');
			
			$this->email->subject('NUMBER PICTURE: Contact');
			$this->email->message($message);
			
			$this->email->send();
			
			$this->load->view('view_header', $this->view_data);
			$this->load->view('view_learn', $this->view_data);
			$this->load->view('view_learn_end', $this->view_data);
			$this->load->view('view_contact_success');
			
			$this->load->view('view_footer');
			
		}
	}
	
	function sign_up_for_privacy(){
		$this->load->view('view_header', $this->view_data);
		$this->load->view('view_learn', $this->view_data);
		$this->load->view('view_learn_end', $this->view_data);
		$this->load->view('view_sign_up_for_privacy', $this->view_data);
		
		$this->load->view('view_footer', $this->view_data);
	}
}

/* End of file user.php */
/* Location: ./system/application/controllers/user.php */