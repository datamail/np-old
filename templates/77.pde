void setup()  
				{  
					size(1000,1000);  
					background(0);
					smooth();
					fill(255);  
					noLoop();
					noStroke();    
				}  
					  
				void draw(){background(0,0,0);
fill(255,255,255); }void textblock(String textblockstring, int textblockx, int textblocky, int textblockwidth)
				{
				String [] textblock = split(textblockstring, " ");
				float textblockw = 0;
				float textblockynow = textblocky;
				for(int a = 0; a < textblock.length; a++)
				{
				textblockw += textWidth(textblock[a] + " ");
				if(textblockw > textblockwidth + textblockx)
				{
				  textblockynow += 15;
				  textblockw = textWidth(textblock[a] + " ");
				}
				
				text(textblock[a]+ " ", textblockw + textblockx - textWidth(textblock[a] + " "), textblockynow);
				}
				}