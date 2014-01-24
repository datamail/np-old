<h1><bold>TEMPLATES</bold></h1>
<?php
$counter = 0;
if($is_data == TRUE)
{
    echo ('<div class="relative"><a href="' . $base_url . 'template_images/' . $data[0]->image_path . '" rel="slideshow" id="slideshow_button" title="SLIDESHOW" alt="&lt;a href=&quot;' . $base_url . 'picture/new_picture/' . $data[0]->template_id . '&quot;&gt;USE THIS TEMPLATE&lt;/a&gt;" ></a></div>');
    for($a = 0; $a < count($data); $a = $a + 1){
        if (@GETIMAGESIZE('template_images/' . $data[$a]->thumb_path)) {
            echo "<div class='thumb_container'>";
            echo("<a href='" . $base_url . "picture/new_picture/" . $data[$a]->template_id . "' ><img src='" . $base_url  . 'template_images/' .  $data[$a]->thumb_path . "' alt='numberpicture' /></a>");
            echo ('<a href="' . $base_url . 'template_images/' . $data[$a]->image_path . '" rel="slideshow" title="&lt;a href=&quot;' . $base_url . 'picture/new_picture/' . $data[$a]->template_id . '&quot;&gt;USE THIS TEMPLATE&lt;/a&gt;" ></a>');
            echo "</div>";
            $counter +=1;
        }
        /*
        else {
            echo "<div class='thumb_container'><img src='" . $base_url . "img/unfinished.jpg' /></div>";
        }*/
    }
    $left_over = 4 - ($counter % 4);
    for ($b = 0; $b < $left_over; $b = $b+1){
        echo "<div class='thumb_container'><a href='" . $base_url . "template/new_template' ><img src='" . $base_url . "img/new_template.png' alt='numberpicture' /></a></div>";
    }
}
else
{
    echo "<h2>Sorry, but nothing matches your SEARCH.</h2>";
}
?>
<div class="pagination"><?php echo($pagination); ?></div>
