background(0);

fill(255);
smooth();
PFont myFont = loadFont("Lobster");  
int font_size = 25;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);
int font_size = 50;
 
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 200);
myFont = loadFont("Geo"); 
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 230, 300);

rotate(PI);
translate(-500,-950); 

float total = 0;
for (int a = 0; a < data.length; a++){
total +=  int(data[a][1]);
}

multiplier = (PI) / total;
int levels = 1;
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
        levels += 1;
    } else {
        levels = 1;
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