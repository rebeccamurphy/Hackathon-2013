# TCP client example
import socket
client_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
client_socket.connect(("hackathon.hopto.org", 19012))
print "CONNECTED SUCCESSFULLY"

client_socket.send(b'INIT Guffaws')
print "Okay"

# Look for the response
#amount_received = 0
#amount_expected = 6
    
#while amount_received < amount_expected:
#    data = client_socket.recv(16)
#    amount_received += len(data)
#    print >>sys.stderr, 'received "%s"' % data

datainit = client_socket.recv(1024) #should be ACCEPT
print datainit

#===================================================================

client_socket.send("")
print "Okay"

datarecd = client_socket.recv(1024) #should be COSTS # # # #

print datarecd

while 1:
    data = client_socket.recv(1024)
    print "recieved?"
    if ( data == 'q' or data == 'Q'):
        client_socket.close()
        break;
    else:
        print "RECIEVED:" , data
        data = raw_input ( "SEND( TYPE q or Q to Quit):" )
        if (data <> 'Q' and data <> 'q'):
            client_socket.send(data)
        else:
            client_socket.send(data)
            client_socket.close()
            break;