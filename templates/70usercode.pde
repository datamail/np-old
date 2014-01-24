rotate(PI/2);
translate(0, -1000);

column_width =( width - 200 - (data.length * 5)) / (data.length - 1);
column_width_with_space = column_width + 5;

background(0);
fill(color(random(255), random(255), random(255)));
smooth();

PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(RIGHT, CENTER);

int largest = 0;
for (int a = 1; a < data.length; a++){
if(int(data[a][1]) > largest){
largest = int(data[a][1]);
}
}

multiplier = 750 / largest;

rotate (PI);
translate(-width, -height);

for(int a =1; a < data.length; a++)
{
rect(70 + a * column_width_with_space, 150, column_width, int(data[a][1]) * multiplier);
rotate(PI/2);
translate(0, -height);
text(data[a][0] , 145, 930 - a * column_width_with_space  - (column_width_with_space / 2)  );
translate(0, height);
rotate(-PI/2);
}

rotate(PI/2);
translate(0, -1000);
int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 150, 50);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 150 , 70, 750);