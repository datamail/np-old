background(255,255,255);
fill(color(random(255), random(255), random(255)));

smooth();
int radius = 130;
float barWidth = (2* PI*radius)/(data.length*1.5);
PFont myFont = loadFont("Geo");  
int font_size = 16;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);

float largest = 0;
float multiplier = 1;
for (int a = 1; a < data.length; a++){
if(largest <  int(data[a][1]))
{
       largest =  float(data[a][1]);
}
}
multiplier = 200 / largest;

float delta = TWO_PI / (data.length-1);

for(int i = 1; i<data.length; i++) {

    float xPos = width/2+radius * cos(i* delta);
    float yPos = 550+radius * sin(i* delta);

    pushMatrix();
    translate(xPos, yPos);
    rotate(delta * i);

    for(int j = data[i].length - 1; j>-1;j--)
    {
     
      rect((float(data[i][data[i].length-1]) - float(data[i][j]))*multiplier,0,float(data[i][j]) * multiplier,  barWidth);
      text(data[i][0], float(data[i][j]) * multiplier + 5, barWidth * 0.5);
    }
    popMatrix();    
  }

font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 50);
font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 70, 700);