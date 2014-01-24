<a href="<?php echo $base_url; ?>" >Home</a><br>
<a href="<?php echo $base_url; ?>admin/clean_up_pictures" >Clean Up Pictures</a><br>
<a href="<?php echo $base_url; ?>admin/get_email_list" >Get Emails List</a><br>
<a href="<?php echo $base_url; ?>admin/email_users" >Email Users</a>
<?php foreach($data->result() as $row):
echo '<a href="' . $base_url . 'admin/flag/' . $row->template_id . '" ><img src="' . $base_url  . 'template_images/' .  $row->thumb_path . '" alt="numberpicture" /></a>';
endforeach;
echo $pagination;
?>