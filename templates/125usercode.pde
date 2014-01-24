smooth();
background(255);
fill(40);
strokeWeight(3);
PFont myFont = loadFont("Lobster"); 
int font_size = 25;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);
font_size = 30;
 
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 30, 930);
myFont = loadFont("Geo"); 
font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 30 , 950, 940);

textAlign(LEFT, CENTER);

int total = 0;
int largest = 0;


for(int a = 1; a < data.length; a++) {
total += int(data[a][1]);
if(data[a][1] > largest){
largest = data[a][1];
}
}

float col_width = 800 / (data.length - 1);
float vert_multiplier = 700 / largest;
float ball_multiplier = col_width / largest;
float hor_counter = 0;
color temp;

for(int b = 1; b < data.length; b++){
temp = color(random(255),random(255),random(255));
fill(temp);
stroke(temp);
line(100 + hor_counter + col_width / 2, 0, 100 + hor_counter + col_width  / 2, data[b][1] * vert_multiplier);
ellipse(100 + hor_counter + col_width  / 2, data[b][1] * vert_multiplier, data[b][1] * ball_multiplier, data[b][1] * ball_multiplier);
rect(100 + hor_counter, 750, col_width, 5);
rotate(PI / 2);
translate(0, -height);
text(data[b][0], 760 + 10, 900 - hor_counter - col_width / 2);
translate(0, height);
rotate(-PI / 2);
hor_counter +=  col_width ;
}