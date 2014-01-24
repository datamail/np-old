<?php
	echo form_open($base_url . 'user/login');
	
	
	$email = array(
		'name' => 'login_email',
		'id' => 'login_email',
		'class' => 'long_input',
		'value' => set_value('login_email')
	);
	
	$password = array(
		'name' => 'login_password',
		'id' => 'login_password',
		'class' => 'long_input',
		'value' => ''
	);
	
	if(isset($redirect)){
	$redirectfield = array(
		'redirect' => $redirect
	);
?>
<?php echo form_hidden($redirectfield); } ?>
<h1>Log In</h1>
<p>
    	<?php echo validation_errors(); ?>
    </p>
    <p>
    <h2>Email</h2>
    <div>
    	<?php echo form_input($email); ?>
    </div>
    </p>
    
    <p>
    <h2>Password</h2>
    <div>
    	<?php echo form_password($password); ?>
    </div>
    </p>
    
    <p>
    	<?php if(isset($error)){echo $error;} ?>
    </p>
    
    
    <p>
    <div>
    	<?php echo form_submit(array('name' => 'login'), 'Login'); ?>
    </div>
    </p>

	<p><h2>Not a Member?</h2>
	<a class="psuedo_button" href="<?php echo $base_url; ?>user/register">Register</a><?php /* <a class="psuedo_button" href="<?php echo $base_url; ?>user/forgotten_password">Forgot Password?</a> */ ?>
    </p>

<?php echo form_close(); ?>