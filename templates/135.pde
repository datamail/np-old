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
translate(500,500);

background(0);


smooth();
PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);

float total = 0;
for (int a = 0; a < data.length; a++){

total +=  int(data[a][1]);

}
int levels = 1;
multiplier = (2 * PI) / total;
int red = 0;
int green = 0;
int blue = 0;
col_counter = 0;

for(int a =1; a < data.length; a++)
{
col_counter += (data[a][1] * multiplier) / (2 * PI);
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

rotate(data[a][1] * multiplier  / 2);
translate(5, 0);
fill(255);
 if ( data[a][1] * multiplier * 180 / PI < 4) {

       text(data[a][0], 310 +100, 0);
        stroke(255);
        line(310, 0, 310 + 100, 0);
        noStroke();
        levels += 1;
    } else {
        levels = 1;
       text(data[a][0], 310, 0);
    }
rotate(-data[a][1] * multiplier  / 2);
fill(red * 255, green * 255, blue * 255);
arc(0, 0, 600, 600, 0, data[a][1] * multiplier);
rotate(data[a][1] * multiplier  / 2);
translate(-5, 0);
rotate(-data[a][1] * multiplier  / 2);



translate(0, 0);
rotate(data[a][1] * multiplier);
}
fill(0);
ellipse(0, 0, 500, 500);
fill(255);
translate(-500, -500);

int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 400 , 420, 200);
textAlign(CENTER, BASELINE);
myFont = loadFont("Lobster");  
int font_size = 24;
textFont(myFont, font_size);  

text(title, 500, 400);
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