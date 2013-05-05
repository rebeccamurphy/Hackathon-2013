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
array_push($data_arr, 1, 2, 3, 4, 5, 6, 7, 8, 9); //for now, initializes data_arr to have the numbers 1-9

$x_axis_range_min = 0;    //first turn
$x_axis_range_max = 3000; //last turn + 20 for good measure

$y_axis_range_min = 20000;    //minimum value from data set
$y_axis_range_max = -20000;   //maximum value from data set
$y_axis_range_step = 1;       //we're doing every 10 mins, but the space between will be 1 (just labeled diff.)

$lineChart = new gLineChart(300,300);
$lineChart->addDataSet($data_arr);
$lineChart->setLegend(array("Profits"));
$lineChart->setColors(array("ff3344"));
$lineChart->setVisibleAxes(array('x','y')); //I think the only valid values for this are 'x' or 'y'
$lineChart->setDataRange($y_axis_range_min, $y_axis_range_max); //I think this counts for both axes
//PARAMETERS below: axis index, start value, end value, count between steps on axis (opt.)
$lineChart->addAxisRange(0, $x_axis_range_min, $x_axis_range_max, 1);
$lineChart->addAxisRange(1, $y_axis_range_min, $y_axis_range_max, $y_axis_range_step);
$lineChart->addAxisLabel(0, array("Turn"));
$lineChart->addAxisLabel(1, array("Profits"));
//PARAMETERS below: part of chart being filled, color
$lineChart->addBackgroundFill('bg', 'c4e53a');
$lineChart->addBackgroundFill('c', '000000');
?>
<img src="<?php print $lineChart->getUrl();  ?>" /> <br> line chart using the gLineChart class.

<!---
<h1>PHP Wrapper for Google Chart API - Serverside Rendering - 0.1</h1>
<h3>URL Request</h3>
For the image below, post=false
<p>
<img src="img.php?width=300&amp;height=200&amp;post=false" />
</p>
<p>
<h3>Post request</h3>
For the image below, post=true
<p>
<img src="img.php?width=300&amp;height=200&amp;post=true" />
</p>
-->

</body>
</html>