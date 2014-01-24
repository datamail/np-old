<h1>Frequently Asked Questions</h1>
<h2>How do I Make a Number Picture?</h2>
<li><p>Browse through the templates on offer <a href="<?php echo $base_url; ?>template/search" >HERE</a></p></li>
<li><p>Click the one you like</p></li>
<li><p>Make sure it is using the same type of data that you are putting into it. Learn more <a id="type_of_data_help"  class="help">HERE</a></p></li>
<li><p>Make sure that it can handle the same number of category- and number-type variables that you have in your data. Learn more <a id="variables_help" class="help">HERE</a></p></li>
<li><p>Simply highlight the data you want to visualize in your spreadsheet (Excel, etc...) and copy & paste it into the Data text area.</p></li>
<li><p>Type a suitable Title and Blurb for your Number Picture</p></li>
<li><p>Click Refresh to see if you get the desired result</p></li>
<li><p>If it's not right then change your data accordingly</p></li>
<li><p>Otherwise click Save and you will be presented with the finished result</p></li>
<li><p>This you can then right-click and save to your local computer</p></li>
<p>Note: All Category-Type variables come before the Number-Type variables.</p>
<hr />

<h2>How do I Make a Template?</h2>
<li><p>Click <a class="make_a_template" href="<?php echo ($base_url . "template/new_template"); ?>" >MAKE A TEMPLATE</a></p></li>
<li><p>Write the appropriate code for your template using Processing.js language in the Code text area. Learn more <a class="make_a_template" href="<?php echo ($base_url . "user/coding_intro"); ?>" >HERE</a>...</p></li>
<li><p>Click Refresh to see any changes made</p></li>
<li><p>And Save once it is complete
<hr />
<h2>How do I Edit a Template?</h2>
<li><p>Go to your Admin Area <a class="make_a_template" href="<?php echo ($base_url . "user/dashboard"); ?>" >HERE</a>...</p></li>
<li><p>Click on the Template you would like to edit</p></li>
<li><p>And edit the Processing.js code in the Code text area much the same as you would if you were creating a new template.</p></li>
<li><p>Click Refresh to see the effects of any changes made</p></li>
<li><p>Click Save to save the edited version</p></li>
<hr /><?php /*
<h2>How do I Make my Number Pictures Private?</h2>
<li><p>Sign up for a premium membership <a class="make_a_template" href="<?php echo ($base_url . "paypal/privacy"); ?>" >HERE</a> and all your pictures will automatically become private - old and new</p></li>
<hr /> */ ?>
<div id="types_of_variables"></div>
<h2>What is a Number-Type Variable?</h2>
<li><p>Variables in terms of Number Picture are the columns on your Excel (etc...) spreadsheet. Column A will be variable 1, and Column B variable 2, etc...</p></li>
<li><p>When we talk about a Number-Type variable we mean a column on your spreadsheet that possesses values that are numbers / amounts / values as apposed to words and categories.</p></li>
<li><p>Eg. 1002, 33.90, -1</p></li>
<hr />
<h2>What is a Category-Type Variable?</h2>
<li><p>Variables in terms of Number Picture are the columns on your Excel (etc...) spreadsheet. Column A will be variable 1, and Column B variable 2, etc...</p></li>
<li><p>When we talk about a Category-Type variable we mean a column on your spreadsheet that possesses values that are words and categories as apposed to numbers / amounts / values.</p></li>
<li><p>Eg. Mammal, Amphibian, Insect...</p></li>
<script type="text/javascript">
$("#type_of_data_help").colorbox({html:'<div style="padding:20px; text-align: left;" ><h2>Types Of Data</h2><p>There are many different types of information / data sets. And you need to choose which one best suits your template description. The different types are basically self explanatory so below are a few examples of each:</p><ul><li><strong>Relationships among data points</strong> - Network Diagram, Scatterplot, Matrix Chart...</li><li><strong>Compare a set of values</strong> - Bar Chart, Block Histogram, Bubble Chart...</li><li><strong>Track rises and falls over time</strong> - Line Graph, Stack Graph...</li><li><strong>See the parts of a whole</strong> - Pie Chart, Treemap...</li><li><strong>Analyze a text</strong> - Word Tree, Tag Cloud, Word Cloud, Phrase Net...</li><li><strong>See the world</strong> - USA Map, World Map, China, Cape Town...</li></ul></div>', width:"600px"});
$("#variables_help").colorbox({html:'<div style="padding:20px; text-align: left;" ><h2>What is a Category-Type Variable?</h2><li><p>Variables in terms of Number Picture are the columns on your Excel (etc...) spreadsheet. Column A will be variable 1, and Column B variable 2, etc...</p></li><li><p>When we talk about a Category-Type variable we mean a column on your spreadsheet that possesses values that are words and categories as apposed to numbers / amounts / values.</p></li><li><p>Eg. Mammal, Amphibian, Insect...</p></li></div><div style="padding:20px; text-align: left;" ><h2>What is a Number-Type Variable?</h2><li><p>Variables in terms of Number Picture are the columns on your Excel (etc...) spreadsheet. Column A will be variable 1, and Column B variable 2, etc...</p></li><li><p>When we talk about a Number-Type variable we mean a column on your spreadsheet that possesses values that are numbers / amounts / values as apposed to words and categories.</p></li><li><p>Eg. 1002, 33.90, -1</p></li></div>', width:"600px"});
</script>