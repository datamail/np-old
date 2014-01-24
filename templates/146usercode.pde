background(255, 255, 255);
stroke(0);
strokeWeight(2);
smooth();
PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);

int total = 0;
for (int a = 1; a < data.length; a++){
total +=  int(data[a][1]);
}

float multiplier = 800 / total;
float vert_multiplier = 650 / data.length;

int hor_counter = 0;
rect(100, 250, 800, 50);
textAlign(RIGHT);
for(int c =1; c < data.length; c++)
{
fill(255);
       line(100 + hor_counter, 250, 100 + hor_counter, 300 + vert_multiplier * c);
fill(0);
       text(data[c][1], 90 + hor_counter, 300 + vert_multiplier * c);
       text(data[c][0], 90 + hor_counter, 310 + vert_multiplier * c );
       hor_counter += int( data[c][1]) * multiplier;
 }

fill(0);
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);
int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 700);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 720, 250);