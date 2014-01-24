<h1>Introduction</h1>
<p>
Basically, the code behind the scenes of the templates on number picture works in the following way:</p><p>

Data that is copied and pasted into the template by the user on the MAKE A PICTURE page is stored in a data array by Number Picture. A data array is basically a group of variables that are all connected to each other very simply.</p><p>You can think of it almost as a beehive.
The beehive is made up of honeycomb that itself is made up of a whole lot of cells. In each of these cells you can store something - a quantity of honey or some sort of bee, etc...
If the array is one-dimensional it means that all the cells are lined up in a row on a flat surface. Two-dimensional means two lines of honeycomb next to each other and three-dimensional: three. You get the point...</p><p>

When writing the code for a template you will create a loop that repeats itself over and over again until it has gone through the whole array of data. Each time that it performs a loop it will draw something out to the canvas using a function from Processing.js (eg. a rectangle,triangle or circle, etc...).</p><p>And its as simple as that...</p><p>

So for example if you were wanting to create a bar graph template you would get the value of the first cell in the honeycomb array and draw a rectangle onto the canvas starting at a fixed x and y coordinate of a fixed width and then of a height that is proportional to the value obtained. Next you would get the second cell and do the same but just changing the y coordinate and go across the page, one cell after the other. This can be automated by using loops and variables. To learn more about these and other technicalities see <a href="<?php echo $base_url; ?>user/coding_things_to_know">IMPORTANT THINGS TO KNOW</a>.</p>