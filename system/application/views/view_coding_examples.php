<h1>Template Examples</h1>
<h2>Simple Bar Chart</h2>
<p>
    In this tutorial we will take you through the steps of creating a simple bar chart template.
</p>
<p>
    Firstly, we will decide how many variables our template will be able to handle. I have chosen to go with two to keep it very simple - the name of each item and the value assigned to it.</p><p>Variables in terms of Number Picture are the columns of the user's spreadsheet. So if we have two variables this means that the spreadsheet will have two columns. The name column will be a category-type variable because it will contain words and the value column will be a number-type variable. So we set one of each in the input boxes provided.</p>
<p>
    Now we get to the code. To begin with you will set up a few things:
</p>
<p>
            Background colour:
</p>
            <pre><code>background(color(44,44,44));</code></pre>
            <p>
            Fill colour (the colour of text as well as the area within shapes and below curves):
            </p>
            <pre><code>fill(color(random(255), random(255), random(255)));</code></pre>
            <p>
            Smoothing the edges of shapes (anti-aliasing):
            </p>
            <pre><code>smooth();</code></pre>
            <p>
            And loading and setting a text font as well as the text alignment:
            </p>
            <pre><code>PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(RIGHT, CENTER);</code></pre>
    <p>Now we are ready to begin drawing out our chart.</p>
    <p>
        A bar chart is basically a row of rectangles lined up side by side next to each other with varying heights that are dependent upon the values that they represent. Therefore, we will be using the rect() function from Processing.js. We want all the rectangles to be of the same width so we will create a variable called 'column_width' and set it to some value so that we do not have to set it over and over again throughout the code.
    </p>
    <pre><code>column_width = 20;
column_width_with_space = column_width + 5;</code></pre>
    <p>
        Next, we will create the drawing loop of the template that will draw out parts of the data set one after the other until it has done them all. We have chosen to go with a 'for' loop for this. So we will start at 0 and add 1 to the temporary variable 'a' until it has reached the end of the data array.
    </p>
    <pre><code>for(int a =0; a < data.length; a++)
{
...
}</code></pre>
    <p>
        Inside this loop we draw our rectangle using the rect() Processing.js function. This will mean that a rectangle is drawn each time the loop happens. The rectangle we will draw will have a width of the 'column_width' variable that was set above; a height corresponding to the value obtained from the data array; a starting y-coordinate (vertical alignment) that will not change; and a starting x-coordinate that is dependant on the 'column_width' and the number of columns / rectangles that have been drawn so far. So we end up with the structure: rect(column_width x number previously drawn columns, constant y, column_width, data[..][..]). The value obtained from the data array comes in the form of a String variable and if we want to use it as a number then this will need to be converted into an integer in this case using the int() function.
    </p>
    <pre><code>for(int a =0; a < data.length; a++)
{
rect(100 + a * column_width_with_space, 150, column_width, int(data[a][1]));
}</code></pre>
    <p>
        But now you will realize that the graph is upside down, so we need to rotate it before we start drawing and then set it back to the centre point that it was previously at. When you rotate the canvas it pivots around the top left corner. Positive numbers rotate it in a clockwise direction. Once it has been rotated it will be going off the canvas a bit so it will need to be translated back into position. See the code below as well as the documentation at Processing.js. Every time you rotate and translate the canvas you can always reverse it by doing the opposite in the reverse sequence.
    </p>
    <pre><code>rotate (PI);
translate(-width, -height);</code></pre>
    <p>
        Next we will write out the column headings each time a rectangle is drawn and use a bit of rotation and translation to draw them on their sides. So the loop will now look like this.
    </p>
    <pre><code>for(int a =0; a < data.length; a++)
{
rect(100 + a * column_width_with_space, 150, column_width, int(data[a][1]) * multiplier);
rotate(PI/2);
translate(0, -height);
text(data[a][0] , 145, 900 - a * column_width_with_space  - (column_width_with_space / 2)  );
translate(0, height);
rotate(-PI/2);
}</code></pre>
    <p>
        Next we write out the title.
    </p>
    <pre><code>rotate(PI);
translate(-width, -height);
int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 50);</code></pre>
    <p>
        And the blurb using the textblock() function from Number Picture. This will ensure that the blurb does not go off the page and that words are not cut in half. You will set the text that needs to be written, the starting x-coordinate, the starting y-coordinate, and the width of the textblock. ie: textblock(text, x-coordinate, y-coordinate, width)
    </p>
    <pre><code>int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 70, 700);</code></pre>
    <p>
    Now, you will probably notice that some of the rectangles are going off the canvas and this leads us to our last step: multipliers. Multipliers ensure that what we draw does not go off the canvas. In this example we should have two: one for the column width - depending on how many columns there are in relation to the canvas width; and secondly one for the columns' heights depending on the size of the largest value in the array and the size of the canvas.
    </p>
    <p>
    Firstly, the column width will need to take into account the width of the canvas, the width of the margin we have set around the canvas (in this case 100), and the little spaces between the columns (in this case 5), and then divide the remaining drawing space by the number of rows in our data array. So we will need to change what we previously wrote for the column width to the following:
    </p>
    <pre><code>column_width =( width - 200 - (data.length * 5)) / (data.length);
column_width_with_space = column_width + 5;</code></pre>
    <p>
        When working out the column height multiplier we will first find the largest value in the array in the column we are concerned with and then divide the available drawing space by this (taking into account margins we have set - 100 in this case on each side).
        </p>
    <pre><code>int largest = 0;
for (int a = 0; a < data.length; a++){
if(int(data[a][1]) > largest){
largest = int(data[a][1]);
}
}

multiplier = 700 / largest;</code></pre>
    <p>
        And voila we are left with a complete template:
    </p>
    <pre><code>column_width =( width - 200 - (data.length * 5)) / (data.length);
column_width_with_space = column_width + 5;

background(color(44,44,44));
fill(color(random(255), random(255), random(255)));
smooth();

PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(RIGHT, CENTER);

int largest = 0;
for (int a = 0; a < data.length; a++){
if(int(data[a][1]) > largest){
largest = int(data[a][1]);
}
}

multiplier = 700 / largest;

rotate (PI);
translate(-width, -height);

for(int a =0; a < data.length; a++)
{
rect(100 + a * column_width_with_space, 150, column_width, int(data[a][1]) * multiplier);
rotate(PI/2);
translate(0, -height);
text(data[a][0] , 145, 900 - a * column_width_with_space  - (column_width_with_space / 2)  );
translate(0, height);
rotate(-PI/2);
}

rotate(PI);
translate(-width, -height);
int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 50);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 70, 700);
</code></pre>
    <p>
        See the finished result <a href="http://numberpicture.com/picture/new_picture/72" >HERE</a>...
    