column_width =( width - 200 - (data.length * 5)) / (data.length-1);
column_width_with_space = column_width + 5;

background(0);
fill(color(random(255), random(255), random(255)));
smooth();

PFont myFont = loadFont("Geo");  
int font_size = 15;
textFont(myFont, font_size);  
textAlign(LEFT, CENTER);

int largest = 0;
for (int a = 1; a < data.length; a++){
if(int(data[a][1]) > largest){
largest = int(data[a][1]);
}
}

multiplier = 750 / largest;

for(int a =1; a < data.length; a++)
{
rect(850 - int(data[a][1]) * multiplier, 150 + (a - 1) * column_width_with_space, int(data[a][1]) * multiplier, column_width);
text(data[a][0] , 860,  150 +( a - 1) * column_width_with_space + (column_width_with_space / 2) );
}

int font_size = 24;
textFont(myFont, font_size);  
textAlign(LEFT, BASELINE);
text(title, 100, 50);
int font_size = 13;
textFont(myFont, font_size);  
textblock(blurb, 100 , 70, 750);