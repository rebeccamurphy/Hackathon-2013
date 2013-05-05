<?php
function Mega($CONFIG,$COSTS,$DEMAND,$DIST)
{

//Master Key 

//Costs
//Revenue per transaction
$profitTrans = $COSTS[0];
//W_COST one webtier upkeep cost
$wServerCost = $COSTS[1];
//J_COST one javatier upkeep cost 
$jServerCost = $COSTS[2];
//D_COST one database tier upkeep cost
$dServerCost = $COSTS[3];

//Config

//W.na number of webservers up in NA
$numWebServersNA = $CONFIG[0];
//W.eu number of webservers up in EU
$numWebServersEU = $CONFIG[1];
//W.ap number of webservers up in AP
$numWebServersAP = $CONFIG[2];

//J.na number of java servers in NA
$numJavaServersNA = $CONFIG[3];
//J.eu number of java servers in EU
$numJavaServersEU = $CONFIG[4];
//J.ap number of java servers in AP
$numJavaServersAP = $CONFIG[5];


//D.na number of Databases in NA
$numDataServersNA = $CONFIG[6];
//D.eu number of Databases in EU
$numDataServersEU = $CONFIG[7];
//D.ap number of Databases in AP
$numDataServersAP = $CONFIG[8];

//DEMAND

/*I'm pretty sure I don't give a crap about the day, hour, minute, or second*/

$day = $DEMAND[0];
$hour = $DEMAND[1];
$min = $DEMAND[2];
$sec = $DEMAND[3];

//Transactions over all the tiers in a region.
$numTransNA = $DEMAND[4];
$numTransEU = $DEMAND[5];
$numTransAP = $DEMAND[6];

// DIST number of sucessful transactions over a region.
$
//W.na number of  sucessful transactions webservers in NA
$numWebSTNA = $DIST[0];
//W.eu number of sucessful transactions webservers  in EU
$numWebSTEU = $DIST[1];
//W.ap number of sucessful transactions webservers  in AP
$numWebSTAP = $DIST[2];

//J.na number of sucessful transactions java servers in NA
$numJavaSTNA = $DIST[3];
//J.eu number of sucessful transactions java servers in EU
$numJavaSTEU = $DIST[4];
//J.ap number of sucessful transactions java servers in AP
$numJavaSTAP = $DIST[5];


//D.na number of sucessful transactions Databases in NA
$numDataSTNA = $DIST[6];
//D.eu number of sucessful transactions Databases in EU
$numDataSTEU = $DIST[7];
//D.ap number of sucessful transactions Databases in AP
$numDataSTAP = $DIST[8];


function time()
{
	if ($hour > 9 and $hour <)
}

function isprofit()
{
// per web server 

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
		const $proportionSwitchNaEu=0.7;						//70% of people left after switching them to/from EU to/from NA
		const $proportionSwitchAP=0.5;						//Same for AP
		
		$serverCost;											//cost of the server
		$numTrans;											//number of transactions currently in the object

	
		
	public 	function turnOn();											//this is entirely reliant on how we get info
	public 	function turnOff();											//and send it back to the game
		
	public  function isProfit(){
			$totalprofit;
			for($i=1; $i<=numServers; $i++){
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
}

