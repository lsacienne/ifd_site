#include <stdio.h>
#include <stdlib.h>

int main(){
	FILE *fcss;
	fcss = fopen("css_generator.css","w");
	for(int i=0;i<=100;i++){
		if(i<100){
			fprintf(fcss,".background_graph_1 .rectangle_stat.taille%d{height:%d%; margin-bottom:0}\n",i,i);
		} else {
			fprintf(fcss,".background_graph_1 .rectangle_stat.taille%d{height:%d%; margin-bottom:0}",i,i);
		}
	}
	fclose(fcss);
	free(fcss);
	return EXIT_SUCCESS;
}