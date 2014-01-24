translate(500,550);

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

for(int a =1; a < data.length; a++)
{
fill( color(random(255), random(255), random(255)));
rotate(data[a][1] * multiplier  / 2);
translate(5, 0);
if ( data[a][1] * multiplier * 180 / PI < 4) {

       text(data[a][0], 260 +100, 0);
        stroke(255);
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
ellipse(0, 0, 450, 450);
fill(255);
translate(-500, -550);
textAlign(LEFT, BASELINE);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 70, 800);

myFont = loadFont("Lobster");  
int font_size = 24;
textFont(myFont, font_size);  

text(title, 100, 50);