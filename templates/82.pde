void setup()  
				{  
					size(1000,1000);  
					background(0);
					smooth();
					fill(255);  
					noLoop();
					noStroke();    
				}  
					  
				void draw(){color back = color(44,44,44); 
color fore = color(random(255), random(255), random(255));
background(back);
fill(fore);
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

float height_counter = 0;
ellipseMode(CORNERS);
for(int a =1; a < data.length; a++)
{
height_counter = 0;
while(height_counter < data[a][1] * height_multiplier)
{
ellipse(100 + column_width_with_space * (a -1), 850 - height_counter, 100 + column_width_with_space * (a -1) + column_width, 850 - height_counter - column_width);
height_counter += column_width_with_space;
}
fill(back);
rect(100 + column_width_with_space * (a -1), 850 - data[a][1] * height_multiplier - column_width_with_space, column_width, column_width);
fill(fore);
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
textblock(blurb, 100 , 70, 700); }void textblock(String textblockstring, int textblockx, int textblocky, int textblockwidth)
				{
				String [] textblock = split(textblockstring, " ");
				float textblockw = 0;
				float textblockynow = textblocky;
				for(int a = 0; a < textblock.length; a++)
				{
				textblockw += textWidth(textblock[a] + " ");
				if(textblockw > textblockwidth + textblockx)
				{
				  textblockynow += 15;
				  textblockw = textWidth(textblock[a] + " ");
				}
				
				text(textblock[a]+ " ", textblockw + textblockx - textWidth(textblock[a] + " "), textblockynow);
				}
				}