#include <iostream>
#include <string>
using namespace std;
int main(){
    /*
    int revenue;
    int wcost;
    int jcost;
    int dcost;
    int numServers;*/
    int config[9]={2,2,2,1,1,1,0,1,0};          //replace this with whatever you get from the game, this is just for testing
    int dist[9]={178,400,400,178,360,360,0,844,0};
    int demand[6]={0,0,0,176,248,621};
    cout << "Config looks like this: " << endl;
    for(int i=0; i<9; i++){
        cout << config[i] << " ";
    }
    int control[9];                     //this array will contain what we're giving back to the game to turn servers on/off
    cout << "\n\nControl array: ";
    for(int i=0; i<3; i++){				//starting at the beginning of the CONFIG array
        //for(int j=4; j<=6; j++){		//ignore for now
            if(demand[i+3]/config[i] >= 200){
                control[i]=1;
            }
            else
                control[i]=0;
    }
    for(int i=3; i<9; i++){
        control[i]=0;
    }
    for(int i=0; i<9; i++){
        cout << control[i] << " ";
    }
}
