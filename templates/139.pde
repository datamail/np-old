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
int font_size = 20;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);

background(255);
noStroke();
smooth();
fill(0);
text(title, 100, 900);
font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 920, 800);
textAlign(CENTER, CENTER);

int rand_x = 500;
int rand_y = 500;
float multiplier;
int already_placed [][] = new int [data.length][3];
int already_placed_counter = 1;
boolean overlap = true;
float temp_rad_diff = 0;
float temp_dist = 0;

int total = 0;
for (int d = 1; d < data.length; d++) {
  total += sq(int(data[d][1]));
}
multiplier = sqrt(700 * 800) / sqrt(total * 4);

already_placed [0][0] = 500;
already_placed [0][1] = 500;
already_placed [0][2] = int(int(data[1][1]) * multiplier);

for (int a = 2; a < data.length; a++)
{
   while(overlap == true){
      for(int b = 0; b < already_placed_counter; b++)
      {
        temp_dist = dist(rand_x, rand_y, already_placed[b][0], already_placed[b][1]);
        temp_rad_diff = int(data[a][1]) * multiplier + (already_placed[b][2] * multiplier);
         if(temp_dist  > temp_rad_diff / 2)
         {
            overlap = false;
         }
         else
         {
            overlap = true;
            break;
         }
      }
      if(overlap == true){
         rand_x += int(random(10)) - int(random(10));
   rand_y += int(random(10)) - int(random(10));
      }
      else{
         already_placed[already_placed_counter][0] = rand_x;
         already_placed[already_placed_counter][1] = rand_y;
         already_placed[already_placed_counter][2] = int(data[a][1]);
         already_placed_counter += 1;
      }
   }
   overlap = true;
   rand_x = 500;
   rand_y = 500;
}

for (int c = 0; c < already_placed.length; c++)
{
  fill(0);
ellipse(already_placed[c][0], already_placed[c][1], already_placed[c][2] * multiplier * 2, already_placed[c][2] * multiplier * 2);
}
float sw;
int small_counter = 0;
for (int c = 0; c < already_placed.length; c++)
{
 if (already_placed[c][2] * multiplier < 60) {
        fill(random(255), random(255), random(255));
        textAlign(RIGHT, CENTER);
        ellipse(already_placed[c][0], already_placed[c][1], already_placed[c][2] * multiplier, already_placed[c][2] * multiplier);
        font_size = 13;
        textSize(font_size);
        text(data[c + 1][0], 970, 400 + 20 * small_counter);
fill(255);
 ellipse(already_placed[c][0], already_placed[c][1], already_placed[c][2] * multiplier - 10, already_placed[c][2] * multiplier - 10);
small_counter += 1;
    } else {
textAlign(CENTER, CENTER);
  fill(255);
ellipse(already_placed[c][0], already_placed[c][1], already_placed[c][2] * multiplier, already_placed[c][2] * multiplier);
fill(0);
font_size = 50;
textSize(font_size);
sw = textWidth(data[c+1][0]);
while(sw > (already_placed[c][2] * multiplier * 0.9))
{
font_size *= 0.95;
textSize(font_size);
sw = textWidth(data[c+1][0]);
}
text(data[c+1][0], already_placed[c][0] + 4, already_placed[c][1]);
}
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