<form method="post" accept-charset="utf-8" action="<?php echo ($base_url . 'picture/new_picture/' . $template_id); ?>" name="form" id="form" />
<h1>Make A Picture with template <?php echo $template_id; ?></h1>
<a class="next_button" href="<?php echo $base_url; ?>picture/next_template/<?php echo $template_id; ?>" ><</a>
<a class="previous_button" href="<?php echo $base_url; ?>picture/previous_template/<?php echo $template_id; ?>" >></a>
<?php
    $excel_data = array(
		'name' => 'excel_data',
		'id' => 'excel_data', 
		'value' => set_value('excel_data')
	);
    
    $title = array(
		'name' => 'title',
		'id' => 'title',
		'class' => 'long_input',
		'value' => set_value('title')
	);

    $blurb = array(
		'name' => 'blurb',
		'id' => 'blurb', 
		'value' => set_value('blurb')
	);

    $human = array(
		'name' => 'human',
		'id' => 'human',
		'class' => 'long_input',
		'value' => set_value('human')
	);

    switch($template_data[0]['type']){
    case 1:
	$type_name = "Compare A Set Of Values";
    break;
    case 2:
	$type_name = "Track Rises And Falls Over Time";
    break; 
    case 3:
	$type_name = "Relationships Among Data Points";
    break; 
    case 4:
	$type_name = "Parts Of The Whole";
    break; 
    case 5:
	$type_name = "Analyze A Text";
    break; 
    case 6:
	$type_name = "See The World";
    break;
    }
?>


<div class="hasFloats">
    
	<?php
	    if(!$processing_code == '')
	    {
		echo $processing_code;
	?>
	    <div id="canvas_wrapper">
		<canvas id="processing-canvas"></canvas><br><br>
	    </div>
	<?php
	    }
	?>
    
    
<div id="left_new_picture" class="border_bottom hasFloats">
    <a href="#large"><img src="<?php echo $base_url . 'template_images/' . $template_id . '_thumb.png'; ?>" /></a>
    <div class="hasFloats">
	<div class="center" class="hasFloats">
	    <strong ><a id="type_of_data_help" class="help" style="display: block; padding-right: 0px;">	
		    <?php echo $type_name; ?>
	    </a></strong>
	    <a  class="help lowercase" id="variables_help">
		    Category-Type Variables:
		    <strong>
			<?php echo $template_data[0]['discrete_inputs']; ?>
		    </strong>
		<br>
		    Amount-Type Variables:
		    <strong>
			<?php echo $template_data[0]['continuous_inputs']; ?>
		    </strong>
	    </a>
	</div>
	<?php if($template_data[0]['notes'] != "") { echo '<h2>Notes For Use</h2><p>' . $template_data[0]['notes'] . '</p>'; } ?>
	<p>
	    <span class="highlight">( Click on the question-marks for help )</span>
	</p>
	<a class="psuedo_button" style="" href="<?php echo $base_url; ?>template/view_template_source/<?php echo $template_id; ?>">View Template Source</a>
    </div>
</div>



<div id="right_new_picture">
    <div id="data_container">
	<p>
	    <div  class="highlight"><?php echo validation_errors(); ?></div>
	</p>
        <p>
	    <h3 style="margin-top: 0;"><a class="help no_transform" id="data_help">Data (Copy & Paste From Spreadsheet)</a></h3>
	    <?php echo form_textarea($excel_data); ?>
	</p>
    </div>
    <p>
	<h3>Title</h3>
	<?php echo form_input($title); ?>
    </p>
    <p>
	<h3>Blurb</h3>
	<?php echo form_textarea($blurb); ?>
    </p>
    <p style="display: none;">What is the first word in the phrase "number picture"?<br>
	<?php echo form_input($human); ?>
    <p>
        <?php echo form_submit(array('name' => 'refresh'), 'Refresh'); ?><a id="fakeSave" class="psuedo_button" style="top:0;">Save Picture</a>
	<div style="display: none; margin-left: 200px;" class="realSave"><?php echo $captcha; ?></div>
        <div style="display: none;" class="realSave"><?php echo form_submit(array('name' => 'save'), 'Save Picture'); ?></div>
	<script type="text/javascript">
	    $('#fakeSave').click(function(){
		$('.realSave').fadeIn();
		$('#fakeSave').hide();
	    });
	</script>
	<div class="note">Note: Click REFRESH at least once before saving.<br /><span class="highlight">NB: Please don't click SAVE if the picture does not look right.</span>
	
	</div>
    </p>
    <input type='hidden' name='save_image' />
    <?php echo form_close(); ?>
