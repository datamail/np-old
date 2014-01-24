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
int red = 0;
int green = 0;
int blue = 0;

PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);

background(0);
noStroke();
smooth();
fill(255);
text(title, 100, 50);
font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 70, 800);

//translate(500, 525);

int data_vals [] = new int [data.length - 1];
for(int a = 1; a < data.length; a++) {
 data_vals [a-1] = int(data[a][1]);
}

data_vals = sort(data_vals);
ellipseMode(CORNERS);

float multiplier = 750 / data_vals[data_vals.length - 1];
float color_multiplier = 1 / data_vals[data_vals.length - 1];
float ratio = 1;

for(int b = data_vals.length-1; b > -1; b--) {
ratio = (b + 1) / data_vals.length;
if(ratio >= 0 && ratio <= 0.16){
   red = 1;
   green =  (6) * ratio;
   blue = 0.2;
}
if(ratio >= 0.17 && ratio <= 0.33){
   red = -(6) * ratio + 1;
   green = (6) * ratio;
   blue = 0.2;
}
if(ratio >= 0.34 && ratio <= 0.5){
 green = 1; 
 blue = (3) * (ratio - 1 / 3);
 red = 0.2;
}
if(ratio >= 0.5 && ratio <= 0.66){
 green = -(3) * (ratio - 1 / 3) + 1; 
 blue = 1 - green;
 red = 0.2;
}
if(ratio >= 0.67 && ratio <= 0.83){
 green = 0.2; 
 blue = 1;
 red = (3) * (ratio - 2 / 3);
}
if(ratio >= 0.83 && ratio <= 1){
 green = 0.2; 
 blue = -(3) * (ratio - 2 / 3) + 1;
 red = 1 - blue;
}
fill(red * 255, green * 255, blue * 255);
ellipse(100, 950, 100 + data_vals[b] * multiplier, 950 - data_vals[b] * multiplier);
fill(0);
text(data[b+1][0], 100 + 3 + cos(radians(45)) * data_vals[b] * multiplier / 2 +  data_vals[b] * multiplier / 2, 950 - cos(radians(45)) * data_vals[b] * multiplier / 2 + 3 -  data_vals[b] * multiplier / 2);
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