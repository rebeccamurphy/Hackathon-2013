<?php
function Mega()
{
	
}


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
		const $proportionSwitchNaEu=0.7;
		const $proportionSwitchAP=0.5;
		$serverCost;											//cost of the server
		$numTrans;											//number of transactions currently in the object

	
		
	public 	function turnOn();											//this is entirely reliant on how we get info
	public 	function turnOff();											//and send it back to the game
		
	public  function isProfit(){
			int totalprofit;
			for(int i=1; i<=numServers; i++){
				totalprofit+=(((profitTrans * server(i).numTrans) + proportionSwitchNaEu(profitTrans*server(i).numTrans/*FROMEU*/) + proportionSwitchAP(profitTrans*server(i).numTrans/*FROMAP*/))proportionNumTrans;
			}
			bool shouldSwitch = totalprofit - (serverCost * numServersNA) /*THEN YOU MOTHERFUCKING REPEAT BUT FOR EU AND AP*/ > totalprofit - serverCost * (numServersNA + 1)) /*THEN SAME THING ONLY NOT n+1*/
			return shouldSwitch;
		}
	public  function fillServer(int newTrans){
			i = 1;
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
				}
				else{
					for (i; i<=numServers; i++){

						leftOver = server(i).numTrans + newTrans - 200;  //how many transfers left over
						server(i).numTrans += newTrans - leftOver;
						newTrans = leftOver;

						if (newTrans = 0) then{
							break;
						}
					}
					//DO THING HERE
					if(!isProfit()){
						server.turnOn();
					}
					else
						/*switch transactions to another region*/
						
				}
			}	
		}
																	//now what do we do?  Well, we have to decide what is the most profitable...
																	//newTrans transactions are left to take care of and all the servers on the same region are full


