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
color back = color(255,255,255); 
color fore = color(random(255), random(255), random(255));
background(back);
fill(fore);
smooth();

PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);

int largest = 0;
for(int a = 1; a < data.length; a++)
{
if(data[a][1] > largest)
{
largest = int(data[a][1]);
}
}

int total_added = 0;
boolean fits = false;
float multiplier = 9999;
while(fits == false){
for(int a = 1; a < data.length; a++)
{
total_added += int(data[a][1]) * multiplier;
}
if(total_added < 800)
{
fits = true;
}
else
{
total_added = 0;
multiplier = multiplier * 0.99;
}
}

ellipseMode(CORNERS);
float width_counter = 100;
color temp;
int levels = 1;
for(int a =1; a < data.length; a++)
{
temp = color(random(255), random(255), random(255));
fill(temp);
ellipse(width_counter, height / 2 - int(data[a][1]) * multiplier / 2, width_counter + int(data[a][1]) * multiplier, height / 2 + int(data[a][1]) * multiplier / 2);
rotate(PI / 2);
translate(0, -height);
try{
    if (int(data[a][1]) * multiplier / 2 + int(data[a + 1][1]) * multiplier / 2 < 15 || int(data[a][2]) * multiplier / 2 + int(data[a + 1][2]) * multiplier / 2 < 15) {
//text(data[a][0] , 500 +int(data[a][1]) * multiplier / 2 + 10, 1000 - width_counter - int(data[a][1]) * multiplier / 2);
        text(data[a][0], 500 + int(data[a][1]) * multiplier + 10 +  levels *  120, 1000 - width_counter - int(data[a][1]) * multiplier / 2);
        stroke(temp);
        line(500 +  int(data[a][1])  * multiplier + 10, 1000 - width_counter - int(data[a][1]) * multiplier / 2, 500 + int(data[a][1])  * multiplier + 10 + levels * 120, 1000 - width_counter - int(data[a][1]) * multiplier / 2);
        noStroke();
        levels += 1;
    } else {
        levels = 1;
      text(data[a][0] , 500 +int(data[a][1]) * multiplier / 2 + 10, 1000 - width_counter - int(data[a][1]) * multiplier / 2);
    }
}
catch(Exception e){
text(data[a][0] , 500 +int(data[a][1]) * multiplier / 2 + 10, 1000 - width_counter - int(data[a][1]) * multiplier / 2);
//text(data[data.length - 1][0], 500 + largest * multiplier + 10, 1000 - width_counter - int(data[data.length - 1][1]) * multiplier / 2);
}

translate(0, height);
rotate(-PI / 2);
width_counter += int(data[a][1]) * multiplier;
}

fill(0,0,0);
int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 100);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 120, 200);
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