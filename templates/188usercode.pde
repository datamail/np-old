background(33);
smooth();
strokeWeight(1);
color col_text = color(random(255), random(255), random(255));
color col_slice = color(random(255), random(255), random(255));

PFont myFont = loadFont("Arial");  
int font_size = 40;
textFont(myFont, font_size);
textAlign(CENTER, CENTER);

int total = 0;
int largest = 0;

for(int a = 1; a < data.length; a++){
 if(int(data[a][1]) > largest){
  largest = int(data[a][1]);
 }
total+= int(data[a][1]);
}

float largest_ring = largest / total;
int num_rings = ceil(largest_ring / 0.1);
float left_over = (num_rings / 10) % largest_ring;
int multiplier = (600);

int ring_size = 600 / num_rings;
/*
for(int b = num_rings; b > 0; b--){
fill(255);
ellipse(500, 500, b * ring_size, b * ring_size);
fill(30);
ellipse(500, 500, b * ring_size - 2, b * ring_size - 2);

fill(255);

//text(b + "0%", 45, 500 - b * ring_size / 2);
}
*/
fill(230);
ellipse(width / 2, height / 2, 640, 640);
fill(255);
ellipse(width / 2, height / 2, 620, 620);
fill(230);
ellipse(width / 2, height / 2, 600, 600);
float slice_size = 2 * PI / (data.length - 1);
int box_height = (800 - (data.length - 1) * 5) / (data.length - 1);
int box_height_w_space = box_height + 5;
int output_text;

for(int c = 1; c < data.length; c++){
 fill(col_slice);
noStroke();
 arc(500, 500, data[c][1] / largest * multiplier, data[c][1] / largest * multiplier, -PI/2 + (c - 1) * slice_size, -PI/2 + (c) * slice_size);
fill(255);
ellipse((cos( -PI/2 + (c - 0.5) * slice_size) *data[c][1] / largest * multiplier) * 0.45 + width / 2 , (sin( -PI/2 + (c - 0.5) * slice_size) *data[c][1] / largest * multiplier) * 0.45 + width / 2, 5, 5);
stroke(200);
line((cos( -PI/2 + (c - 0.5) * slice_size) *data[c][1] / largest * multiplier) * 0.45 + width / 2 , (sin( -PI/2 + (c - 0.5) * slice_size) *data[c][1] / largest * multiplier) * 0.45 + width / 2,(cos( -PI/2 + (c - 0.5) * slice_size) * 750) * 0.45 + width / 2 , (sin( -PI/2 + (c - 0.5) * slice_size) * 750) * 0.45 + width / 2);
font_size = 40;
textFont(myFont, font_size);
output_text = round(data[c][1] / total * 100);
//text(output_text + "%", (cos( -PI/2 + (c - 0.5) * slice_size) *data[c][1] / total * multiplier) * 0.6 + width / 2 , (sin( -PI/2 + (c - 0.5) * slice_size) *data[c][1] / total * multiplier) * 0.6 + width / 2);
//fill(random(255), random(255), random(255));
text(output_text + "%", (cos( -PI/2 + (c - 0.5) * slice_size) * 870) * 0.45 + width / 2 , (sin( -PI/2 + (c - 0.5) * slice_size) * 870) * 0.45 + width / 2);
font_size = 13;
textFont(myFont, font_size);
fill(255);
text(data[c][0], (cos( -PI/2 + (c - 0.5) * slice_size) * 870) * 0.45 + width / 2 , (sin( -PI/2 + (c - 0.5) * slice_size) * 870) * 0.45 + width / 2 + 20);

//text(data[c][0], 890, 100 + (c-1) * box_height_w_space + box_height / 2);
}

fill(255);
font_size = 20;
textFont(myFont, font_size);
textAlign(LEFT);
text(title, 20, 30);
font_size = 11;
textFont(myFont, font_size);
textblock(blurb, 25, 45, 960);