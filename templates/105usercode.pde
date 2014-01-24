background(0);

fill(255,255,255);
smooth();
PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);
int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 900);
int font_size = 13;
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

color [] colors = new color [data.length - 1];
for (int f = 0; f < data.length - 1; f++) {
    colors[f] = color(random(255), random(255), random(255));
}

for(int c = 0; c < total.length; c++)
{
hor_multiplier[c] = 600 / total[c];
}

ver_multiplier = 600 / ((data[0].length - 1) * 2);

int hor_counter = 0;

for(int c =1; c < data[1].length; c++)
{
       fill(255);
       text(data[0][c], 200, 200 + ver_multiplier * (c-1) * 2 + ver_multiplier);
       for(int d = 1; d < data.length; d++)
       {   
       fill(colors[d-1]);
       rect(200 + hor_counter, 200 + ver_multiplier * (c-1) * 2, int(data[d][c]) * hor_multiplier[c -1], ver_multiplier);
       hor_counter +=  int(data[d][c]) * hor_multiplier[c -1];
       }
       hor_counter = 0;
}

textAlign(LEFT, CENTER);
int key_hor_multiplier = 1000 / (data.length - 1); 
for (int k = 0; k < data.length - 1; k++) {
   fill(colors[k]);
   rect(key_hor_multiplier * k, 0, key_hor_multiplier, 10);
   rotate(PI / 2);
   translate(0 , -height);
   text(data[k + 1][0], 15, 1000 - key_hor_multiplier * (k + 0.5));
   translate(0 , height);
   rotate(-PI / 2);
}