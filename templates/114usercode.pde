background(255, 255, 255);

fill(0,0,0);
smooth();

PFont myFont = loadFont("Oswald");  
int font_size = 34;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 200);

PFont myFont = loadFont("Buda");  
int font_size = 16;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
textblock(blurb, 100 , 220, 600);

int font_size = 23;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);

rotate(PI);
translate(-500,-950); 

float total = 0;
for (int a = 0; a < data.length; a++){
total +=  int(data[a][1]);
}

multiplier = (PI) / total *0.67 ;

for(int a =1; a < data.length; a++)
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
fill(255,255,255);
ellipse(0,0,630,630);