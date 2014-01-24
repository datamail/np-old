PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);

background(255);
noStroke();
smooth();
fill(0);
text(title, 100, 50);
font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 70, 800);

int data_vals [] = new int [data.length - 1];
for(int a = 1; a < data.length; a++) {
 data_vals [a-1] = int(data[a][1]);
}

data_vals = sort(data_vals);
rectMode(CORNERS);

float multiplier = 750 / data_vals[data_vals.length - 1];

for(int b = data_vals.length-1; b > -1; b--) {
fill(random(255), random(255), random(255));
 rect(100, 950, 100 + data_vals[b] * multiplier, 950 - data_vals[b] * multiplier);
fill(0);
text(data[b+1][0], 100 + data_vals[b] * multiplier + 3, 950 - data_vals[b] * multiplier);
}