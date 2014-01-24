background(0);

smooth();
int radius = 200;
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
int red = 0;
int green = 0;
int blue = 0;
col_counter = 0;

for(int i = 1; i<data.length; i++) {

    float xPos = width/2+radius * cos(i* delta);
    float yPos = 500+radius * sin(i* delta);

    pushMatrix();
    translate(xPos, yPos);
    rotate(delta * i);

    for(int j = data[i].length - 1; j>-1;j--)
    {
if(col_counter >= 0 && col_counter <= 0.16){
   red = 1;
   green =  (6) * col_counter;
   blue = 0.2;
}
if(col_counter >= 0.17 && col_counter <= 0.33){
   red = -(6) * col_counter + 1;
   green = (6) * col_counter;
   blue = 0.2;
}
if(col_counter >= 0.34 && col_counter <= 0.5){
 green = 1; 
 blue = (3) * (col_counter - 1 / 3);
 red = 0.2;
}
if(col_counter >= 0.5 && col_counter <= 0.66){
 green = -(3) * (col_counter - 1 / 3) + 1; 
 blue = 1 - green;
 red = 0.2;
}
if(col_counter >= 0.67 && col_counter <= 0.83){
 green = 0.2; 
 blue = 1;
 red = (3) * (col_counter - 2 / 3);
}
if(col_counter >= 0.83 && col_counter <= 1){
 green = 0.2; 
 blue = -(3) * (col_counter - 2 / 3) + 1;
 red = 1 - blue;
}
fill(red * 255, green * 255, blue * 255);
      rect((float(data[i][data[i].length-1]) - float(data[i][j]))*multiplier,0,float(data[i][j]) * multiplier,  barWidth);
      text(data[i][0], float(data[i][j]) * multiplier + 5, barWidth * 0.5);
    }
col_counter += delta / (2 * PI);
    popMatrix();    
  }

fill(255);
PFont myFont2 = loadFont("Lobster");  
font_size = 22;
textFont(myFont2, font_size);  
textAlign(CENTER, BASELINE);
text(title, 500, 400);
font_size = 13;
textAlign(LEFT, BASELINE);
textFont(myFont, font_size);  
textblock(blurb, 375 , 430, 250);