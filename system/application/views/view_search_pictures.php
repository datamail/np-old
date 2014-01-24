<h1><bold>PICTURES</bold></h1>
<?php
if($is_data == 1)
{
    echo ('<div class="relative"><a href="' . $base_url . 'picture_images/' . $slideshow_start->image_path . '" rel="slideshow" id="slideshow_button" title="SLIDESHOW" alt="&lt;a href=&quot;' . $base_url . 'picture/view/' . $slideshow_start->picture_id . '&quot;&gt;VIEW THIS PICTURE&lt;/a&gt;" ></a></div>');
    foreach($data->result() as $row):
    if (@GETIMAGESIZE('picture_images/' . $row->thumb_path)) {
    echo "<div class='thumb_container'>";
    echo('<a href="' . $base_url . 'picture/view/' . $row->picture_id . '" ><img src="' . $base_url  . 'picture_images/' .  $row->thumb_path . '" alt="numberpicture" alt="numberpicture" /><div class="title_overlay">' . $row->title . '</div></a>');
    echo ('<a href="' . $base_url . 'picture_images/' . $row->image_path . '" rel="slideshow" alt="&lt;a href=&quot;' . $base_url . 'picture/view/' . $row->picture_id . '&quot;&gt;VIEW THIS PICTURE&lt;/a&gt;" ></a>');
    
    echo "</div>";
    }
    else {
	echo "<div class='thumb_container'></div>";
    }
    endforeach;
}
else
{
    echo "Sorry, but there are no pictures that match your search...";
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


<script type="text/javascript">
$("#type_of_data_help").colorbox({html:'<div style="padding:20px; text-align: left;" ><h2>Types Of Data</h2><p>There are many different types of information / data sets. And you need to choose which one best suits your template description. The different types are basically self explanatory so below are a few examples of each:</p><ul><li><strong>Relationships among data points</strong> - Network Diagram, Scatterplot, Matrix Chart...</li><li><strong>Compare a set of values</strong> - Bar Chart, Block Histogram, Bubble Chart...</li><li><strong>Track rises and falls over time</strong> - Line Graph, Stack Graph...</li><li><strong>See the parts of a whole</strong> - Pie Chart, Treemap...</li><li><strong>Analyze a text</strong> - Word Tree, Tag Cloud, Word Cloud, Phrase Net...</li><li><strong>See the world</strong> - USA Map, World Map, China, Cape Town...</li></ul></div>', width:"600px"});
$("#category_help").colorbox({html:'<div style="padding:20px; text-align: left;" ><h2>What is a Category-Type Variable?</h2><li><p>Variables in terms of Number Picture are the columns on your Excel (etc...) spreadsheet. Column A will be variable 1, and Column B variable 2, etc...</p></li><li><p>When we talk about a Category-Type variable we mean a column on your spreadsheet that possesses values that are words and categories as apposed to numbers / amounts / values.</p></li><li><p>Eg. Mammal, Amphibian, Insect...</p></li></div>', width:"600px"});
$("#number_help").colorbox({html:'<div style="padding:20px; text-align: left;" ><h2>What is an Amount-Type Variable?</h2><li><p>Variables in terms of Number Picture are the columns on your Excel (etc...) spreadsheet. Column A will be variable 1, and Column B variable 2, etc...</p></li><li><p>When we talk about an Amount-Type variable we mean a column on your spreadsheet that possesses values that are numbers / amounts / values as apposed to words and categories.</p></li><li><p>Eg. 1002, 33.90, -1</p></li></div>', width:"600px"});
</script>