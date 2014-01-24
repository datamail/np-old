background(color(255,255,255));
color col1 = color(random(255), random(255), random(255));
color col2 = color(random(255), random(255), random(255));
color col_text =color(0, 0, 0) ;

smooth();
int radius = 200;
float barWidth = (2* PI*radius)/(data.length*1.5);
PFont myFont = loadFont("Geo");  
int font_size = 16;
textFont(myFont, font_size);  
textAlign(RIGHT, CENTER);

float largest1 = 0;
float largest2 = 0;
float multiplier = 1;
for (int a = 1; a < data.length; a++){
if(largest1 <  int(data[a][1]))
{
       largest1 =  float(data[a][1]);
}

if(largest2 <  int(data[a][2]))
{
       largest2 =  float(data[a][2]);
}
}
multiplier1 = 200 / largest1;
multiplier2 = 200 / largest2;

float delta = TWO_PI / (data.length-1);

for(int i = 1; i < data.length; i++) {

    float xPos = width / 2 + radius * cos(i * delta);
    float yPos = 550 + radius * sin(i * delta);

    pushMatrix();
    translate(xPos, yPos);
    rotate(delta * i);



      fill(col1);
      rect(0, 0, float(data[i][1]) * multiplier1,  barWidth/2);
      fill(col2);
      rect(0,  barWidth / 2,float(data[i][2]) * multiplier2,  barWidth / 2);
      fill(col_text);
      text(data[i][0], (- 5), barWidth * 0.5);

    popMatrix();    
  }

textAlign(LEFT, CENTER);
fill(col1);
rect(100, 950, 20, 20);
fill(col_text);
text(data[0][1], 140, 960);
fill(col2);
rect(500, 950, 20, 20);
fill(col_text);
text(data[0][2], 540, 960); 
fill(col_text);
font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 50);
font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 70, 700);