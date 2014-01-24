void setup()  
{  
	size(1000,1000);  
	background(0);
	smooth();
	fill(255);  
	noLoop();
	noStroke();    
}  
	  
void draw(){
background(color(255,255,255));
color col1 = color(88,0,0);
color col2 = color(188,0,0);
color col_text =color(0, 0, 0) ;

smooth();
int radius = 200;
float barWidth = (2* PI*radius)/(data.length*1.5);
PFont myFont = loadFont("Calibri");  
int font_size = 16;
textFont(myFont, font_size);  


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
multiplier1 = 170 / largest1;
multiplier2 = 170 / largest2;

float delta = TWO_PI / (data.length-1);

for(int i = 1; i < data.length; i++) {

    float xPos = width / 2 + radius * cos(i * delta);
    float yPos = 550 + radius * sin(i * delta);

    pushMatrix();
    translate(xPos, yPos);
    rotate(delta * i);


      textAlign(LEFT, CENTER);
      fill(col1);
      rect(0, 0, float(data[i][1]) * multiplier1,  barWidth/2);
      text(data[i][1], float(data[i][1]) * multiplier1 + 5, barWidth * 0.25);
      fill(col2);
      rect(0,  barWidth / 2,float(data[i][2]) * multiplier2,  barWidth / 2);
      text(data[i][2], float(data[i][2]) * multiplier2 + 5, barWidth * 0.75);
      textAlign(RIGHT, CENTER);
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
}
				
void textblock(String textblockstring, int textblockx, int textblocky, int textblockwidth)
{
	String [] textblock = split(textblockstring, " ");
	float textblockw = 0;
	float textblockynow = textblocky;
	for(int a = 0; a < textblock.length; a++)
	{
		textblockw += textWidth(textblock[a] + " ");
		if(textblockw > textblockwidth + textblockx)
		{
			textblockynow += 15;
			textblockw = textWidth(textblock[a] + " ");
		}
		text(textblock[a]+ " ", textblockw + textblockx - textWidth(textblock[a] + " "), textblockynow);
	}
}