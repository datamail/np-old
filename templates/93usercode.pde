color back = color(255,255,255); 
color fore = color(random(255), random(255), random(255));
background(back);
fill(fore);
smooth();

PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);

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
multiplier = multiplier * 0.9;
}
}

ellipseMode(CORNERS);
float height_counter = 900;
for(int a =1; a < data.length; a++)
{
ellipse(width / 3 * 2 - int(data[a][1]) * multiplier / 2 , height_counter, width / 3 * 2 + int(data[a][1]) * multiplier / 2, height_counter - int(data[a][1]) * multiplier);
text(data[a][0] , width / 3 * 2 + int(data[a][1]) * multiplier / 2 + 10, height_counter -  int(data[a][1]) * multiplier / 2);
height_counter -= int(data[a][1]) * multiplier;
}

int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 100);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 120, 200);