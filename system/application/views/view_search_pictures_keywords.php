<h1><bold>Pictures</bold></h1>

<?php 
if($is_data == TRUE)
{
    //echo ('<div class="relative"><a href="' . $base_url . 'picture_images/' . $data[0]->image_path . '" rel="slideshow" id="slideshow_button" title="SLIDESHOW" alt="&lt;a href=&quot;' . $base_url . 'picture/view/' . $data[0]->picture_id . '&quot;&gt;VIEW THIS PICTURE&lt;/a&gt;" ></a></div>');
   
    for($a = 0; $a < count($data); $a = $a + 1){
        if($data[$a]){
        if (@GETIMAGESIZE('picture_images/' . $data[$a]->thumb_path)) {
            echo "<div class='thumb_container'>";
            echo("<a href='" . $base_url . "picture/view/" . $data[$a]->picture_id . "' ><img src='" . $base_url  . 'picture_images/' .  $data[$a]->thumb_path . "' alt='numberpicture' /><div class='title_overlay'>" . $data[$a]->title . "</div></a>");
            echo ('<a href="' . $base_url . 'picture_images/' . $data[$a]->image_path . '" rel="slideshow" alt="&lt;a href=&quot;' . $base_url . 'picture/view/' . $data[$a]->picture_id . '&quot;&gt;VIEW THIS PICTURE&lt;/a&gt;" ></a>');
            echo "</div>";
        }
        else {
            echo "<div class='thumb_container'></div>";
        }
    }
    }    
}
else
{
    echo "Sorry, but nothing matches your SEARCH.";
}
?>
<div class="pagination"><?php echo($pagination); ?></div>
<?php
echo form_open($base_url . 'search/picture_keywords');
$keywords = array(
		'name' => 'keywords',
		'id' => 'keywords',
		'class' => 'long_input',
		'value' => set_value('keywords')
	);

?>
<div id="search_box">
     <h1>SEARCH</h1>
<span class="highlight"><?php echo validation_errors(); ?></span>
    </p>
<?php echo form_input($keywords); ?>
    </p>
 <?php echo form_submit(array('name' => 'submit'), 'Search'); ?>
 <?php echo form_close(); ?>
</div>