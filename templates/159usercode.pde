color back = color(44,44,44); 
color fore = color(random(215), random(215), random(215));
background(back);
fill(fore);
smooth();

PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);

int largest = 8;
height_multiplier = 700 / largest;

int space_available;
if(data.length < 10)
{
space_available = 720;
}
else 
{
space_available = 800;
}

float column_width = (space_available - (data.length - 1) * 5) / (data.length - 1);
float column_width_with_space = column_width + 5;

float height_counter = 0;
ellipseMode(CORNERS);

for(int a =1; a < data.length; a++)
{
 height_counter = 0;
 while(height_counter < data[a][1] * height_multiplier)
 {
 ellipse(100 + column_width_with_space * (a -1), 850 - height_counter, 100 + column_width_with_space * (a -1) + column_width, 850 - height_counter - column_width);
 height_counter += height_multiplier;
 }

 fill(fore);
 rotate(PI/2);
 translate(0, -height);
 text(data[a][0] , 860, 900 - (column_width_with_space / 2 + column_width_with_space * (a - 1)));

 translate(0, height);
 rotate(-PI/2);
 if (data[a][1] == -1)
  {
  text("?", 800, 900 - (column_width_with_space / 2 + column_width_with_space * (a - 1)));
  }
}

int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 50);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 70, 700);