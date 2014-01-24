<?php
echo form_open($base_url . 'user/contact');

$contact_email = array(
		'name' => 'contact_email',
		'id' => 'contact_email',
                'class' => 'long_input',
		'value' => set_value('contact_email')
	);

$contact_message = array(
		'name' => 'contact_message',
		'id' => 'contact_message',
		'value' => set_value('contact_message')
	);
?>


<h1>CONTACT</h1>
 <p>
<span  class="highlight"><?php echo validation_errors(); ?></span>
    </p>
 <p><h2>Email Address</h2>
<?php echo form_input($contact_email); ?>
    </p>
 <p><h2>Message</h2>
<?php echo form_textarea($contact_message); ?>
    </p>

 <?php echo form_submit(array('name' => 'submit'), 'Send'); ?>

 