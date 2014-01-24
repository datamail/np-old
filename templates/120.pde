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
PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);

background(255);
noStroke();
smooth();
fill(0);
text(title, 100, 50);
font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 70, 800);

translate(500, 525);

int data_vals [] = new int [data.length - 1];
for(int a = 1; a < data.length; a++) {
 data_vals [a-1] = int(data[a][1]);
}

data_vals = sort(data_vals);
ellipseMode(CENTER);

float multiplier = 750 / data_vals[data_vals.length - 1];

for(int b = data_vals.length-1; b > -1; b--) {
fill(random(255), random(255), random(255));
ellipse(0, 0, data_vals[b] * multiplier, data_vals[b] * multiplier);
fill(0);
text(data[b+1][0],  3 + cos(radians(45)) * data_vals[b] * multiplier / 2,  - cos(radians(45)) * data_vals[b] * multiplier / 2 + 3);
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