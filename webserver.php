<?php
function Mega($CONFIG,$COSTS,$DEMAND,$DIST, $turns)
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



$control = array();
$contstr = "CONTROL ";                     //this array will contain what we're giving back to the game to turn servers on/off
    
for($i=0; $i<6; $i++){				//starting at the beginning of the CONFIG array
        		
            if($CONFIG[$i]<=1){
                $control[$i]=1;

            }
            else{

                $control[$i]=0;

            }

	$contstr .= $control[$i] . " " ;              
    
    }

switch($turns)

{
	case 576: $numDataSTEU =1;
				break;
	case 1152: 	$numDataSTEU =1;
				break;		
	case 1728: $numDataSTEU =1;
				break;
	case 2304: 	$numDataSTEU =1;
				break;
	case 2880: 	$numDataSTEU =1;
				break;
	default: $numDataSTEU =0;
				break;


}
return $contstr . $numDataServersNA . " " . $numDataSTEU . " " .$numDataServersAP;

}


?>