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
float col_multiplier = 1 / data_vals[data_vals.length - 1];
int red = 0;
int green = 0;
int blue = 0;
float col_counter = 0;

for(int b = data_vals.length-1; b > -1; b--) {
if(col_counter >= 0 && col_counter <= 0.16){
   red = 1;
   green =  (6) * col_counter;
   blue = 0.2;
}
if(col_counter >= 0.17 && col_counter <= 0.33){
   red = -(6) * col_counter + 1;
   green = (6) * col_counter;
   blue = 0.2;
}
if(col_counter >= 0.34 && col_counter <= 0.5){
 green = 1; 
 blue = (3) * (col_counter - 1 / 3);
 red = 0.2;
}
if(col_counter >= 0.5 && col_counter <= 0.66){
 green = -(3) * (col_counter - 1 / 3) + 1; 
 blue = 1 - green;
 red = 0.2;
}
if(col_counter >= 0.67 && col_counter <= 0.83){
 green = 0.2; 
 blue = 1;
 red = (3) * (col_counter - 2 / 3);
}
if(col_counter >= 0.83 && col_counter <= 1){
 green = 0.2; 
 blue = -(3) * (col_counter - 2 / 3) + 1;
 red = 1 - blue;
}
fill(red * 255, green * 255, blue * 255);
ellipse(0, 0, data_vals[b] * multiplier, data_vals[b] * multiplier);
fill(0);
text(data[b+1][0],  3 + cos(radians(45)) * data_vals[b] * multiplier / 2,  - cos(radians(45)) * data_vals[b] * multiplier / 2 + 3);
col_counter = col_multiplier * data_vals[b];
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