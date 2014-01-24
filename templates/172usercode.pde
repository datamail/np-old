background(255);
color back = color(255);
color fore = (0);
smooth();
font_size = 20;
PFont myFont = loadFont("Oswald");  
textFont(myFont, font_size);
textAlign(LEFT);
text(title, 20, 30);
font_size = 10;
textFont(myFont, font_size);
textblock(blurb, 25, 45, 960);
textAlign(RIGHT, CENTER);

translate(500, 500);

int total = 0;
int largest = 0;

for(int a = 1; a < data.length; a++){
 if(int(data[a][1]) > largest){
  largest = int(data[a][1]);
 }
total+= int(data[a][1]);
}
//println(total);
float multiplier = 1;

for(int c = 1; c < data.length; c++){
fill(fore);
arc(0, 0, 800 - 20 * (c - 1) - 2, 800 - 20 * (c - 1) - 2, -PI / 2, 2 * PI * data[c][1] / total  -PI / 2);

fill(back);
ellipse(0, 0, 800 - 20 * c, 800 - 20 * (c));
fill(fore);
text(data[c][0], 0,  -400 + 10 * (c - 1) + 5);
translate(-width/2, 0);
rotate( -2 * PI * data[c][1] / total  + PI / 2);

rotate( 2 * PI * data[c][1] / total -  PI / 2);
translate(width/2, 0);
}