</div>

</div>


<div id="large">
    <h3>Example</h3>
	 <img src="<?php echo $base_url . 'template_images/' . $template_id . '.png'; ?>" />
</div>

<div id="disqus_thread"></div>
<script type='text/javascript'>
$(document).ready(function() {
	$("#form").submit(function() {
	    
		var canvas = document.getElementById("processing-canvas");
		var save_image = canvas.toDataURL("image/png");
		$('input[name=save_image]').val(save_image);
		
	});
});
</script>
<script type="text/javascript">
$("#type_of_data_help").colorbox({html:'<div style="padding:20px; text-align: left;" ><h2>Types Of Data</h2><p>There are many different types of information / data sets. And you need to choose which one best suits your template description. The different types are basically self explanatory so below are a few examples of each:</p><ul><li><strong>Relationships among data points</strong> - Network Diagram, Scatterplot, Matrix Chart...</li><li><strong>Compare a set of values</strong> - Bar Chart, Block Histogram, Bubble Chart...</li><li><strong>Track rises and falls over time</strong> - Line Graph, Stack Graph...</li><li><strong>See the parts of a whole</strong> - Pie Chart, Treemap...</li><li><strong>Analyze a text</strong> - Word Tree, Tag Cloud, Word Cloud, Phrase Net...</li><li><strong>See the world</strong> - USA Map, World Map, China, Cape Town...</li></ul></div>', width:"600px"});
$("#data_help").colorbox({html:'<div style="padding:20px; text-align: left;" ><h2>Data</h2><p>Copy and paste your data directly from Excel or whichever spreadsheet software you are using. Try to edit it in the text area at your own risk. Columns are seperated by spaces and rows begin on new lines.</p><p>Note: spaces may not be used for names etc... - instead you will need to use an underscore character ("_") and this will automatically be converted into a space when the picture is generated.</p></div>', width:"600px"});
$("#variables_help").colorbox({html:'<div style="padding:20px; text-align: left;" ><h2>What is a Category-Type Variable?</h2><li><p>Variables in terms of Number Picture are the columns on your Excel (etc...) spreadsheet. Column A will be variable 1, and Column B variable 2, etc...</p></li><li><p>When we talk about a Category-Type variable we mean a column on your spreadsheet that possesses values that are words and categories as apposed to numbers / amounts / values.</p></li><li><p>Eg. Mammal, Amphibian, Insect...</p></li><h2>What is an Amount-Type Variable?</h2><li><p>Variables in terms of Number Picture are the columns on your Excel (etc...) spreadsheet. Column A will be variable 1, and Column B variable 2, etc...</p></li><li><p>When we talk about an Amount-Type variable we mean a column on your spreadsheet that possesses values that are numbers / amounts / values as apposed to words and categories.</p></li><li><p>Eg. 1002, 33.90, -1</p></li></div>', width:"600px"});
</script>
<script type="text/javascript">
                var disqus_shortname = 'numberpicture';             
                // The following are highly recommended additional parameters. Remove the slashes in front to use.
                // var disqus_identifier = 'unique_dynamic_id_1234';
                // var disqus_url = 'http://example.com/permalink-to-page.html';
                (function() {
                    var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                    dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                })();
            </script>
