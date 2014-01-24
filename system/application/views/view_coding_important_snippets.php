<h1 id="code_snippets">Important Code Snippets</h1>
<h2>The Data Array</h2>
<p>The array of data that Number Picture creates for you each time that a template is used is called 'data'. The size of data will depend upon the amount of data that is copied and pasted by the user into the data text area on the template page when they are using it. It could be one dimensional, 2D, 3D, or more - depending upon how many columns the users spreadsheet has.</p>
<p>The first cell of a row has a value of 0, the second cell a value of 1, etc...<br />
So if you want to obtain the value that was in Row 2, Column C of the spreadsheet you will write in you template code:
<pre><code>data [1] [2]</code></pre>
    <p>Row 100, Column F:</p>
    <pre><code>data [99] [5]</code></pre>
    <p>Row 1, Column A:</p>
    </code></pre>
    <pre><code>data [0] [0]</code></pre>
</p>

<p>Another thing to bear in mind is that all Category-Type variables come before the Number-Type variables when data is input into a template. Learn more about these <a id="variables_help">HERE</a>...</p>

<p>The title of the picture is stored in a variable called 'title', and the blurb in 'blurb'. You can get the number of rows by typing 'number_of_rows' and the number of columns by 'number_of_columns' but be careful with the latter because it computes this number only from one row of data which could possibly contain a different number of elements to other rows.<br>
Alternately, you can use the array's 'length' function.
<pre><code>number_of_rows = data.length;
number_of_columns = data [0].length;</code></pre></p>

<h2>The Canvas</h2>
<p>The Processing.js canvas is 1000px x 1000px in size. To retrieve the width you can type the word 'width', and the same goes for 'height'.</p>

<h2>Colours</h2>
<p>Working with colors in Processing.js works in the following way:</p>
<p>Firstly, you will create the colour that you want to use by using the color() function and setting the red, green and blue ratios between 0 & 255 for each (the transparency can also be set with the 'alpha' attribute).<br>Example:</p>
<pre><code>color color_red = color(255, 0, 0);
color color_white = color(255, 255, 255);
color color_black = color(0, 0, 0);
color color_orange = color(255, 180, 0);</code></pre>
<p>Once you have created the colour, you can then set the background, stroke or fill of the picture with it whenever you would like to change these.</p>
<p>The 'stroke' can be thought of the lines and the borders of shapes and the 'fill' is the area within shapes or below curves.</p>
<pre><code>background(color_white);
stroke(color_orange);
fill(0, 0, 0);</code></pre>
<p>These can be changed each time you draw something new, or even be generated randomly using the 'random()' function in combination with the above mentioned functions.</p>
<p>Note: the 'smooth()' functions is also a good little addition to use when setting the stroke or fill. It tries to eliminate pixelated edges.</p>

<h2>Text Block</h2>
<p>A textblock is used to write out columns of text that are a specified width and do not cut words in half. You need to specify the x- and y- starting coordinates as well as the width and the text that you want to write out. It takes the following generic form: textblock(text, starting-x, starting-y, width)
</p>
<p>Example</p>
<pre><code>textblock ("this is a column 200px wide starting at 10 x and 20 y", 10, 20, 200);</code></pre>

<h2>Multipliers</h2>
<p>Using a multiplier in your templates to ensure that data drawn to the canvas does not go off the page is always a good idea. This means that anybody with any sort of data set, no matter how small or large their values might be will be able to create a Number Picture that looks vaguely similar to the example that you have generated when making it. It essentially means converting the values in the data array from absolute values to relative ones instead.</p>
<p>One method of doing this is to loop through the data set and find the largest value for each column. (This can be done by creating a variable with value of 0 and checking to see if the value obtained each loop from the data array is larger than this variable. If so then set the variable to the value obtained from the data set.)</p>
<p>Once you have the largest value then you see what dimensions it will influence when drawing shapes (eg. length of a rectangle or radius of a circle) and find the maximum possible value that these can be before things start going off the page.</p>
<p>Divide this maximum length / height by the maximum value obtained from the data set and then you have your multiplier.</p>
<p>Each time you draw the desired shape you will multiply the figured obtained from the data array by the multiplier and this will ensure that the shapes do not go off the page.</p>

<h2>Forbidden Snippets</h2>
<p>The following functions / commands are forbidden for use in Number Picture for security reasons:</p>
<pre><code>size(..., ...);</code></pre>
<pre><code>link(...);</code></pre>
<pre><code>saveStrings(...);</code></pre>
<pre><code>loadBytes(...);</code></pre>
<pre><code>loadStrings(...);</code></pre>
<pre><code>save(...);</code></pre>
<pre><code>saveFrame(...);</code></pre>
<pre><code>saveStrings(...);</code></pre>


<h2>Following On</h2>
<p>And that is basically all you need to know to be able to understand the logic behind the code of a template - oh and don't forget to put a ';' at the end of each line of code - this can be an especially common mistake that can take a while to find.</p>

<p>So once you have got the basics, next you will need to look at what sort of 'functions' can be done using Processing.js. Processing.js enables us to draw shapes and curves onto the canvas; work with colors; mathematically compute numbers; render text and typography; work with images, variables and text; and rotate and transform the canvas itself. You can see the instructions for using Processing.js <a href="http://processing.org/reference/" target="_blank">HERE</a>.</p>

<p>Have a look at some examples of working templates <a href="<?php echo $base_url; ?>user/coding_examples">HERE</a>...</p>