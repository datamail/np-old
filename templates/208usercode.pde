smooth();
background(255);
fill(40);
strokeWeight(3);
PFont myFont = loadFont("Lobster"); 
font_size = 40;
textFont(myFont, font_size);  
textAlign(RIGHT, BASELINE);
//text(title, 940, 100);
textAlign(LEFT, BASELINE);
myFont = loadFont("Geo"); 
font_size = 13;
textFont(myFont, font_size);  
//textblock(blurb, 80, 720, 150);
rotate(-PI/4);
translate(-400, 333);

textAlign(LEFT, CENTER);

int total = 0;
int largest = 0;


for(int a = 1; a < data.length; a++) {
total += int(data[a][1]);
if(data[a][1] > largest){
largest = int(data[a][1]);
}
}

float col_width = 600 / (data.length - 1);
float vert_multiplier = 600 / largest;
float ball_multiplier = col_width / largest;
float hor_counter = 0;
color temp;

fill(0);
for(int b = 1; b < data.length; b++){
ellipse(100 + hor_counter + col_width  / 2, data[b][1] * vert_multiplier, data[b][1] * ball_multiplier * 3, data[b][1] * ball_multiplier * 3);
hor_counter +=  col_width ;
}

hor_counter = 0;
for(int b = 1; b < data.length; b++){
temp = color(random(255),random(255),random(255));
fill(temp);
stroke(temp);
line(100 + hor_counter + col_width / 2, -500, 100 + hor_counter + col_width  / 2, data[b][1] * vert_multiplier);
ellipse(100 + hor_counter + col_width  / 2, data[b][1] * vert_multiplier, data[b][1] * ball_multiplier, data[b][1] * ball_multiplier);
//rect(100 + hor_counter, 650, col_width, 5);
rotate(PI / 2);
translate(0, -height);
//text(data[b][0], data[b][1] * vert_multiplier + data[b][1] * ball_multiplier + 20, 900 - hor_counter - col_width / 2);
translate(0, height);
rotate(-PI / 2);
hor_counter +=  col_width ;
}