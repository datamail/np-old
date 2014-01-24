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
color color1 = color(random(255), random(255), random(255));
color color2 = color(random(255), random(255), random(255));

noStroke();
smooth();

PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);

int largest = 0;

for(int a = 1; a < data.length; a++){
 if(int(data[a][1]) > largest){
  largest = int(data[a][1]);
 }
if(int(data[a][2]) > largest){
  largest = int(data[a][2]);
 }
}

float multiplier = 270 / largest;
column_w = (800 - data.length * 5) / (data.length - 1);
column_w_with_space = column_w + 5;

for(int b = 1; b < data.length; b++){
fill(color1);
rect(400 - int(data[b][1]) * multiplier - 30,  100 + column_w_with_space * (b - 1), int(data[b][1]) * multiplier + 30, column_w);
textAlign(CENTER, CENTER);
fill(0);
text(data[b][0], 500, 100 + column_w_with_space * (b - 1) + column_w / 2);
textAlign(LEFT, CENTER);
fill(255);
//text(data[b][1], 400 - int(data[b][1]) * multiplier - 25, 200 + column_w_with_space * (b - 1) + column_w / 2);
fill(color2);
rect(600,  100 + column_w_with_space * (b - 1), int(data[b][2]) * multiplier + 30, column_w);
textAlign(RIGHT, CENTER);
fill(255);
//text(data[b][2], 600 + int(data[b][2]) * multiplier + 25,  200 + column_w_with_space * (b - 1) + column_w / 2);
}
fill(0);
textAlign(CENTER, CENTER);
text(data[0][1], 300, 930);
text(data[0][2], 700, 930);

textAlign(LEFT, TOP);
//textblock(blurb, 100 , 100, 800);

PFont myFont = loadFont("Lobster"); 
font_size = 50;
textFont(myFont, font_size);
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