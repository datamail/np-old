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
smooth();
background(255);
fill(40);
strokeWeight(3);
PFont myFont = loadFont("Lobster"); 
int font_size = 25;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);
font_size = 30;
 
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 30, 930);
myFont = loadFont("Geo"); 
font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 30 , 950, 940);

textAlign(LEFT, CENTER);

int total = 0;
int largest = 0;

for(int a = 1; a < data.length; a++) {
total += int(data[a][1]);
if(data[a][1] > largest){
largest = data[a][1];
}
}

float col_width = 800 / (data.length - 1);
if (col_width > 50){
col_width =50;
}
float vert_multiplier = 700 / (sq(largest));
float ball_multiplier = col_width / largest;

float hor_counter = 0;
color c [] = {color(255,210,0),color(31,170,255),color(255,118,63),color(0,0,0) );
col_num = 0;
for(int b = 1; b < data.length; b++){
for(int m = 1; m < data[b].length; m++){
if(col_num > 3){
col_num = 0;
}
temp = c[col_num];
col_num += 1;
fill(temp);
stroke(temp);
line(100 + hor_counter + col_width / 2, 0, 100 + hor_counter + col_width  / 2, sq(data[b][m]) * vert_multiplier);
ellipse(100 + hor_counter + col_width  / 2, sq(data[b][m]) * vert_multiplier, data[b][m] * ball_multiplier, data[b][m] * ball_multiplier);
rect(100 + hor_counter, 750, col_width, 5);
rotate(PI / 2);
translate(0, -height);
text(data[b][0], 760 + 10, 900 - hor_counter - col_width / 2);
translate(0, height);
rotate(-PI / 2);
hor_counter +=  col_width ;
}
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