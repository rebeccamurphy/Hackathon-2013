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
		int serverCost;											//cost of the server
		int numTrans;											//number of transactions currently in the object

	public:
		WebServer(): serverCost(0), numTrans(0){}
		WebServer(int cost, int numT){
			serverCost = cost;									//has to be tweaked to get info from game
			numTrans = numT;
		}
		void turnOn();											//this is entirely reliant on how we get info
		void turnOff();											//and send it back to the game
		bool isProfit(){

		}
		int fillServer(int newTrans){
			i = 1
			int leftOver;
			if (server(i).numTrans + newTrans < 180) then{		//if the current transaction number + the transactions to be added are under 180 then
				server(i).numTrans += newTrans;					//add the transactions to the server
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
				}else{
					for (i; i<=numServers; i++){

						leftOver = server(i).numTrans + newTrans - 200;  //how many transfers left over
						server(i).numTrans = server(i).numTrans + newTrans - leftOver;
						newTrans = leftOver;

						if (newTrans = 0) then{
							break;
						}
					}

					newTrans TRANSFERES ARE LEFT SO YOU MUST DO THE THING

				}

			}
		}

