<html>

<head>

</head>

<body>
<?php
//include 'convert.php'
include 'socket.php'
?>

<?php
    echo "<textarea name='mydata'>\n";
    echo htmlspecialchars($data)."\n";
    echo "</textarea>";
?>

<!---
What should be on the screen:

= max/min # of servers in given region over the course of the whole thing
= run with highest revenue
= total revenue
-->

</body>
</html>