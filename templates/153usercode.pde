smooth();
background(255);
fill(0);
PFont myFont = loadFont("Lobster"); 
int font_size = 25;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);
font_size = 50;
 
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 200);


textAlign(LEFT, CENTER);

int total = 0;
int largest = 0;


for(int a = 1; a < data.length; a++) {
total += int(data[a][1]);
if(int(data[a][1]) > largest){
largest = int(data[a][1]);
}
}

float hor_multiplier = 1600 / total;
float color_multiplier = 1 / total;
float vert_multiplier = 350 / largest;
float hor_counter = 0;
float col_counter = 0;

fill(0);
rect(0, 500, 1000, 1000);
for(int b = 1; b < data.length; b++){
triangle(100 + hor_counter - int(data[b][1]) * hor_multiplier / 2, 600 +  int(data[b][1]) * hor_multiplier / 2, 100 + hor_counter + int(data[b][1]) * hor_multiplier / 2, 600 -  int(data[b][1]) * vert_multiplier  - 40, 100 + hor_counter + int(data[b][1]) * hor_multiplier * 3 / 2, 600 +  int(data[b][1]) * hor_multiplier / 2);
hor_counter +=  data[b][1] * hor_multiplier / 2;
}

myFont = loadFont("Geo"); 
font_size = 13;
textFont(myFont, font_size);  
hor_counter = 0;

for(int b = 1; b < data.length; b++){
fill(255, 255, 255, 200);
triangle(100 + hor_counter, 600, 100 + hor_counter + int(data[b][1]) * hor_multiplier / 2, 600 -  int(data[b][1]) * vert_multiplier, 100 + hor_counter + int(data[b][1]) * hor_multiplier, 600);
rotate(PI / 2);
translate(0, -height);
fill(255);
text(data[b][0], 600 + 10, 900 - hor_counter - data[b][1] * hor_multiplier / 2);
translate(0, height);
rotate(-PI / 2);
hor_counter +=  data[b][1] * hor_multiplier / 2;
col_counter +=  data[b][1] * color_multiplier;
}

textblock(blurb, 500 , 800, 400);