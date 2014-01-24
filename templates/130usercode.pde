translate(500,500);

background(color(44,44,44));


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
text(data[a][0], 335, 0);
rotate(-data[a][1] * multiplier  / 2);
arc(0, 0, 650, 650, 0, data[a][1] * multiplier);
rotate(data[a][1] * multiplier  / 2);
translate(-5, 0);
rotate(-data[a][1] * multiplier  / 2);



translate(0, 0);
rotate(data[a][1] * multiplier);
}
fill(40);
ellipse(0, 0, 620, 620);
fill(255);
translate(-500, -500);

int font_size = 18;
textFont(myFont, font_size);  
textblock(blurb, 400 , 420, 200);
textAlign(CENTER, BASELINE);
myFont = loadFont("Myriad");  
int font_size = 54;
textFont(myFont, font_size);  

text(title, 500, 400);