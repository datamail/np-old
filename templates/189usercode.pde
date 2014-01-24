background(33);
smooth();

PFont myFont = loadFont("Oswald");  
int font_size = 20;
textFont(myFont, font_size);
textAlign(RIGHT, CENTER);

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
int multiplier = (800 / (num_rings / 10)  );

int ring_size = 800 / num_rings;

for(int b = num_rings; b > 0; b--){
fill(255);
ellipse(50, 500, b * ring_size, b * ring_size);
fill(33);
ellipse(50, 500, b * ring_size - 3, b * ring_size - 3);
rect(0, 500 - b * ring_size / 2, 50,  b * ring_size / 2);
fill(255);

text(b + "0%", 45, 500 - b * ring_size / 2);
}

float slice_size = PI / (data.length - 1);
int box_height = (800 - (data.length - 1) * 5) / (data.length - 1);
int box_height_w_space = box_height + 5;
int output_text;

for(int c = 1; c < data.length; c++){
 fill(random(255), random(255), random(255), 220);
 arc(50, 500, data[c][1] / total * multiplier, data[c][1] / total * multiplier, -PI/2 + (c - 1) * slice_size, -PI/2 + (c) * slice_size);
rect(600, 100 + (c-1) * box_height_w_space, 300, box_height);
fill(255);
textAlign(LEFT, TOP);
font_size = 30;
textFont(myFont, font_size);
output_text = round(data[c][1] / total * 100);
text(output_text + "%", 610, 100 + (c-1) * box_height_w_space + box_height / 2);
textAlign(RIGHT, CENTER);
fill(255);
font_size = 13;
textFont(myFont, font_size);
text(data[c][0], 890, 100 + (c-1) * box_height_w_space + box_height / 2);
}

font_size = 40;
textFont(myFont, font_size);
textAlign(CENTER, TOP);
text(title, 500, 60);