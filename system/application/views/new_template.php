<form method="post" accept-charset="utf-8" action="<?php echo ($base_url . 'template/new_template'); ?>" name="form" id="form" />
<h1>MAKE A TEMPLATE</h1>
<div id="learn"><p>This is where you will physically create templates that yourself and others can use to visualize their data. You need to type the Processing.js code into the text area below and choose the specs that suit the data sets that will be used for your template below that.</p><p>For step by step tutorial examples of already made templates see the <a href="<?php echo $base_url; ?>user/coding_examples" >CODING: EXAMPLES</a> page. An introduction to coding the templates can be found <a href="<?php echo $base_url; ?>user/coding_intro" >HERE</a> as well as the Processing.js instruction page <a href="http://processingjs.org/reference" >HERE</a>.</p><p>And click on the headings with question marks next to them for instructions.</div>
<?php
    $edit_template_code = array(
		'name' => 'edit_template_code',
		'id' => 'edit_template_code', 
		'value' => set_value('edit_template_code')
	);
    
    $edit_template_discrete = array(
		'name' => 'edit_template_discrete',
		'id' => 'edit_template_discrete', 
		'value' => set_value('edit_template_discrete')
	);
    
    $edit_template_continuous = array(
		'name' => 'edit_template_continuous',
		'id' => 'edit_template_continuous', 
		'value' => set_value('edit_template_continuous')
	);
       
    $edit_template_type_options = array(
		'1' => 'COMPARE A SET OF VALUES',
		'2' => 'TRACK RISES AND FALLS OVER TIME'  ,
		'3' => 'RELATIONSHIPS AMONG DATA POINTS',
		'4' => 'PARTS OF THE WHOLE',
		'5' => 'ANALYZE A TEXT'
	);
    
    $edit_template_map_name_options = array(
		'WORLD' => 'WORLD',
		'USA' => 'USA'
	);
    
    $edit_template_notes = array(
		'name' => 'edit_template_notes',
		'id' => 'edit_template_notes', 
		'value' => set_value('edit_template_notes')
	);
?>

<p>
<div  class="highlight"><?php echo validation_errors(); ?></div>
    </p>
<?php if(!$processing_code == ''){
    echo $processing_code;  ?>
    <a id="canvas_help" ><canvas id="processing-canvas"></canvas></a>
    <?php
}    
?>



    <p><h2><a id="code_help" class="help" >Processing.js Code</a></h2>
<?php echo form_textarea($edit_template_code); ?>
    </p>
    <p>
<?php echo form_submit(array('name' => 'refresh', 'id' => 'refresh'), 'Refresh'); ?>
    </p>
    <p><h2><a id="type_of_data_help" class="help" >Type of Data</a></h2>
	
<?php echo form_dropdown('edit_template_type', $edit_template_type_options, set_value('edit_template_type'), 'id = "edit_template_type";'); ?>
    </p>
    <div id="edit_template_map_name_container" style="visibility:hidden; height:0;"><h2>Map</h2><?php echo form_dropdown('edit_template_map_name', $edit_template_map_name_options, set_value('edit_template_map_name'), 'id = "edit_template_map_name";'); ?></div>
    
    <div id="variable_select">
    <p><h2><a id="category_help" class="help" >Number Category-Type Inputs</a></h2>
<?php echo form_input($edit_template_discrete); ?>
    </p>
    <p><h2><a id="number_help" class="help" >Number Amount-Type Inputs</a></h2>
<?php echo form_input($edit_template_continuous); ?>
    </p>
    </div>
     <p><h2>Notes For Use</h2>
<?php echo form_textarea($edit_template_notes); ?>
    </p>
    <p>
	<input type='hidden' name='save_image' />
<?php echo form_submit(array('name' => 'refresh', 'id' => 'refresh'), 'Refresh'); ?>
<?php echo form_submit(array('name' => 'save'), 'Save Template'); ?>
<div class="note">Note: Click REFRESH at least once before saving.</div>
</p>

<h2><a id="generated_data_help" class="help" >Randomly Generated Data</a></h2>
<div class=""><p><?php echo $example_data_table; ?></p></div>

<?php echo form_close(); ?>

