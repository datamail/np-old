<h1>Forgotten Password</h1>
<form method="post" accept-charset="utf-8" action="<?php echo ($base_url . 'user/forgotten_password'); ?>" name="form" id="form" />

<?php
    $forgot_email = array(
		'name' => 'forgot_email',
		'id' => 'forgot_email',
                'class' => 'long_input',
		'value' => set_value('forgot_email')
	);

echo '<p><h2>E-mail Address</h2>' . form_input($forgot_email) . '</p>';
echo '<p><div>' . form_submit(array('name' => 'send_password'), 'Send Password') . '</div></p>';
?>
<div class="space"></div>