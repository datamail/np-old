<h1>Your Templates</h1>
<?php
if($template_data != "noresult")
{
    foreach($template_data->result() as $row):
    echo "<div class='thumb_container'>";
    $thumb_output = '<a href="' . $base_url . 'template/edit_template/' . $row->template_id . '" ><img src="' . $base_url . 'template_images/' . $row->thumb_path . '" /><div class="title_overlay"><strong>';
    
    switch($row->type){
	case 1:
	    $thumb_output .= "Compare A Set Of Values";
	break;
	case 2:
	    $thumb_output .= "Track Rises And Falls Over Time";
	break; 
	case 3:
	    $thumb_output .= "Relationships Among Data Points";
	break; 
	case 4:
	    $thumb_output .= "Parts Of The Whole";
	break; 
	case 5:
	    $thumb_output .= "Analyze A Text";
	break; 
	case 6:
	    $thumb_output .= "See The World";
	break;
    }
    $thumb_output .= "</strong><br>Category-Type Variables: " . $row->discrete_inputs . "<br>Amount-Type Variables: " . $row->continuous_inputs . "<br>Used " . $row->number_of_uses . " Times</div></a>";
    echo($thumb_output);
    //echo $row->title;
    /*
    echo('picture_images/' . $row->image_path . "-----");
    echo($row->type);
    //echo($row->orientation);
    //echo($row->aspect);
    echo($row->last_edited . "<br />");
    */
    echo "</div>";
    endforeach;
}
else
{
    echo "Sorry, but there are no pictures that match your search...";
}
?>
<div class="clear"></div>
<h1>Your Number Pictures</h1>
<?php
if($picture_data != "noresult")
{
    foreach($picture_data->result() as $row):
    if (@GETIMAGESIZE('picture_images/' . $row->thumb_path)) {
    echo "<div class='thumb_container'>";
    $thumb_output = '<a href="' . $base_url . 'picture/view/' . $row->picture_id . '" ><img src="' . $base_url .'picture_images/' . $row->thumb_path . '" /><div class="title_overlay">' . $row->title . '</div></a>';
    echo($thumb_output);
    //echo $row->title;
    /*
    echo('picture_images/' . $row->image_path . "-----");
    echo($row->type);
    //echo($row->orientation);
    //echo($row->aspect);
    echo($row->last_edited . "<br />");
    */
    echo "</div>";
    }
    endforeach;
}
else
{
    echo "Sorry, but there are no pictures that match your search...";
}
?>
