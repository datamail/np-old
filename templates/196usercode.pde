smooth();
background(0);
fill(255);
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
rotate(-PI/2);
translate(-width, 0);

textAlign(LEFT, CENTER);

int total = 0;
int total2 = 0;
int largest = 0;
int largest2 = 0;

color col [] = {color(200, 2, 10),
color(0, 153, 255),
color(110, 224, 23),
color(255, 122, 6),
color(255, 0, 106)};

for(int a = 1; a < data.length; a++) {
total += int(data[a][1]);
total2 += int(data[a][2]);
if(data[a][1] > largest){
largest = int(data[a][1]);
}
if(data[a][2] > largest2){
largest2 = int(data[a][2]);
}
}

float col_width = 800 / (data.length - 1);
float vert_multiplier = 800 / largest;
float ball_multiplier = (col_width * 2) / 100;
float hor_counter = 0;
color temp;
int col_count = 0;

fill(255);
for(int b = 1; b < data.length; b++){
fill(255);
ellipse(100 + hor_counter + col_width  / 2, 100 + data[b][1] * vert_multiplier, col_width * 2, col_width * 2);
fill(0);
ellipse(100 + hor_counter + col_width  / 2, 100 + data[b][1] * vert_multiplier, col_width * 2 - 2, col_width * 2 - 2);
fill(255);
//temp_diam = ((col_width * 3 - 2) / 100) * data[b][2];
ellipse(100 + hor_counter + col_width  / 2, 100 + data[b][1] * vert_multiplier,data[b][2] * ball_multiplier, data[b][2] * ball_multiplier );
hor_counter +=  col_width ;
}

hor_counter = 0;
for(int b = 1; b < data.length; b++){
if(col_count == 5){
   col_count = 0; 
  }
temp = col[col_count];//color(random(255), random(255), random(255));
fill(temp);
col_count++;
stroke(temp);
line(100 + hor_counter + col_width / 2, 100, 100 + hor_counter + col_width  / 2,  100 + data[b][1] * vert_multiplier);
//ellipse(100 + hor_counter + col_width  / 2,  100 +data[b][1] * vert_multiplier, data[b][1] * ball_multiplier, data[b][1] * ball_multiplier);
//rect(100 + hor_counter, 650, col_width, 5);
rotate(PI / 2);
translate(0, -height);
//text(data[b][0],  100 +data[b][1] * vert_multiplier + col_width * 2, 900 - hor_counter - col_width / 2);
translate(0, height);
rotate(-PI / 2);
hor_counter +=  col_width ;
}