<h1>Register</h1>
<p>
    	<div class="highlight"><?php echo validation_errors(); ?></div>
    </p>
<?php
	echo form_open($base_url . 'user/register');
	
	$username = array(
		'name' => 'reg_username',
		'id' => 'reg_username',
		'value' => set_value('reg_username'),
		'class' => 'long_input'
	);
	
	$email = array(
		'name' => 'reg_email',
		'id' => 'reg_email',
		'value' => set_value('reg_email'),
		'class' => 'long_input'
	);
	
	$password = array(
		'name' => 'reg_password',
		'id' => 'reg_password',
		'value' => '',
		'class' => 'long_input'
	);
	
	$password_conf = array(
		'name' => 'reg_password_conf',
		'id' => 'reg_password_conf',
		'value' => '',
		'class' => 'long_input'
	);
?>

	<p>
    <h2>Name</h2>
    <div>
    	<?php echo form_input($username); ?>
    </div>
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
    <h2>Re-enter Password</h2>
    <div>
    	<?php echo form_password($password_conf); ?>
    </div>
    </p>
    
    <?php /* <p>
	<?php  //echo  $cap_image ; ?>
	<br />
	<input  type="text" name="captcha" value="" />
    </p> */
     ?>
     <p><div style="margin-left: 341px;">
	<?php echo $captcha; ?>
	</div>
    </p>
    
    <p>
    <div>
    	<?php echo form_submit(array('name' => 'register'), 'Register'); ?>
    </div>
    </p>
    
    <p><h2>Already a Member?</h2>
	<a class="psuedo_button" href="<?php echo $base_url; ?>user/login">Log In</a>
    </p>

<?php echo form_close(); ?>
