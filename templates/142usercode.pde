color back = color(255,255,255); 
color fore = color(random(255), random(255), random(255));
background(back);
fill(fore);
smooth();

PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);

int largest = 0;
for(int a = 1; a < data.length; a++)
{
if(data[a][1] > largest)
{
largest = int(data[a][1]);
}
}

int total_added = 0;
boolean fits = false;
float multiplier = 9999;
while(fits == false){
for(int a = 1; a < data.length; a++)
{
total_added += int(data[a][1]) * multiplier;
}
if(total_added < 800)
{
fits = true;
}
else
{
total_added = 0;
multiplier = multiplier * 0.99;
}
}

ellipseMode(CORNERS);
float width_counter = 100;
fill(0);
for(int a =1; a < data.length; a++)
{
ellipse(width_counter - int(data[a][1]) * multiplier / 2, height / 2 - int(data[a][1]) * multiplier, width_counter + int(data[a][1]) * multiplier * 3 / 2, height / 2 + int(data[a][1]) * multiplier);
width_counter += int(data[a][1]) * multiplier;
}
width_counter = 100;
for(int a =1; a < data.length; a++)
{
fill(color(random(255), random(255), random(255)));
ellipse(width_counter, height / 2 - int(data[a][1]) * multiplier / 2, width_counter + int(data[a][1]) * multiplier, height / 2 + int(data[a][1]) * multiplier / 2);
rotate(PI / 2);
translate(0, -height);
largest_text = 0;
text(data[a][0] , 500 +largest * multiplier + 10, 1000 - width_counter - int(data[a][1]) * multiplier / 2);
translate(0, height);
rotate(-PI / 2);
width_counter += int(data[a][1]) * multiplier;
}

fill(0,0,0);
int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 100);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 120, 200);