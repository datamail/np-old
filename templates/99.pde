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

smooth();
PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);

int total = 0;
for (int a = 1; a < data.length; a++){
total +=  int(data[a][1]);
}

float multiplier = 800 / total;
float vert_multiplier = 650 / data.length;

int hor_counter = 0;
for(int c =1; c < data.length; c++)
{
       color it = color(random(255), random(255), random(255));
       fill(it);
       stroke(it);
       rect(100 + hor_counter, 250, int(data[c][1]) * multiplier, 50);
       line(100 + hor_counter, 300, 100 + hor_counter, 300 + vert_multiplier * c);
       textAlign(RIGHT);
       text(data[c][1], 90 + hor_counter, 300 + vert_multiplier * c);
       textAlign(LEFT);
       text(data[c][0], 110 + hor_counter, 300 + vert_multiplier * c);
       hor_counter += int( data[c][1]) * multiplier;
 }

fill(255,255,255);
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);
int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 700);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 720, 250);
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