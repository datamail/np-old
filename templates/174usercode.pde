background(255);
color from = color(27, 122, 224);
color to = color(224, 27, 76);
fill(0);
smooth();
font_size = 20;
PFont myFont = loadFont("Oswald");  
textFont(myFont, font_size);
textAlign(LEFT, CENTER);

fill(from);
rect(0, 50, 100, 30);
fill(to);
rect(0, 83, 90, 30);
fill(0);
text("Low", 110, 65);
text("High", 100, 98);

int total = 0;
int largest = 0;

for(int a = 1; a < data.length; a++){
 if(int(data[a][0]) > largest){
  largest = int(data[a][0]);
 }
total+= int(data[a][0]);
}

int pixel_size = floor(sqrt(600 * 600 / (data.length - 1)));
int per_row = floor(600 / pixel_size);

int hor_counter = 0;
int vert_counter = 0;

while(per_row * vert_counter + hor_counter < data.length - 1){


fill(lerpColor(from, to, data[per_row * vert_counter + hor_counter + 1][0] / largest));
stroke(255);
 rect(200 + hor_counter * pixel_size, 200 + vert_counter * pixel_size, pixel_size, pixel_size);
fill(255);
if(hor_counter == (per_row - 1)){
hor_counter = 0;
vert_counter += 1;
}
else{
hor_counter += 1;
}
}