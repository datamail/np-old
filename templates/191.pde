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
2009 2010 2009 2010
Landen(groepen) 1 000 euro 1 000 euro 1 000 euro 1 000 euro

Totaal Nabije- en Midden Oosten 1607831 2084314 2049787 2328450
Totaal AziÎ 56459927 74632664 25357719 31647803
China (Volksrepubliek) 21947764 31000719 4588711 5391098
Cyprus 82670 109960 324368 389491
Hongkong 1799859 2075898 1150715 1334208
India 2384990 3286564 1667456 1716919
IndonesiÎ 1721271 1884758 541537 464751
Iran (Islamitische Republiek) 1083469 1040734 549875 585816
IsraÎl 1294837 1577910 1037958 1220433
Japan 7250611 9274389 2380869 3190023
Koeweit 1176980 1754915 307948 334176
MaleisiÎ 4309491 5564232 629176 714874
Saoedi-ArabiÎ 1414719 2376381 1585567 1670715
Singapore 2251510 2675904 2074365 2909631
Taiwan 1851531 2408317 1287951 2459983
Thailand 2357858 2814537 702978 806249
Zuid-Korea 1740043 1891609 1728050 3222504
Overige Arabische Golfstaten 1384754 1871106 2866783 3075198
Overig AziÎ 2177246 2628287 1245951 1443208
Overige Nabije- en Midden Oosten 230324 396444 687461 718526
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