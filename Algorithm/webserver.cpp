//Let's say we're deciding between transferring a client over to
//another server, or turning a server on in his most local region
//Example: Tranferring client to EU from NA, or turning on NA server
//on webserver tier


//let's assume that we got the information and it's parsed and stored
//in variables of some sort?
//((profitTrans * numTrans) + proportionSwitchEU(profitTrans*numTransFROMEU) + proportionSwitchAP(profitTrans*numTransFROMAP))proportionNumTrans
//+ for each server in the region since the number of people is different... - serverCost * numServersNA
//the repeat for eu or ap

//>

//((profitTrans*numTrans) + proportionSwitchEU(profitTrans*numTransFROMEU) + proportionSwitchAP(profitTrans*numTransFROMAP))lossNumTrans
// + for each server in the region since the number of people is different... - serverCost * (numServersNA + 1) THEN SAME THING ONLY NOT n+1
class WebServer{
	protected:
		const int proportionSwitchNaEu=0.7;						//70% of people left after switching them to/from EU to/from NA
		const int proportionSwitchAP=0.5;						//Same for AP
		int serverCost;											//cost of the server
		int numTrans;											//number of transactions currently in the object

	public:
		WebServer(){
			serverCost = 0;
			numTrans = 0;										//number of transactions currently in the server
		}
		WebServer(int cost, int numT){
			serverCost = cost;									//has to be tweaked to get info from game
			numTrans = numT;
		}
		void turnOn();											//this is entirely reliant on how we get info
		void turnOff();											//and send it back to the game
		bool isProfit(){
			int totalprofit;
			for(int i=1; i<=numServers; i++){
				totalprofit+=(((profitTrans * server[i].numTrans) + proportionSwitchNaEu(profitTrans*server[i].numTrans/*FROMEU*/) + proportionSwitchAP(profitTrans*server[i].numTrans/*FROMAP*/))proportionNumTrans;
			}
			bool shouldSwitch = totalprofit - (serverCost * numServersNA) /*THEN YOU REPEAT BUT FOR EU AND AP*/ > totalprofit - serverCost * (numServersNA + 1)) /*THEN SAME THING ONLY NOT n+1*/
			return shouldSwitch;
		}
		void fillServer(int newTrans){
		}
		void profitable(){
			WebServer server[numServers];
			for(int i=0; i<=numServers; i++){
				server[i].serverCost=serverCost[i];				//temporary variable used for testing and comparisons
				server[i].numTrans=numTrans[i];
			}
			int i = 0;
			int leftOver;
			if (server[i].numTrans + newTrans < 180) then{		//if the current transaction number + the transactions to be added are under 180 then
				server[i].numTrans += newTrans;					//add the transactions to the server
				newTrans = 0;
				break;

			}
			else {
				if (i != numServers) {	//if the current server is not the last one (doesn't equal the total number of servers)
					for (j = i+1; j <=numServers; j++)		//starting at the next server
					{
						if (server(j).numTrans + newTrans < 180){	//if adding the transactions will not exceed 180
							server(j).numTrans = server(j).numTrans + newTrans;		//then add them broski
							newTrans = 0;
							break;
						}

					}
				}
				else{
					for (i; i<=numServers; i++){

						leftOver = server[i].numTrans + newTrans - 200;  //how many transfers left over
						server[i].numTrans += newTrans - leftOver;
						newTrans = leftOver;

						if (newTrans = 0) then{
							break;
						}
					}
					//DO THING HERE
					if (R(2).server[i].numTrans + X < 180){						//checks the first server in the second region (EU) and checks if we can add the transitions
																			//without exceeding 180
						R(2).server[i].numTrans = R(2).server[i].numTrans + X;		//if we aren't going to exceed 180, then add the transactions to the server
						X = 0;
						BREAK OUT OF LOOP
					}
					else {													//if we are going to exceed 180, then:

						if (i != R(2).numServers){							//make sure we are not on the last server of the region
								
							for (j = i+1, j <= R(2).numServers, j++)		//start at the second server
						{

							if (R(2).server[j].numTrans + X < 180) then{			//check if we can add transactions to that server without exceeding 180
								server[j].t = server[j].t + X;						//if we can then add them
								X = 0;
								BREAK OUT OF LOOP
							}
							
							}
								
						}else{
						
							for (i, i<=R(2).numServers, i++){		//starting at the first server, we attempt to put a few more transactions into each server, up to 200
						
								L = (R(2).server[i].numTrans + X - 200)  //how many transfers left over
								R(2).server[i].numTrans = R(2)server[i].numTrans + X - L
								X = L
							
								if (X = 0) then{
									BREAK OUT OF LOOP
								}
							
							}
						}
						// NEEDS A WAY TO KEEP TRACK OF HOW MANY WERE TRANSFERED FROM R(1) TO R(2) FOR PRICE COMPARISONS LATER USING SOME PARTS OF WHATISMYLIFE CODE
						
						if (X != 0){
						
							i = 1	

							if (R(3).server[i].numTrans + X < 180){
							
								R(3).server[i].numTrans = R(2).server[i].numTrans + X;		//goes to the next region and repeats
								X = 0;
								BREAK OUT OF LOOP
							}
							else {

								if (i != R(3).numServers){
									
									for (j = i+1, j <=R(3).numServers, j++)
								{
						
									if (R(3).server[j].numTrans + X < 180) then{
										server[j].t = server[j].t + X;
										X = 0;
										BREAK OUT OF LOOP
									}
							
								
								}
								// NEEDS A WAY TO KEEP TRACK OF HOW MANY WERE TRANSFERED FROM R(1) TO R(3) FOR PRICE COMPARISONS LATER USING SOME PARTS OF WHATISMYLIFE CODE
						
								if (X != 0){
										//THEN A NEW SERVER DEFINITITELY NEEDS TO ME MADE I'M PRETTY SURE, EVERYWHERE IS PRETTY DAMN FULL
								}
							}

						}
					}

					//AND THEN THIS GETS COMPARED TO THE SAME THING, ONLY USE R(3) FIRST THEN R(2)

					//THEN WE START DOING PRICE COMPARISION FOR R(1)-->R(2)-->R(3), R(1)-->R(3)-->R(2), AND MAKING A NEW SERVER IN R(1)



