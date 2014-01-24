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
background(255);
color back = color(255);
color fore = color(random(255), random(255), random(255));
smooth();
font_size = 10;
PFont myFont = loadFont("Arial");  
textFont(myFont, font_size);
textAlign(LEFT);
text(title, 20, 30);
font_size = 20;
textFont(myFont, font_size);
textblock(blurb, 25, 45, 960);
textAlign(RIGHT, CENTER);

translate(500, 500);

int total = 0;
int largest = 0;

for(int a = 1; a < data.length; a++){
 if(int(data[a][1]) > largest){
  largest = int(data[a][1]);
 }
total+= int(data[a][1]);
}
//println(total);
float multiplier = 1;

for(int c = 1; c < data.length; c++){
fill(fore);
arc(0, 0, 800 - 30 * (c - 1) - 2, 800 - 30 * (c - 1) - 2, -PI / 2, 2 * PI * data[c][1] / total);

fill(back);
ellipse(0, 0, 800 - 30 * c, 800 - 30 * (c));
fill(fore);
text(data[c][0], 0,  -400 + 15 * (c - 1) + 8);
translate(-width/2, 0);
rotate( -2 * PI * data[c][1] / total  + PI / 2);

rotate( 2 * PI * data[c][1] / total -  PI / 2);
translate(width/2, 0);
}
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