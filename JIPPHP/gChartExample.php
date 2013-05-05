<?php
ini_set('display_errors','1');
?>
<html>
<head>
<title>PHP Wrapper for Google Chart API Examples - 0.5</title>

<style type="text/css">
img { display:block; }
</style>
</head>
<body>
<h1>PHP Wrapper for Google Chart API Examples - 0.5</h1>
<h1>Quick examples.</h1>

<?php
require ('gChart.php');
?>

<h2>Line Chart with Grid Lines</h2>
<?php
$lineChart = new gLineChart(300,300);
$lineChart->addDataSet(array(1,3,7,4));
$lineChart->addDataSet(array(2,5,3,10));
$lineChart->addDataSet(array(1,9,6,1));
$lineChart->addDataSet(array(1,9,6,3));

$lineChart->setLegend(array("% Last Period", "% max Possible", "Cumulative Profits","% Max Possible"));
$lineChart->setColors(array("ff3344", "11ff11", "22aacc", "3333aa"));
$lineChart->setVisibleAxes(array('x','y'));
$lineChart->setDataRange(0, 100);
$lineChart->addAxisRange(0, 1, 4, 1);
$lineChart->addAxisRange(1, 0, 400);
$lineChart->setGridLines(33,10);
?>
<img src="<?php print $lineChart->getUrl();  ?>" /> 
<p>

</p>
</body>
</html>