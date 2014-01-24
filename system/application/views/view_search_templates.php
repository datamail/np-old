<h1><bold>TEMPLATES</bold></h1>

<?php
$counter = 0;
if($is_data == 1)
{
    echo ('<div class="relative"><a href="' . $base_url . 'template_images/' . $slideshow_start->image_path . '" rel="slideshow" id="slideshow_button" title="SLIDESHOW" alt="&lt;a href=&quot;' . $base_url . 'picture/new_picture/' . $slideshow_start->template_id . '&quot;&gt;USE THIS TEMPLATE&lt;/a&gt;" ></a></div>');
    foreach($data->result() as $row):
    if (@GETIMAGESIZE('template_images/' . $row->thumb_path)) {
	echo "<div class='thumb_container'>";
	$thumb_output = "<a href='" . $base_url . "picture/new_picture/" . $row->template_id . "' ><img src='" . $base_url  . 'template_images/' .  $row->thumb_path . "' alt='numberpicture' /><div class='title_overlay'><strong>";
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
	echo ('<a href="' . $base_url . 'template_images/' . $row->image_path . '" rel="slideshow" title="&lt;a href=&quot;' . $base_url . 'picture/new_picture/' . $row->template_id . '&quot;&gt;USE THIS TEMPLATE&lt;/a&gt;" ></a>');
	echo "</div>";
	$counter +=1;
        }
        /*
        else {
            echo "<div class='thumb_container'><img src='" . $base_url . "img/unfinished.jpg' /></div>";
        }*/
    
    
    endforeach;
    $left_over = 4 - ($counter % 4);
    for ($b = 0; $b < $left_over; $b = $b+1){
        echo "<div class='thumb_container'><a href='" . $base_url . "template/new_template' ><img src='" . $base_url . "img/new_template.png' alt='numberpicture' /></a></div>";
    }
}
else
{
    echo "Sorry, but nothing matches your SEARCH.";
}
?>
<div class="pagination"><?php echo($pagination); ?></div>
<?php
echo form_open($base_url . 'template/search');

$type_options = array(
                '0' => 'ALL TYPES',
		'1' => 'COMPARE A SET OF VALUES',
		'2' => 'TRACK RISES AND FALLS OVER TIME'  ,
		'3' => 'RELATIONSHIPS AMONG DATA POINTS',
		'4' => 'PARTS OF THE WHOLE',
		'5' => 'ANALYSE A TEXT'
	);


$discrete = array(
		'name' => 'discrete',
		'id' => 'discrete',
		'value' => set_value('discrete')
	);

$continuous = array(
		'name' => 'continuous',
		'id' => 'continuous',
		'value' => set_value('continuous')
	);

$orientation_options = array(
                'both' => 'Landscape & Portrait',
		'landscape' => 'Landscape',
		'portrait' => 'Portrait' 
                
	);

$aspect_options = array(
                '0' => 'All aspects',
                '1' => '1 to 1',
		'2' => '1 to 2',
		'3' => '1 to 3',
		'4' => '1 to 4'
	);

$orderby_options = array(
                'DESC' => 'NEWEST FIRST',
		'ASC' => 'OLDEST FIRST'
	);
?>
<div id="search_box">
 <p>
     <h1>SEARCH</h1>
<?php echo validation_errors(); ?>
    </p>
 <p><h3><a id="type_of_data_help" class="help" >Type of Data</a></h3>
<?php echo form_dropdown('type', $type_options, set_value('type')); ?>
    </p>
 <p><h3><a id="category_help"  class="help">Number Of Category-Type Inputs</a></h3>
<?php echo form_input($discrete); ?>
    </p>
 <p><h3><a id="number_help"  class="help">Number Of Amount-Type Inputs</a></h3>
<?php echo form_input($continuous); ?>
    </p>
 <?php /*
 <p><h3>Orientation</h3>
<?php echo form_dropdown('orientation', $orientation_options, set_value('orientation')); ?>
    </p>
 <p><h3>Aspect</h3>
<?php echo form_dropdown('aspect', $aspect_options, set_value('aspect')); ?>
    </p>
       */
 ?>
 <p><h3>Order By</h3>
<?php echo form_dropdown('orderby', $orderby_options, set_value('orderby')); ?>
    </p>
 <?php echo form_submit(array('name' => 'submit'), 'Search'); ?>
</div>
<script type="text/javascript">
$("#type_of_data_help").colorbox({html:'<div style="padding:20px; text-align: left;" ><h2>Types Of Data</h2><p>There are many different types of information / data sets. And you need to choose which one best suits your template description. The different types are basically self explanatory so below are a few examples of each:</p><ul><li><strong>Relationships among data points</strong> - Network Diagram, Scatterplot, Matrix Chart...</li><li><strong>Compare a set of values</strong> - Bar Chart, Block Histogram, Bubble Chart...</li><li><strong>Track rises and falls over time</strong> - Line Graph, Stack Graph...</li><li><strong>See the parts of a whole</strong> - Pie Chart, Treemap...</li><li><strong>Analyze a text</strong> - Word Tree, Tag Cloud, Word Cloud, Phrase Net...</li><li><strong>See the world</strong> - USA Map, World Map, China, Cape Town...</li></ul></div>', width:"600px"});
$("#category_help").colorbox({html:'<div style="padding:20px; text-align: left;" ><h2>What is a Category-Type Variable?</h2><li><p>Variables in terms of Number Picture are the columns on your Excel (etc...) spreadsheet. Column A will be variable 1, and Column B variable 2, etc...</p></li><li><p>When we talk about a Category-Type variable we mean a column on your spreadsheet that possesses values that are words and categories as apposed to numbers / amounts / values.</p></li><li><p>Eg. Mammal, Amphibian, Insect...</p></li><li><strong>So what you need to do is count the number of columns on your spreadsheet that contain category-type values and then type the number into the box.</strong></li></div>', width:"600px"});
$("#number_help").colorbox({html:'<div style="padding:20px; text-align: left;" ><h2>What is an Amount-Type Variable?</h2><li><p>Variables in terms of Number Picture are the columns on your Excel (etc...) spreadsheet. Column A will be variable 1, and Column B variable 2, etc...</p></li><li><p>When we talk about an Amount-Type variable we mean a column on your spreadsheet that possesses values that are numbers / amounts / values as apposed to words and categories.</p></li><li><p>Eg. 1002, 33.90, -1</p></li><li><strong>So what you need to do is count the number of columns on your spreadsheet that contain amount-type values and then type the number into the box.</strong></li></div>', width:"600px"});
</script>
 