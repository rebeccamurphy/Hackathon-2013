<?php
#!/usr/bin/php5

function do_send($message)
{
    if(!(socket_send ( $sock , $message , strlen($message) , 0)))
    {
        $errorcode = socket_last_error();
        $errormsg = socket_strerror($errorcode);
        
        die("Could not send data: [$errorcode] $errormsg \n");
    }
}

function do_receive()
{
    if(socket_recv ( $sock , $buf , strlen($buf) , MSG_PEEK ) === FALSE)
    {
        $errorcode = socket_last_error();
        $errormsg = socket_strerror($errorcode);
     
        die("Could not receive data: [$errorcode] $errormsg \n");
    } else {
        return $buf;
    }
}

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
do_send("INIT Guffaws");

echo "Message send successfully \n";
 
//Now receive reply from server
do_receive();

do_send("RECD");
 
echo "Message send successfully \n";
 
//Now receive reply from server
do_receive();
 
//print the received message
echo strlen($buf);
    
do_send("START");
 
echo "Message send successfully \n";
 
//Now receive reply from server
do_receive();
 
//print the received message
echo $buf;

do_send("RECD");
 
echo "Message send successfully \n";
 
//Now receive reply from server
do_receive();



socket_close($sock);
?>