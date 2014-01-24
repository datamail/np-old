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
background(255);

fill(0);
smooth();
PFont myFont = loadFont("Oswald");  
int font_size = 30;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 900);
int font_size = 15;
textFont(myFont, font_size);  
textblock(blurb, 100 , 920, 800);
textAlign(LEFT, TOP);

float [] total = new float[data[0].length - 1];
float [] hor_multiplier = new float[data[0].length - 1];

for (int b = 1; b < data[0].length; b++)
{
for (int a = 1; a < data.length; a++){
total[b-1] +=  int(data[a][b]);
}
}

color [] colors = { color(227, 16, 30), color(250, 150, 20), color(247, 244, 27)};

for(int c = 0; c < total.length; c++)
{
hor_multiplier[c] = 800 / total[c];
}

ver_multiplier = 600 / ((data[0].length - 1) * 2);

int hor_counter = 0;

for(int c =1; c < data[1].length; c++)
{
       fill(0);
       text(data[0][c], 100, 200 + ver_multiplier * (c-1) * 2 + ver_multiplier + 8);
       for(int d = 1; d < data.length; d++)
       {   

       fill(colors[d - 1]);

       rect(100 + hor_counter, 200 + ver_multiplier * (c-1) * 2, int(data[d][c]) * hor_multiplier[c -1], ver_multiplier);
       hor_counter +=  int(data[d][c]) * hor_multiplier[c -1];
       }
       hor_counter = 0;
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