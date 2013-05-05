<html>
<head>
<title>PHP Wrapper for Google Chart API - Serverside Rendering - 0.1</title>
</head>
<body>
<?php
require ('gChart.php');
?>
<h2 align=center>Line Chart</h2>
<?php
/**
 * This is a line graph intended to show the progression of profits across
 * the span of the game. Every 10 minutes (20 turns) will be an entry into the
 * x-axis, and the corresponding revenue at that time will be the y value.
 */
$data_arr = array(); //will contain all the values we need to display, used in addDataSet
$data_arr = array_fill(0, 10, 15000); //for now, initializes data_arr to have 10 instances of 15000

// 25 elements: 100, 200, 300, ... 1400
//for ($iii=0; $iii<15; $iii++) {
//	$data_arr[$iii] = ($iii * 100);
//}

$x_axis_range_min = 0;    //first turn
$x_axis_range_max = 3000; //last turn + 20 for good measure
$x_axis_range_step = 600;

$y_axis_range_min = -20000;    //minimum value from data set
$y_axis_range_max = 20000;   //maximum value from data set
$y_axis_range_step = 5000;

$lineChart = new gLineChart(1000,600);
$lineChart->addDataSet($data_arr);
$lineChart->setLegend(array("Profit per Turn"));
$lineChart->setColors(array("250066")); //deep blue
$lineChart->setVisibleAxes(array('x','y')); //I think the only valid values for this are 'x' or 'y'
$lineChart->setDataRange($y_axis_range_min, $y_axis_range_max); //I think this counts for both axes
//PARAMETERS below: axis index, start value, end value, count between steps on axis (opt.)
$lineChart->addAxisRange(0, $x_axis_range_min, $x_axis_range_max, $x_axis_range_step);
$lineChart->addAxisRange(1, $y_axis_range_min, $y_axis_range_max, $y_axis_range_step);
$lineChart->addAxisLabel(0, array("Turn"));
$lineChart->addAxisLabel(1, array("Moneys"));
//PARAMETERS below: part of chart being filled, color
$lineChart->addBackgroundFill('bg', 'a21044'); //purple-ish red
$lineChart->addBackgroundFill('c', '000000');  //black
?>
<img src="<?php print $lineChart->getUrl();  ?>" /> <br> line chart using the gLineChart class.
</body>
</html>