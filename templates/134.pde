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
fill(255);
smooth();

PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);

int largest = 0;
for (int a = 1; a < data.length; a++){
if(int(data[a][1]) > largest){
largest = int(data[a][1]);
}
}
height_multiplier = 700 / largest;

int space_available;
if(data.length < 10)
{
space_available = 720;
}
else {
space_available = 800;
}
float column_width = (space_available - (data.length - 1) * 5) / (data.length - 1);
float column_width_with_space = column_width + 5;

int red = 0;
int green = 0;
int blue = 0;
float height_counter = 0;
ellipseMode(CORNERS);
for(int a =1; a < data.length; a++)
{
height_counter = 0;
while(height_counter < data[a][1] * height_multiplier)
{
col_counter = height_counter / (largest * height_multiplier);
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
ellipse(100 + column_width_with_space * (a -1), 850 - height_counter, 100 + column_width_with_space * (a -1) + column_width, 850 - height_counter - column_width);
height_counter += column_width_with_space;
}
fill(255);
rotate(PI/2);
translate(0, -height);
text(data[a][0] , 860, 900 - (column_width_with_space / 2 + column_width_with_space * (a - 1)));
translate(0, height);
rotate(-PI/2);
}

int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 50);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 70, 800);
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