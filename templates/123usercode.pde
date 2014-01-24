smooth();
background(255);
fill(40);
PFont myFont = loadFont("Lobster"); 
int font_size = 25;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);
font_size = 50;
 
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 200);
myFont = loadFont("Geo"); 
font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 500 , 800, 400);

textAlign(LEFT, CENTER);

int total = 0;
int largest = 0;


for(int a = 1; a < data.length; a++) {
total += int(data[a][1]);
if(int(data[a][1]) > largest){
largest = int(data[a][1]);
}
}

float hor_multiplier = 800 / total;
float vert_multiplier = 200 / largest;
float hor_counter = 0;

for(int b = 1; b < data.length; b++){
fill(random(255),random(255),random(255));
triangle(100 + hor_counter, 600, 100 + hor_counter + int(data[b][1]) * hor_multiplier / 2, 600 -  int(data[b][1]) * vert_multiplier, 100 + hor_counter + int(data[b][1]) * hor_multiplier, 600);
rotate(PI / 2);
translate(0, -height);
text(data[b][0], 600 + 10, 900 - hor_counter - data[b][1] * hor_multiplier / 2);
translate(0, height);
rotate(-PI / 2);
hor_counter +=  data[b][1] * hor_multiplier;
}