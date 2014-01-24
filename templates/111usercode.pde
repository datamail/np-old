background(255, 255, 255);

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

int hor_counter = 0;
for(int c =1; c < data.length; c++)
{
       color it = color((222,125,11), (236,197,36), (12,146,210));
       fill(it);
       stroke(it);
       rect(100 + hor_counter, 250, int(data[c][1]) * multiplier, 50);
       line(100 + hor_counter, 300, 100 + hor_counter, 300 + 40 * c);
       textAlign(RIGHT);
       text(data[c][1], 90 + hor_counter, 300 + 40 * c);
       textAlign(LEFT);
       text(data[c][0], 110 + hor_counter, 300 + 40 * c);
       hor_counter += int( data[c][1]) * multiplier;
 }

fill(0, 0, 0);
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);
int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 375, 700);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 375 , 720, 250);