<h1>Coding Basics</h1>
<p><a href="http://processing.org/" target="_blank"><strong>Processing.js</strong></a> is a coding language that is based upon Java and is used to teach people the basics of computer programming. We use Processing.js to create the Number Picture templates by telling the code to draw shapes and curves onto the canvas that are proportional in size to the data that is input by a user or generated randomly for testing purposes.</p>
<p>All you need to do when creating a template is use the Processing.js functions that you want in combination with the data array that we provide and some other variables like the title and the blurb.</p>
<h2>Case-sensitivity</h2>
<p>Processing.js is a case-sensitive language which means that functions and variables need to be called using the right combination of upper- and lower-case letters.</p>
<h2>Variables</h2>
<p>You get a few different types of variables - Strings, integers, floats and booleans being the most common few.</p>
<ul>
    <li><p><strong><a href="http://processing.org/reference/String.html" target="_blank" style="text-transform:none">String</a></strong> - a 'String' is a string of characters, letters and numbers and spaces. Words, sentences, paragraphs and stories - basically anything textual is stored in a String variable. Numbers and other types of information can also be stored in Strings but Strings cannot be stored in number-type variables.</p></li>
    <li><p><strong><a href="http://processing.org/reference/int.html" target="_blank" style="text-transform:none">int</a></strong> - an 'int' is an integer - or in other words a whole-number that can be negative or positive.</p></li>
    <li><p><strong><a href="http://processing.org/reference/float.html" target="_blank" style="text-transform:none">float</a></strong> - a 'float' can hold virtually any number - negative or positive with a decimal points included.</p></li>
    <li><p><strong><a href="http://processing.org/reference/boolean.html" target="_blank" style="text-transform:none">boolean</a></strong> - a 'boolean' is a yes / no type variable that can either be set to true or to false.</p></li>
</ul>
<p>Variables either need to be created first before you can assign values to them or created at the same time that you assign a value to them. But they cannot have a value assigned to them before they have been created.</p>

<h2>Loops</h2>
<p>There are two types of loops that can be used with Processing.js - 'for' loops and 'while' loops.</p>
<p>A <a href="http://processing.org/reference/while.html" target="_blank" style="text-transform:none;  font-weight:bold;">'while' loop</a> will carry on doing a certain thing - over and over again while a certain condition is true - say while variable A is equal to 5, or the end of the array has not been reached yet.</p>
<p>A <a href="http://processing.org/reference/for.html" target="_blank" style="text-transform:none; font-weight:bold;">'for' loop</a> takes a temporary integer variable and sets it to an initial value. Then each loop it will add or subtract an amount from the variable and it will carry on repeating this until the variable reaches a certain value that is either too large or too small and then stop.</p>
<h2>Conditional Operators</h2>
<p>Conditional operators enable us to set conditions that need to be met by variables or loops. IF variable A equals variable B do something; IF variable C does NOT equal 'true' do something else; IF this ELSE that. You get the point...</p>
<h2>Logical Operators</h2>
<p>This is just a fancy name for AND's and OR's. These operators join the conditional operators together. </p>


<script type="text/javascript">
    $("#variables_help").colorbox({html:'<div style="padding:20px; text-align: left;" ><h2>What is a Category-Type Variable?</h2><li><p>Variables in terms of Number Picture are the columns on your Excel (etc...) spreadsheet. Column A will be variable 1, and Column B variable 2, etc...</p></li><li><p>When we talk about a Category-Type variable we mean a column on your spreadsheet that possesses values that are words and categories as apposed to numbers / amounts / values.</p></li><li><p>Eg. Mammal, Amphibian, Insect...</p></li></div><div style="padding:20px; text-align: left;" ><h2>What is a Number-Type Variable?</h2><li><p>Variables in terms of Number Picture are the columns on your Excel (etc...) spreadsheet. Column A will be variable 1, and Column B variable 2, etc...</p></li><li><p>When we talk about a Number-Type variable we mean a column on your spreadsheet that possesses values that are numbers / amounts / values as apposed to words and categories.</p></li><li><p>Eg. 1002, 33.90, -1</p></li></div>', width:"600px"});
</script>