void setup()  
{  
	size(1000,1000);  
	background(0);
	smooth();
	fill(255);  
	noLoop();
	noStroke();
	PFont fontA = loadFont("courier");  
	textFont(fontA, 14);     
}  
	  
void draw(){
background(255, 255, 255);
stroke(0, 0, 0);
smooth();

PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);

float column_width = 780 / (data.length - 1);

float largest = 0;
long smallest = 99999999999;
for(int h = 2; h < data[0].length; h++)
{
for (int a = 1; a < data.length; a++){
if(largest < data[a][h]){
largest =  data[a][h];
}
if(smallest > data[a][h]){
smallest =  data[a][h];
}
}
}

float multiplier = 700 / largest;

int previous_x;
int previous_y;
for(int b = 2; b < data[0].length; b++)
{
noStroke();
fill(random(255),  random(255), random(255), 200);
previous_x = 120 - column_width;
beginShape();
for(int a =1; a < data.length; a++)
{
previous_y = data[a][b] * multiplier;
vertex(previous_x + column_width, 850 - data[a][b] * multiplier);
rotate(PI/2);
translate(0, -height);
text(data[a][0], 880, 1000 - (previous_x + column_width));
translate(0, height);
rotate(-PI/2);
previous_x = previous_x + column_width;
}
endShape();
}

fill(0, 0, 0);
stroke(0, 0, 0);
line (100, 870, 900, 870);
line (100, 870, 100, 150);
rotate(PI/2);
translate(0, -height);
translate(0, height);
rotate(-PI/2);
textAlign(RIGHT, CENTER);
text(smallest, 90, 850 - smallest * multiplier);
text(largest, 90, 150);

int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 50);
int font_size = 13;
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
		if(textblockw > textblockwidth)
		{
			textblockynow += 15;
			textblockw = textWidth(textblock[a] + " ");
		}	
		text(textblock[a]+ " ", textblockw + textblockx - textWidth(textblock[a] + " "), textblockynow);
	}
} 