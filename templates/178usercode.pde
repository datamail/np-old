color back = color(255);
background(255);
smooth();

stroke(200);
line(200, height / 2, 900, height / 2);
noStroke();

PFont myFont = loadFont("Geo");
int font_size = 15;
textFont(myFont, font_size);
textAlign(LEFT, CENTER);

int largest = 0;
for (int a = 1; a < data.length; a++) {
    if (data[a][1] > largest) {
        largest = int(data[a][1]);
    }
    if (data[a][2] > largest) {
        largest = int(data[a][2]);
    }
}

int total_added = 0;
boolean fits = false;
float multiplier = 9999;
while (fits == false) {
    for (int a = 1; a < data.length; a++) {
        total_added += int(data[a][1]) * multiplier;
    }
    if (total_added < 1200) {
        fits = true;
    } else {
        total_added = 0;
        multiplier = multiplier * 0.99;
    }
}
width_counter = 150;
int levels = 1;
for (int a = 1; a < data.length; a++) {
    fill(color(random(255), random(255), random(255)), 180);
    ellipse(width_counter + int(data[a][1]) * multiplier / 2, height / 2 - int(data[a][1]) * multiplier / 2, int(data[a][1]) * multiplier, int(data[a][1]) * multiplier);
    ellipse(width_counter + int(data[a][1]) * multiplier / 2, height / 2 + int(data[a][2]) * multiplier / 2, int(data[a][2]) * multiplier, int(data[a][2]) * multiplier);
    rotate(PI / 2);
    translate(0, -height);
try{
    if (int(data[a][1]) * multiplier / 2 + int(data[a + 1][1]) * multiplier / 2 < 15 || int(data[a][2]) * multiplier / 2 + int(data[a + 1][2]) * multiplier / 2 < 15) {

        text(data[a][0], 500 + largest * multiplier + 10 +  levels *  100, 1000 - width_counter - int(data[a][1]) * multiplier / 2);
        stroke(190);
        line(500 + largest * multiplier + 10, 1000 - width_counter - int(data[a][1]) * multiplier / 2, 500 + largest * multiplier + 10 + levels * 100, 1000 - width_counter - int(data[a][1]) * multiplier / 2);
        noStroke();
        levels += 1;
    } else {
        levels = 1;
        text(data[a][0], 500 + largest * multiplier + 10, 1000 - width_counter - int(data[a][1]) * multiplier / 2);
    }
}
catch(Exception e){
text(data[data.length - 1][0], 500 + largest * multiplier + 10, 1000 - width_counter - int(data[data.length - 1][1]) * multiplier / 2);
}
    translate(0, height);
    rotate(-PI / 2);
    if (data[a][1] > data[a][2]) {
        width_counter += int(data[a][1]) * multiplier / 2;
    } else {
        width_counter += int(data[a][2]) * multiplier / 2;
    }
    //println(data[data.length - 1][0]);
}



font_size = 24;
textFont(myFont, font_size);
textAlign(CENTER, BASELINE);
fill(0);
/*rotate(-PI / 2);
translate(-width, 0);
text(data[0][1], width * 5 / 8, 100);
textAlign(RIGHT, BASELINE);
text(data[0][2], width * 3 / 8, 100);
translate(width, 0);
rotate(PI / 2);*/
textAlign(LEFT, BASELINE);
text(title, 60, 60);
int font_size = 13;
textFont(myFont, font_size);
textblock(blurb, 60, 80, 880);