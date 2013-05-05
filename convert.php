
<?php

function convert($ret)
{
$dummy = explode(" ", $ret);
$param = array();

switch($dummy[0]){

	case 'COSTS':
	case "CONFIG":
	case "DIST":
		{
			for ($i =1; $i< count($dummy); $i++)
				{ // Costs, config, DIST
					array_push($param, intval($dummy[$i]));
				}	
			return $param;
			break;
		}
	case "DEMAND":
		{
			for ($i =1; $i< count($dummy); $i++)
				{ // Costs, config, DIST
					array_push($param, intval($dummy[$i]));
				}	
			return $param;
			break;	
		}
	case "PROFIT":
		{
			for ($i =1; $i< count($dummy); $i++)
				{ // Costs, config, DIST
					array_push($param, intval($dummy[$i]));
				}	
				unset($param[2]);
				
			return $param;
			break;	
		}
	default:
            echo "It is borked.";
            break;

				}

}

?>