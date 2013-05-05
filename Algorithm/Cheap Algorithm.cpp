
//revenue, wcost, jcost, dcost: [9,3,6,15]

//wNA, wEU, wAP, jNA, jEU, jAP, dNA, dEU, dAP: [2,2,2,1,1,1,0,1,0]

//day, hh, mm, ss, numTransNA, numTransEU, numTransAP: [MON,0,0,0,176,248,621]

//revTrans numTrans 

#include <iostream>
int main(){

int revenue;
int wcost;
int jcost;
int dcost;
int numServers;
int config[9];
int demand[7];
int control[9];
string controlString;

for(int i=0; i<=8; i++){				//starting at the beginning of the CONFIG array
	//for(int j=4; j<=6; j++){			//starting at the first non date/time number of the DEMAND array (ignoring time for now)
		numServers = config[i];			//sets the number of servers to the number in the jth position of the config array
		if(numServers<2){
			control[i]=1;
		}
		else
			control[i]=-1;
	//}
}
for(int i=0; i<=8; i++){
	controlString=control[i]+" ";
}
for(int i=0; i<=8; i++){
    cout<< controlString << endl;
}
}