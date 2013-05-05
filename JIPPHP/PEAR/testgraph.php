<html>
<head>
<title>PHP Wrapper for Google Chart API - Serverside Rendering - 0.1</title>
</head>
<body>


<h1> Line Chart with Grid Lines</h1>
<?php // content="text/plain; charset=utf-8"
require ('gChart.php');
include ('gLineChart.php');

$lineChart = new gLineChart(300,300);
$lineChart->addDataSet(array(112,315,66,40));
$lineChart->addDataSet(array(212,115,366,140));
$lineChart->addDataSet(array(112,95,116,140));
$lineChart->setLegend(array("first", "second", "third","fourth"));
$lineChart->setColors(array("ff3344", "11ff11", "22aacc", "3333aa"));
$lineChart->setVisibleAxes(array('x','y'));
$lineChart->setDataRange(0,400);
$lineChart->addAxisRange(0, 1, 4, 1);
$lineChart->addAxisRange(1, 0, 400);
$lineChart->setGridLines(33,10);
?>
<img src="<?php print $lineChart->getUrl();  ?>" /> <br> line chart using the gLineChart class.
<p>

<?php	
$graph->Stroke();

?>

</body>
</html>