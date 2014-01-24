color colors [] = {color(255, 255, 0), color(155, 220, 0), color(0, 167, 13), color(0, 114, 109), color(0, 83, 184), color(69, 0, 184), color(112, 0, 184), color(158, 0, 213), color(194, 0, 143), color(223, 0, 17), color(223, 85, 17), color(255, 158, 17)};

translate(500,550);

background(0);
fill(color(random(255), random(255), random(255)));

smooth();
PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);

int largest = 0;
float total = 0;
for (int a = 0; a < data.length; a++){

total +=  int(data[a][1]);

}

multiplier = (2 * PI) / total;

int color_counter = 0;
for(int a =1; a < data.length; a++)
{
if(color_counter == 12)
{
color_counter = 0;
}
rotate(data[a][1] * multiplier  / 2);
translate(5, 0);
fill(255, 255, 255);
if ( data[a][1] * multiplier * 180 / PI < 4) {

       text(data[a][0], 260 +100, 0);
        stroke(255);
        line(260, 0, 260 + 100, 0);
        noStroke();
       
    } else {
        
       text(data[a][0], 260, 0);
    }
fill(colors[color_counter]);
color_counter++;
rotate(-data[a][1] * multiplier  / 2);
arc(0, 0, 500, 500, 0, data[a][1] * multiplier);
rotate(data[a][1] * multiplier  / 2);
translate(-5, 0);
rotate(-data[a][1] * multiplier  / 2);



translate(0, 0);
rotate(data[a][1] * multiplier);
}

translate(-500, -550);

fill(255, 255, 255);
int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 50);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 70, 700);