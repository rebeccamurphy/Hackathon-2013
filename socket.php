<?php

$sock = socket_create(AF_INET, SOCK_STREAM, 0);
$ip_address = gethostbyname("hackathon.hopto.org");
//lines 1-25 creates and establishes the connection. 26-76 sends messages to start game. 
//line 54-57 deal with the first COSTS we get back.
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
 
//Send the message to the server
if( ! socket_send ( $sock , "INIT Guffaws", strlen("INIT Guffaws") , 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not send data: [$errorcode] $errormsg \n");
}
 
echo "Message send successfully \n";
 
//Now receive reply from server
$ret = ""; //ACCEPT
$ret = socket_read($sock, 1000, PHP_BINARY_READ);   
echo $ret ."\n";

if( ! socket_send ( $sock , "RECD", strlen("RECD") , 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not send data: [$errorcode] $errormsg \n");
}
 
echo "Message send successfully \n";
 
//Receives the first COST BEFORE START
//"COSTS 9 3 6 15"
$ret = ""; 
$ret = socket_read($sock, 1000, PHP_BINARY_READ);   
echo $ret ."\n";
 
//STARTS TEH GAME
    
if( ! socket_send ( $sock , "START", strlen("START") , 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not send data: [$errorcode] $errormsg \n");
}
 
echo "Message send successfully \n";
 

//beneath is where the game really starts. 
// starts the game loop
$turns = 0;
while ($turns<2) {
   

for ( $i=0; $i<3; $i++)
{
if( ! socket_send ( $sock , "RECD", strlen("RECD"), 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not send data: [$errorcode] $errormsg \n");
}
        $ret = "";
        //"DEMAND MON..."
        $ret = socket_read($sock, 1000, PHP_BINARY_READ);   
        echo $ret ."\n";
        echo "Message send successfully in loop  \n";
    }
/*

//Now receive reply from server
*/

if( ! socket_send ( $sock , "CONTROL 0 0 0 0 0 0 0 0 0", strlen("CONTROL 0 0 0 0 0 0 0 0 0"), 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not send data: [$errorcode] $errormsg \n");
}
$ret = "";
        //"DEMAND MON..."
$ret = socket_read($sock, 1000, PHP_BINARY_READ);   
echo $ret . "\n";
$turns+=1;
}


socket_close($sock);
?>