<script type='text/javascript'>
$(document).ready(function() {
	$("#form").submit(function() {
		var canvas = document.getElementById("processing-canvas"); //in your pjs sketch this is externals.canvas 
		var save_image = canvas.toDataURL("image/png");
		//alert(save_image);
		//alert("poes");
		$('input[name=save_image]').val(save_image);
		//$.post("<?php echo site_url('template/new_template'); ?>", { save_image:save_image });
	});
});
</script>
<script type='text/javascript'>
$('#edit_template_type').change(function() {
    
	if($('#edit_template_type').val() == '6') {
	    //alert('poes');
	    $('#edit_template_map_name_container').css('visibility', 'visible');
	    $('#edit_template_map_name_container').css('height', 'auto');
	}
	else {
	    $('#edit_template_map_name_container').css('visibility', 'hidden');
	    $('#edit_template_map_name_container').css('height', '0');
	}
});
</script>
<script type="text/javascript">
/*
$('#edit_template_type').onBlur(function()
				{
				   if($(this).val() == 1 || $(this).val() == 1 || $(this).val() == 1)
				   {
					$('#variable_select').fadeIn(100);
				   }
				   elseif($(this).val() == 1 || $(this).val() == 1 || $(this).val() == 1)
				   {
					$('#variable_select').fadeIn(100);
				   }
				   else()
				   {
					$('#variable_select').fadeIn(100);
				   }
				}); */
</script>
<script type="text/javascript">
$("#canvas_help").colorbox({html:'<div style="padding:20px; text-align: left;" ><h2>The Canvas</h2><p>This is where you will see the effects of the changes in the Processing.js code that you write. This is what your template will look like to the end user when you have saved it.</p></div>', width:"600px"});
$("#code_help").colorbox({html:'<div style="padding:20px; text-align: left;" ><h2>Processing.js Code</h2>This is where you will write the <strong><a href="http://processingjs.org/reference/" target="_blank">Processing.js</a></strong> code. For instructions on how to do this see the coding page <a href="<?php echo $base_url; ?>user/coding_things_to_know#code_snippets" target="_blank"><strong>HERE</strong></a>. You only need to write the bits of code that will physically draw the <a href="<?php echo $base_url; ?>user/coding_intro" target="_blank"><strong>data array</strong></a> out to the canvas. Leave the rest to us.</p></div>', width:"600px"});
$("#type_of_data_help").colorbox({html:'<div style="padding:20px; text-align: left;" ><h2>Types Of Data</h2><p>There are many different types of information / data sets. And you need to choose which one best suits your template description. The different types are basically self explanatory so below are a few examples of each:</p><ul><li><strong>Relationships among data points</strong> - Network Diagram, Scatterplot, Matrix Chart...</li><li><strong>Compare a set of values</strong> - Bar Chart, Block Histogram, Bubble Chart...</li><li><strong>Track rises and falls over time</strong> - Line Graph, Stack Graph...</li><li><strong>See the parts of a whole</strong> - Pie Chart, Treemap...</li><li><strong>Analyze a text</strong> - Word Tree, Tag Cloud, Word Cloud, Phrase Net...</li><li><strong>See the world</strong> - USA Map, World Map, China, Cape Town...</li></ul></div>', width:"600px"});
$("#category_help").colorbox({html:'<div style="padding:20px; text-align: left;" ><h2>What is a Category-Type Variable?</h2><li><p>Variables in terms of Number Picture are the columns on your Excel (etc...) spreadsheet. Column A will be variable 1, and Column B variable 2, etc...</p></li><li><p>When we talk about a Category-Type variable we mean a column on your spreadsheet that possesses values that are words and categories as apposed to numbers / amounts / values.</p></li><li><p>Eg. Mammal, Amphibian, Insect...</p></li><li><strong>So what you need to do is count the number of columns on your spreadsheet that contain category-type values (including names) and then type the number into the box.</strong></li></div>', width:"600px"});
$("#number_help").colorbox({html:'<div style="padding:20px; text-align: left;" ><h2>What is an Amount-Type Variable?</h2><li><p>Variables in terms of Number Picture are the columns on your Excel (etc...) spreadsheet. Column A will be variable 1, and Column B variable 2, etc...</p></li><li><p>When we talk about an Amount-Type variable we mean a column on your spreadsheet that possesses values that are numbers / amounts / values as apposed to words and categories.</p></li><li><p>Eg. 1002, 33.90, -1</p></li><li><strong>So what you need to do is count the number of columns on your spreadsheet that contain amount-type values and then type the number into the box.</strong></li></div>', width:"600px"});
$("#generated_data_help").colorbox({html:'<div style="padding:20px; text-align: left;" ><h2>Randomly Generated Data</h2><p>This data is randomly generated for testing purposes. The number of columns generated is dependent upon the number of Category- and Number-Type variables set above by you. To learn more about the technicalities of working with the data set click <a href="<?php echo $base_url; ?>user/coding_things_to_know#code_snippets" target="_blank"><strong>HERE</strong></a>...</div>', width:"600px"});
</script>