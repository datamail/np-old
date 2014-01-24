<?php
/**
 * PayPal_Lib Controller Class (Paypal IPN Class)
 *
 * Paypal controller that provides functionality to the creation for PayPal forms, 
 * submissions, success and cancel requests, as well as IPN responses.
 *
 * The class requires the use of the PayPal_Lib library and config files.
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Commerce
 * @author      Ran Aroussi <ran@aroussi.com>
 * @copyright   Copyright (c) 2006, http://aroussi.com/ci/
 *
 */

class Paypal extends Controller {

	function Paypal()
	{
		
		parent::Controller();
		$this->load->library('paypal_lib');
		$this->view_data['base_url'] = base_url();
		$this->view_data['fb_title'] = "Number Picture";
		$this->view_data['fb_description'] = "Crowd-sourcing new ways for people to visualize data";
		$this->view_data['fb_image'] = base_url() . "img/logo.png";
	}
	
	function index()
	{
		$this->privacy();
	}
	
	function privacy()
	{
		if($this->session->userdata('logged_in') == TRUE)
		{
			if($this->session->userdata('user_private') == '0')
			{
				$this->paypal_lib->add_field('business', 'fitzsi_1304602271_biz@yahoo.com');
				$this->paypal_lib->add_field('return', 'http://numberpicture.com/paypal/success');
				$this->paypal_lib->add_field('cancel_return', 'http://numberpicture.com/paypal/cancel');
				$this->paypal_lib->add_field('notify_url', 'http://numberpicture.com/paypal/ipn'); // <-- IPN url
				$this->paypal_lib->add_field('item_name', 'Number Picture Privacy');
				$this->paypal_lib->add_field('amount', '10');
			$this->paypal_lib->add_field('custom', $this->session->userdata('user_id')); // <-- Verify return
		
				// if you want an image button use this:
				//$this->paypal_lib->image('button_03.gif');
				
				// otherwise, don't write anything or (if you want to 
				// change the default button text), write this:
				$this->paypal_lib->button('Go Private');
				
				$this->view_data['paypal_form'] = $this->paypal_lib->paypal_form();
			
				$this->load->view('view_header', $this->view_data);
				$this->load->view('view_privacy', $this->view_data);
				$this->load->view('view_footer', $this->view_data);
			}
			else {
				$this->load->view('view_header', $this->view_data);
				$this->load->view('view_already_private', $this->view_data);
				$this->load->view('view_footer', $this->view_data);
			}
		}
		else{
			$this->session->set_userdata('redirect', 'paypal/privacy');
			redirect('user/login');
		}
	}

	function auto_form()
	{
		$this->paypal_lib->add_field('business', 'PAYPAL@EMAIL.COM');
		$this->paypal_lib->add_field('return', 'http://numberpicture.com/paypal/success');
		$this->paypal_lib->add_field('cancel_return', 'http://numberpicture.com/paypal/cancel');
		$this->paypal_lib->add_field('notify_url', 'http://numberpicture.com/paypal/ipn'); // <-- IPN url
    
		$this->paypal_lib->add_field('item_name', 'Paypal Test Transaction');
		$this->paypal_lib->add_field('item_number', '6941');
		$this->paypal_lib->add_field('amount', '197');
    
		$this->paypal_lib->paypal_auto_form();
	}
	function cancel()
	{
		$this->load->view('paypal_cancel');
	}
	
	function success()
	{
		// This is where you would probably want to thank the user for their order
		// or what have you.  The order information at this point is in POST 
		// variables.  However, you don't want to "process" the order until you
		// get validation from the IPN.  That's where you would have the code to
		// email an admin, update the database with payment status, activate a
		// membership, etc.
	
		// You could also simply re-direct them to another page, or your own 
		// order status page which presents the user with the status of their
		// order based on a database (which can be modified with the IPN code 
		// below).
		

		$this->view_data['pp_info'] = $_POST;
		$this->load->view('view_header', $this->view_data);
		$this->load->view('paypal_success', $this->view_data);
		$this->load->view('view_footer');
	}
	
	function ipn()
	{
		
			
		// Payment has been received and IPN is verified.  This is where you
		// update your database to activate or process the order, or setup
		// the database with the user's order details, email an administrator,
		// etc. You can access a slew of information via the ipn_data() array.
 
		// Check the paypal documentation for specifics on what information
		// is available in the IPN POST variables.  Basically, all the POST vars
		// which paypal sends, which we send back for validation, are now stored
		// in the ipn_data() array.
 
		// For this example, we'll just email ourselves ALL the data.
		$to    = 'fitzsimons.finn@gmail.com';    //  your email

		if ($this->paypal_lib->validate_ipn()) 
		{
			$user_id = $this->paypal_lib->ipn_data['custom'];
			$this->load->helper('date');
			$now = now();
			$expiration = strtotime("+365 days",$now);
			$query = "UPDATE users SET user_private = '1' user_private_expiration = '$expiration' WHERE user_id LIKE '$user_id'";
			$this->db->query($query);
			
			$query = "UPDATE pictures SET is_private = '1' WHERE user_id LIKE '$user_id'";
			$this->db->query($query);
			
			/*
			$body  = 'An instant payment notification was successfully received from ';
			$body .= $this->paypal_lib->ipn_data['payer_email'] . ' on '.date('m/d/Y') . ' at ' . date('g:i A') . "\n\n";
			$body .= " Details:\n";

			foreach ($this->paypal_lib->ipn_data as $key=>$value)
				$body .= "\n$key: $value";
	
			// load email lib and email results
			$this->load->library('email');
			$mailConfig['protocol'] = "smtp";
			$mailConfig['smtp_host'] = "smtpout.europe.secureserver.net";
			$mailConfig['smtp_user'] = "hello@numberpicture.com";
			$mailConfig['smtp_pass'] = "panther1";
			$mailConfig['smtp_port'] = "80";
			$mailConfig['mailtype'] = "text";
			$mailConfig['validate'] = "TRUE";
			$this->email->initialize($mailConfig);
			$this->email->to($to);
			$this->email->from($this->paypal_lib->ipn_data['payer_email'], $this->paypal_lib->ipn_data['payer_name']);
			$this->email->subject('Number Picture (Received Payment)');
			$this->email->message($body);	
			$this->email->send();
			
			echo ('poes');
			*/
			
			
		}
	}
}
?>