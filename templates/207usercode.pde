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
  total += int(data[d][1]);
}
int bounding = 200 * 200;
multiplier = bounding / total;

already_placed [0][0] = 500;
already_placed [0][1] = 500;
already_placed [0][2] = int(data[1][1]);

for (int a = 2; a < data.length; a++)
{
   while(overlap == true){
      for(int b = 0; b < already_placed_counter; b++)
      {
        temp_dist = dist(rand_x, rand_y, already_placed[b][0], already_placed[b][1]);
        temp_rad_diff = Math.sqrt(int(data[a][1]) / (multiplier * Math.PI)) +  Math.sqrt(already_placed[b][2] / (multiplier * Math.PI));
//println(temp_dist );
//println(temp_rad_diff );
//println();
         if(temp_dist  > temp_rad_diff)
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
ellipse(already_placed[c][0], already_placed[c][1], Math.sqrt((already_placed[c][2]  * multiplier) / Math.PI) * 2, Math.sqrt((already_placed[c][2]  * multiplier) / Math.PI) * 2);
}
float sw;
int small_counter = 0;
for (int c = 0; c < already_placed.length; c++)
{
 
textAlign(CENTER, CENTER);
  fill(255);
ellipse(already_placed[c][0], already_placed[c][1], Math.sqrt((already_placed[c][2]  * multiplier) / Math.PI), Math.sqrt((already_placed[c][2]  * multiplier) / Math.PI));
fill(0);
font_size = 50;
textSize(font_size);
sw = textWidth(data[c+1][0]);
/*while(sw > (already_placed[c][2] * multiplier * 0.9))
{
font_size *= 0.95;
textSize(font_size);
sw = textWidth(data[c+1][0]);
}*/
//text(data[c+1][0], already_placed[c][0] + 4, already_placed[c][1]);
}