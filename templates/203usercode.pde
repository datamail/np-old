N1 = 5;
N2 = 5;
sde = 5;
stroke(color(random(255),random(255),random(255)));
background(color(0,0,0));
smooth();

for (i=0;i<N1;i++){
    for (j=0;j<N2;j++){
        rect(100+i*sde,100+j*sde,100+i*sde+sde,100+j*sde+sde,);
    }
}