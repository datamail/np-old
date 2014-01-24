<h1>Logged In</h1>
You are already Logged In as <strong><?php echo $this->session->userdata['user_name']; ?></strong><br />
Would you like to logout?<br /><br />
<?php echo anchor('user/logout', '<span>Log Out</span>', array('class' => 'psuedo_button')); ?>
<div class="space"></div>