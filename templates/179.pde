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
background(0);
color from = color(random(255), random(255), random(255), 180);
color to = color(random(255), random(255), random(255), 180);
strokeWeight(20);
smooth();

PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);

float column_width = 780 / (data.length - 1);

float largest = 0;
float largest_x = 0;
float largest_y = 0;
long smallest = 99999999999;
for (int a = 1; a < data.length; a++){
if(largest < data[a][1]){
largest =  int(data[a][1]);
}
if(largest < data[a][2]){
largest =  int(data[a][2]);
}
if(largest_x < data[a][1]){
largest_x =  int(data[a][1]);
}
if(largest_y < data[a][2]){
largest_y =  int(data[a][2]);
}
if(smallest > data[a][1]){
smallest =  int(data[a][1]);
}
}

float multiplier = 750 / largest;

int prev_x = 100 + data[1][1] * multiplier;
int prev_y = 870 - data[1][2] * multiplier;

for(int a =2; a < data.length; a++)
{
stroke(lerpColor(from, to, (a - 1) / data.length));
line(prev_x, prev_y, data[a][1] * multiplier + 100, 870 - data[a][2] * multiplier);
prev_x = 100 + data[a][1] * multiplier;
prev_y = 870 - data[a][2] * multiplier;
}

strokeWeight(1);
stroke(255);
line (100, 870, 900, 870);
line (100, 870, 100, 150);
rotate(PI/2);
translate(0, -height);
text(data[0][2], width / 2, 950);
text(largest_x, 880, 900 - largest_x * multiplier);
translate(0, height);
rotate(-PI/2);
textAlign(RIGHT, CENTER);
text(data[0][1], width / 2, 950);
text("0", 90, 880);
text(largest_y, 90, 870 - largest_y * multiplier);

noStroke();
fill(from);
rect(0, 950, 100, 30);
fill(to);
rect(900, 950, 100, 30);

fill(0);
text(data[1][0], 90, 965);
textAlign(LEFT, CENTER);
text(data[data.length - 1][0], 910, 965);

fill(255);
  
textAlign(LEFT, BASELINE);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 70, 800);

myFont = loadFont("Orbitron");  
int font_size = 20;
textFont(myFont, font_size);
text(title, 100, 55);
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