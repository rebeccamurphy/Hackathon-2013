<?php
include 'convert.php';
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

if(!socket_connect($sock , '67.202.15.69' , 19012))
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
$COSTS = socket_read($sock, 1024, PHP_BINARY_READ);   
echo $COSTS ."\n";

$COSTS = convert($COSTS);
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
while ($turns<3) {


    //im just going to hard code these. its the easiest way

    //config    
        $ret = "";
        $ret = socket_read($sock, 1000, PHP_BINARY_READ);
        if ($ret =="END")
        {
            break;
        }   
        echo $ret . "\n";
        $CONFIG = convert($ret);


        if( ! socket_send ( $sock , "RECD", strlen("RECD"), 0))
            {
                $errorcode = socket_last_error();
                $errormsg = socket_strerror($errorcode);
                die("Could not send data: [$errorcode] $errormsg \n");
            }
    //DEMAND
        $ret = "";
        $ret = socket_read($sock, 1000, PHP_BINARY_READ);   
        echo $ret . "\n";
        $DEMAND= convert($ret);

        if( ! socket_send ( $sock , "RECD", strlen("RECD"), 0))
            {
                $errorcode = socket_last_error();
                $errormsg = socket_strerror($errorcode);
                die("Could not send data: [$errorcode] $errormsg \n");
            }
    //DIST
        $ret = "";
        $ret = socket_read($sock, 1000, PHP_BINARY_READ);   
        echo $ret . "\n";
        $DIST= convert($ret);

        if( ! socket_send ( $sock , "RECD", strlen("RECD"), 0))
            {
                $errorcode = socket_last_error();
                $errormsg = socket_strerror($errorcode);
                die("Could not send data: [$errorcode] $errormsg \n");
            }
    //PROFIT
        $ret = "";
        $ret = socket_read($sock, 1000, PHP_BINARY_READ);   
        echo $ret . "\n";
        $PROFIT= convert($ret);

        
    
/*
This part is where we would reference another function to do how we should control the game.
*/
if( ! socket_send ( $sock , "CONTROL 0 0 0 0 0 0 0 0 0", strlen("CONTROL 0 0 0 0 0 0 0 0 0"), 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not send data: [$errorcode] $errormsg \n");
}
//This should return PROFIT and and another turn.
$turns+=1;

}

if( ! socket_send ( $sock , "STOP", strlen("STOP"), 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not send data: [$errorcode] $errormsg \n");
}

socket_close($sock);
echo "IT HAS BEEN DONE."
?>