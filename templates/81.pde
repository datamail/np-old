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
background(0);
stroke(255,255,255);
line(100, 900, 900, 900);
line(100, 900, 100, 150);
noStroke();

color fill_color = color(random(255), random(255), random(255));
color text_color = color(255,255,255);

smooth();
PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);

float x_largest = 0;
float y_largest = 0;
float diam_largest = 0;

for (int a = 0; a < data.length; a++){
if(data[a][1] > x_largest)
{
x_largest = data[a][1];
}
if(data[a][2] > y_largest)
{
y_largest = data[a][2];
}
if(data[a][3] > diam_largest)
{
diam_largest = data[a][3];
}
}

x_multiplier = 800 / x_largest;
y_multiplier = 750 / y_largest;
diam_multiplier = 120 / diam_largest;

for(int a =0; a < data.length; a++)
{
fill(fill_color, 200);
ellipse(100 + (data[a][1] * x_multiplier) , 900 - (data[a][2] * y_multiplier), data[a][3] * diam_multiplier, data[a][3] * diam_multiplier);
fill(text_color);
ellipse(100 + (data[a][1] * x_multiplier) , 900 - (data[a][2] * y_multiplier), 2, 2);
text(data[a][0], 100 + (data[a][1] * x_multiplier) + 4,  900 - (data[a][2] * y_multiplier));

}
fill(text_color);
int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 50);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 70, 700);
textAlign(CENTER, BASELINE);
text(data[0][1], width/2, 950);
rotate(PI/2);
translate(0, -height);
text(data[0][2], width/2, 950);
}
				
void textblock(String textblockstring, int textblockx, int textblocky, int textblockwidth)
{
	String [] textblock = split(textblockstring, " ");
	float textblockw = 0;
	float textblockynow = textblocky;
	for(int a = 0; a < textblock.length; a++)
	{
		textblockw += textWidth(textblock[a] + " ");
		if(textblockw > textblockwidth)
		{
			textblockynow += 15;
			textblockw = textWidth(textblock[a] + " ");
		}
		text(textblock[a]+ " ", textblockw + textblockx - textWidth(textblock[a] + " "), textblockynow);
	}
}