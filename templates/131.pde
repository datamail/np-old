void setup()  
{  
	size(1000,1000);  
	background(0);
	smooth();
	fill(255);  
	noLoop();
	noStroke();
	PFont fontA = loadFont("courier");  
	textFont(fontA, 14);     
}  
	  
void draw(){
|         Date [0]       |  Cat/Name Col 1 [1] |  Cat/Name Col 2 [2] |  Cat/Name Col 3 [3] |      Num Col 1 [4] |      Num Col 2 [5] |      Num Col 3 [6] |
|          1982          |      Cat/Name 8      |      Cat/Name 5      |      Cat/Name 1      |           628           |           6909           |           7525           |
|          1983          |      Cat/Name 8      |      Cat/Name 6      |      Cat/Name 4      |           5104           |           5503           |           8905           |
|          1984          |      Cat/Name 3      |      Cat/Name 5      |      Cat/Name 1      |           2496           |           1259           |           380           |
|          1985          |      Cat/Name 9      |      Cat/Name 8      |      Cat/Name 1      |           6991           |           4315           |           1857           |
|          1986          |      Cat/Name 3      |      Cat/Name 8      |      Cat/Name 7      |           6407           |           399           |           8552           |
|          1987          |      Cat/Name 1      |      Cat/Name 9      |      Cat/Name 8      |           3247           |           9868           |           1117           |
|          1988          |      Cat/Name 6      |      Cat/Name 8      |      Cat/Name 1      |           7866           |           6003           |           318           |
|          1989          |      Cat/Name 3      |      Cat/Name 2      |      Cat/Name 8      |           3119           |           1414           |           36           |
|          1990          |      Cat/Name 1      |      Cat/Name 5      |      Cat/Name 5      |           202           |           4172           |           252           |
|          1991          |      Cat/Name 7      |      Cat/Name 8      |      Cat/Name 4      |           5009           |           4792           |           8345           |
|          1992          |      Cat/Name 8      |      Cat/Name 1      |      Cat/Name 4      |           7637           |           4173           |           3851           |
|          1993          |      Cat/Name 9      |      Cat/Name 9      |      Cat/Name 2      |           7774           |           6663           |           301           |
|          1994          |      Cat/Name 4      |      Cat/Name 7      |      Cat/Name 3      |           957           |           5943           |           7925           |
|          1995          |      Cat/Name 3      |      Cat/Name 3      |      Cat/Name 9      |           5149           |           430           |           9616           |
|          1996          |      Cat/Name 2      |      Cat/Name 10      |      Cat/Name 3      |           8980           |           5347           |           4886           |
|          1997          |      Cat/Name 10      |      Cat/Name 7      |      Cat/Name 8      |           4543           |           288           |           7230           |
|          1998          |      Cat/Name 4      |      Cat/Name 6      |      Cat/Name 6      |           5747           |           2231           |           6460           |
|          1999          |      Cat/Name 6      |      Cat/Name 2      |      Cat/Name 1      |           8348           |           2374           |           5684           |
|          2000          |      Cat/Name 10      |      Cat/Name 1      |      Cat/Name 8      |           8596           |           9991           |           4623           |
|          2001          |      Cat/Name 9      |      Cat/Name 4      |      Cat/Name 6      |           6037           |           5519           |           2244           |
|          2002          |      Cat/Name 5      |      Cat/Name 7      |      Cat/Name 6      |           6613           |           2129           |           5780           |
|          2003          |      Cat/Name 5      |      Cat/Name 1      |      Cat/Name 9      |           410           |           5162           |           7758           |
|          2004          |      Cat/Name 5      |      Cat/Name 3      |      Cat/Name 2      |           5702           |           5225           |           2275           |
|          2005          |      Cat/Name 4      |      Cat/Name 7      |      Cat/Name 6      |           5377           |           6736           |           5087           |
}
void textblock(String textblockstring, int textblockx, int textblocky, int textblockwidth)
{
	String [] textblock = split(textblockstring, " ");
	float textblockw = 0;
	float textblockynow = textblocky;
	for(int a = 0; a < textblock.length; a++)
	{
		textblockw += textWidth(textblock[a] + " ");
		if(textblockw > textblockwidth)
		{
			textblockynow += 15;
			textblockw = textWidth(textblock[a] + " ");
		}	
		text(textblock[a]+ " ", textblockw + textblockx - textWidth(textblock[a] + " "), textblockynow);
	}
} 