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

multiplier = (2 * PI) / total;

color temp;

color col [] = {color(200, 2, 10),
color(0, 153, 255),
color(110, 224, 23),
color(255, 122, 6),
color(255, 0, 106)};
int col_count = 0;
for(int a =1; a < data.length; a++)
{
  if(col_count == 5){
   col_count = 0; 
  }
temp = col[col_count];//color(random(255), random(255), random(255));
fill(temp);
col_count++;
rotate(data[a][1] * multiplier  / 2);
translate(5, 0);
if ( data[a][1] * multiplier * 180 / PI < 4) {

       text(data[a][0], 260 +100, 0);
        stroke(temp);
        line(260, 0, 260 + 100, 0);
        noStroke();
       
    } else {
        
       text(data[a][0], 260, 0);
    }
rotate(-data[a][1] * multiplier  / 2);
arc(0, 0, 500, 500, 0, data[a][1] * multiplier);
rotate(data[a][1] * multiplier  / 2);
translate(-5, 0);
rotate(-data[a][1] * multiplier  / 2);



translate(0, 0);
rotate(data[a][1] * multiplier);
}
fill(0);
ellipse(0, 0, 470, 470);
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