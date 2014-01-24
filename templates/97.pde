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

fill(255,255,255);
smooth();
PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);
int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 200);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 220, 200);

rotate(PI);
translate(-500,-950); 

float total = 0;
for (int a = 0; a < data.length; a++){
total +=  int(data[a][1]);
}

multiplier = (PI) / total;

for(int a =1; a < data.length; a++)
{
fill(color(random(255), random(255), random(255)));
rotate(data[a][1] * multiplier  / 2);
translate(5, 0);
if ( data[a][1] * multiplier * 180 / PI < 4) {

       text(data[a][0], 335 +100, 0);
        stroke(255);
        line(335, 0, 335 + 100, 0);
        noStroke();
        
    } else {
        
       text(data[a][0], 335, 0);
    }
rotate(-data[a][1] * multiplier  / 2);
arc(0, 0, 650, 650, 0, data[a][1] * multiplier);
rotate(data[a][1] * multiplier  / 2);
translate(-5, 0);
rotate(-data[a][1] * multiplier  / 2);
translate(0, 0);
rotate(data[a][1] * multiplier);
}
fill(0);
ellipse(0,0,620,620);
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