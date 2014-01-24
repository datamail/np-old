translate(500,550);

background(color(44,44,44));
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

for(int a =0; a < data.length; a++)
{
fill(color(random(255), random(255), random(255)));
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

translate(-500, -550);

fill(255, 255, 255);
int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 50);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 70, 700);