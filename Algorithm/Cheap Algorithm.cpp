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
    cout << "Config looks like this: " << endl;
    for(int i=0; i<9; i++){
        cout << config[i] << " ";
    }
    //int demand[7];
    int control[9];                     //this array will contain what we're giving back to the game to turn servers on/off
    cout << "\n\nControl array: ";
    for(int i=0; i<9; i++){				//starting at the beginning of the CONFIG array
        //for(int j=4; j<=6; j++){		//ignore for now
            if(config[i]<=1){
                control[i]=1;
            }
            else{
                control[i]=-1;
            }
        //}
        cout << control[i] << " ";
    }

}
