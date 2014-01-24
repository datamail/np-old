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
smooth();
background(255);
fill(40);
PFont myFont = loadFont("Lobster"); 
int font_size = 25;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);
font_size = 50;
 
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 170);
myFont = loadFont("Geo"); 
font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 200, 800);

text(data[0][1], 100, 350);
textAlign(RIGHT, BASELINE);
text(data[0][2], 900, 350);
stroke(0);
line(910, 350, 950, 350);
line(950, 350, 950, 450);
line(950, 450, 910, 450);

line(90, 350, 50, 350);
line(50, 350, 50, 750);
line(50, 750, 90, 750);


noStroke();
textAlign(LEFT, CENTER);

int largest1 = 0;
int largest2 = 0;


for(int a = 1; a < data.length; a++) {
if(data[a][1] > largest1){
largest1 = data[a][1];
}
if(data[a][2] > largest2){
largest2 = data[a][2];
}
}

float col_width = 800 / (data.length - 1);
float vert_multiplier1 = 200 / largest1;
float vert_multiplier2 = 200 / largest2;
float hor_counter = 0;

for(int b = 1; b < data.length; b++){
fill(random(255),random(255),random(255));
triangle(100 + hor_counter, 800, 100 + hor_counter + col_width / 2, 800 -  int(data[b][1]) * vert_multiplier1, 100 + hor_counter + col_width, 800);

triangle(100 + hor_counter, 400, 100 + hor_counter + col_width / 2, 400 +  int(data[b][2]) * vert_multiplier2, 100 + hor_counter + col_width, 400);

rotate(PI / 2);
translate(0, -height);
text(data[b][0], 800 + 10, 900 - hor_counter - col_width / 2);
translate(0, height);
rotate(-PI / 2);
hor_counter +=  col_width;
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