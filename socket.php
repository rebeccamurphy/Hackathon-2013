<?php

$sock = socket_create(AF_INET, SOCK_STREAM, 0);
$ip_address = gethostbyname("hackathon.hopto.org");

if(!($sock = socket_create(AF_INET, SOCK_STREAM, 0)))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Couldn't create socket: [$errorcode] $errormsg \n");
}
 
echo "Socket created";

if(!socket_connect($sock , '67.202.15.69' , 19013))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not connect: [$errorcode] $errormsg \n");
}
 
echo "Connection established \n";
$message = "INIT Guffaws";
 
//Send the message to the server
if( ! socket_send ( $sock , "INIT Guffaws", strlen($message) , 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not send data: [$errorcode] $errormsg \n");
}
 
echo "Message send successfully \n";
 
//Now receive reply from server
$ret = "";

while ($ret!="ACCEPT"):
$ret .= socket_read($sock, PHP_NORMAL_READ);
endwhile;
echo $ret;

if( ! socket_send ( $sock , "RECD", strlen($message) , 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not send data: [$errorcode] $errormsg \n");
}
 
echo "Message send successfully \n";
 
//Now receive reply from server ;
$ret = "";
while (strlen($ret)<14): //"COSTS 9 3 6 15"
$ret .= socket_read($sock, PHP_NORMAL_READ);
endwhile;
echo $ret ."\n";


 
//print the received message

    
if( ! socket_send ( $sock , "START", strlen($message) , 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not send data: [$errorcode] $errormsg \n");
}
 
echo "Message send successfully \n";
 
//Now receive reply from server
$ret = ""; 
while (strlen($ret)<24): //"CONFIG 9 3 6 15"
$ret .= socket_read($sock, PHP_NORMAL_READ);
endwhile;
echo $ret ."\n";

//print the received message
// starts the game loop
$turns = 0;
while ($turns<10) {
    

for ( $i=0; $i<3; $i++)
{
if( ! socket_send ( $sock , "RECD", strlen("RECD"), 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not send data: [$errorcode] $errormsg \n");
}

echo "Message send successfully in loop  \n";

switch ($i) {
     case 0:
        $ret = "";
        while (strlen($ret)<31): //"DEMAND MON..."
        $ret .= socket_read($sock, PHP_NORMAL_READ);
        endwhile;
        echo $ret ."\n";
        break;
     case 1:
        $ret = "";
        while (strlen($ret)<36): //"DIST ..."
        $ret .= socket_read($sock, PHP_NORMAL_READ);
        endwhile;
        echo $ret ."\n";
        break;
     case 2:
        $ret = "";
        while (strlen($ret)<19): //"profit.."
        $ret .= socket_read($sock, PHP_NORMAL_READ);
        endwhile;
        echo $ret ."\n";
        break;
     default:
         echo "It broke!";
         break;
 } 
//Now receive reply from server

}
if( ! socket_send ( $sock , "CONTROL 0 0 0 0 0 0 0 0 0", strlen("CONTROL 0 0 0 0 0 0 0 0 0"), 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not send data: [$errorcode] $errormsg \n");
}
$turns+=1;
}


socket_close($sock);
?>