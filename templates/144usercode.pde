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
fill(0);
for(int a =1; a < data.length; a++)
{
ellipse(width / 3 * 2 - int(data[a][1]) * multiplier, height_counter + int(data[a][1]) * multiplier / 2, width / 3 * 2 + int(data[a][1]) * multiplier, height_counter - int(data[a][1]) * multiplier * 3 / 2);
height_counter -= int(data[a][1]) * multiplier;
}
height_counter = 900;
fill(fore);
for(int a =1; a < data.length; a++)
{
ellipse(width / 3 * 2 - int(data[a][1]) * multiplier / 2 , height_counter, width / 3 * 2 + int(data[a][1]) * multiplier / 2, height_counter - int(data[a][1]) * multiplier);
try{
    if (int(data[a][1]) * multiplier / 2 + int(data[a + 1][1]) * multiplier / 2 < 15 || int(data[a][2]) * multiplier / 2 + int(data[a + 1][2]) * multiplier / 2 < 15) {
stroke(fore);
        text(data[a][0],  width / 3 * 2 + int(data[a][1]) * multiplier / 2  +  levels *  120, height_counter -  int(data[a][1]) * multiplier / 2);
        
        line(width / 3 * 2 + int(data[a][1]) * multiplier / 2 +  levels *  120, height_counter -  int(data[a][1]) * multiplier / 2,  width / 3 * 2 + int(data[a][1]) * multiplier / 2  + 40, height_counter -  int(data[a][1]) * multiplier / 2);
        noStroke();
        levels += 1;
    } else {
        levels = 1;
        text(data[a][0] , width / 3 * 2 + int(data[a][1]) * multiplier / 2 + 40, height_counter -  int(data[a][1]) * multiplier / 2);
    }
}
catch(Exception e){
text(data[data.length - 1][0] , width / 3 * 2 + int(data[a][1]) * multiplier + 40, height_counter -  int(data[a][1]) * multiplier / 2);
//text(data[data.length - 1][0], 500 + largest * multiplier + 10, 1000 - width_counter - int(data[data.length - 1][1]) * multiplier / 2);
}

height_counter -= int(data[a][1]) * multiplier;
}

int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 100);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 120, 200);