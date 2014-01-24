background(color(44,44,44));
fill(color(random(255), random(255), random(255)));
smooth();
PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(RIGHT, CENTER);
column_width = 20;
column_width_with_space = column_width + 5;
for(int a =0; a < data.length; a++)
{
...
}
rotate (PI);
translate(-width, -height);
for(int a =0; a < data.length; a++)
{
rect(100 + a * column_width_with_space, 150, column_width, int(data[a][1]) * multiplier);
rotate(PI/2);
translate(0, -height);
text(data[a][0] , 145, 900 - a * column_width_with_space  - (column_width_with_space / 2)  );
translate(0, height);
rotate(-PI/2);
}
rotate(PI);
translate(-width, -height);
int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 50);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 70, 700);
column_width =( width - 200 - (data.length * 5)) / (data.length);
column_width_with_space = column_width + 5;
int largest = 0;
for (int a = 0; a < data.length; a++){
if(int(data[a][1]) > largest){
largest = int(data[a][1]);
}
}

multiplier = 700 / largest;
column_width =( width - 200 - (data.length * 5)) / (data.length);
column_width_with_space = column_width + 5;

background(color(44,44,44));
fill(color(random(255), random(255), random(255)));
smooth();

PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(RIGHT, CENTER);

int largest = 0;
for (int a = 0; a < data.length; a++){
if(int(data[a][1]) > largest){
largest = int(data[a][1]);
}
}

multiplier = 700 / largest;

rotate (PI);
translate(-width, -height);

for(int a =0; a < data.length; a++)
{
rect(100 + a * column_width_with_space, 150, column_width, int(data[a][1]) * multiplier);
rotate(PI/2);
translate(0, -height);
text(data[a][0] , 145, 900 - a * column_width_with_space  - (column_width_with_space / 2)  );
translate(0, height);
rotate(-PI/2);
}

rotate(PI);
translate(-width, -height);
int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 50);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 70, 700);