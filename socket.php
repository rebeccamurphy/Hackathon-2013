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

while ($ret!=" "):
$ret = socket_read($sock, PHP_NORMAL_READ);
echo $ret;
endwhile;


if( ! socket_send ( $sock , "RECD", strlen($message) , 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not send data: [$errorcode] $errormsg \n");
}
 
echo "Message send successfully \n";
 
//Now receive reply from server
echo socket_read($sock, PHP_NORMAL_READ) ;

/*
if(socket_recv ( $sock , $buf , 14, MSG_WAITALL ) === FALSE)
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not receive data: [$errorcode] $errormsg \n");
}
 
//print the received message
echo $buf. "\n";
    
if( ! socket_send ( $sock , "START", strlen($message) , 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not send data: [$errorcode] $errormsg \n");
}
 
echo "Message send successfully \n";
 
//Now receive reply from server
if(socket_recv ( $sock , $buf , 24, MSG_WAITALL ) === FALSE)
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not receive data: [$errorcode] $errormsg \n");
}
 /*
//print the received message
echo $buf. "\n";
function butt()
{
return "RECD";
}
$turns =0; 
while ($turns<10) {
    

for ( $i=0; $i<3; $i++)
{
if( ! socket_send ( $sock , butt(), strlen(butt()), 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not send data: [$errorcode] $errormsg \n");
}

echo "Message send successfully \n";

switch ($i) {
     case 0:
        if(socket_recv ( $sock , $buf ,strlen($buf) +7, MSG_WAITALL ) === FALSE)
        {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
     
            die("Could not receive data: [$errorcode] $errormsg \n");
        }
        echo $buf. "\n";
         break;
     case 1:
        if(socket_recv ( $sock , $buf ,strlen($buf) +5, MSG_WAITALL ) === FALSE)
        {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
     
            die("Could not receive data: [$errorcode] $errormsg \n");
        }
        echo $buf. "\n";
         break;
     case 2:
        if(socket_recv ( $sock , $buf, strlen($buf)-17, MSG_WAITALL ) === FALSE)
        {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
     
            die("Could not receive data: [$errorcode] $errormsg \n");
        }
        echo $buf. "\n";
        break;
     default:
         echo "It broke!";
         break;
 } 
//Now receive reply from server
/*if(socket_recv ( $sock , $buf ,strlen($buf) +7, MSG_WAITALL ) === FALSE)
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not receive data: [$errorcode] $errormsg \n");
}
echo $buf. "\n";

}
if( ! socket_send ( $sock , "CONTROL 0 0 0 0 0 0 0 0 0", strlen("CONTROL 0 0 0 0 0 0 0 0 0"), 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not send data: [$errorcode] $errormsg \n");
}
$turns+=1;
}
*/

socket_close($sock);
?>