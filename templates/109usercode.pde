background(random(255), random(255), random(255));
color fill_and_stroke = color(255, 255, 255);
stroke(fill_and_stroke);
fill(fill_and_stroke);
strokeWeight(2);
smooth();

PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);

float column_width = 780 / (data.length - 1);

float largest = 0;
long smallest = 99999999999;
for (int a = 0; a < data.length; a++){
if(largest < data[a][1]){
largest =  int(data[a][1]);
}
if(smallest > data[a][1]){
smallest =  int(data[a][1]);
}
}

multiplier = 700 / largest;

int previous_x = 120;
int previous_y = data[1][1] * multiplier;
beginShape();
for(int a =2; a < data.length; a++)
{
vertex(previous_x, 850 - previous_y);
vertex(previous_x + column_width, 850 - data[a][1] * multiplier);
rotate(PI/2);
translate(0, -height);
text(data[a][0], 880, 1000 - (previous_x + column_width));
translate(0, height);
rotate(-PI/2);
previous_x = previous_x + column_width;
previous_y = data[a][1] * multiplier;
}
endShape();

line (100, 870, 900, 870);
line (100, 870, 100, 150);
rotate(PI/2);
translate(0, -height);
text(data[1][0], 880, 880);
translate(0, height);
rotate(-PI/2);
textAlign(RIGHT, CENTER);
text(smallest, 90, 850 - smallest * multiplier);
text(largest, 90, 150);
  
textAlign(LEFT, BASELINE);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 70, 800);

myFont = loadFont("Monofett");  
int font_size = 30;
textFont(myFont, font_size);
text(title, 100, 50);