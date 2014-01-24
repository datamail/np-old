background(255, 255, 255);
stroke(0, 0, 0);
line(100, 900, 900, 900);
line(100, 900, 100, 150);
noStroke();


smooth();
PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);

float x_largest = 0;
float y_largest = 0;
float x_smallest = 99999;
float y_smallest = 99999;
float diam_largest = 0;
float cat_largest = 1;

fill(color(random(255), random(255), random(255)));

for (int a = 0; a < data.length; a++){
if(data[a][1] > x_largest)
{
x_largest = data[a][1];
}
if(data[a][2] > y_largest)
{
y_largest = data[a][2];
}
if(data[a][3] > diam_largest)
{
diam_largest = data[a][3];
}
if(data[a][4] > cat_largest)
{
cat_largest = data[a][4];
}
if(data[a][1] < x_smallest)
{
x_smallest = data[a][1];
}
if(data[a][2] < y_smallest)
{
y_smallest = data[a][2];
}
}

x_multiplier = 800 / (x_largest );
y_multiplier = 750 / (y_largest );
diam_multiplier = 60 / diam_largest;
cat_multiplier = 255 / cat_largest;

ellipseMode(CENTER);
for(int a =0; a < data.length; a++)
{
fill(color(cat_multiplier*data[a][4],255-cat_multiplier*data[a][4] ,cat_multiplier*data[a][4] ));
ellipse(100 + ((data[a][1] ) * x_multiplier) , 900 - ((data[a][2] ) * y_multiplier), data[a][3] * diam_multiplier, data[a][3] * diam_multiplier);
fill(30);
ellipse(100 + ((data[a][1] ) * x_multiplier) , 900 - ((data[a][2] ) * y_multiplier), 2, 2);
text(data[a][0], 100 + ((data[a][1] ) * x_multiplier) + 4,  900 - ((data[a][2] ) * y_multiplier));

}
fill(0,0,0);
int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 50);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 70, 700);
textAlign(CENTER, BASELINE);
text(data[0][1], width/2, 950);
rotate(PI/2);
translate(0, -height);
text(data[0][2], width/2, 950);