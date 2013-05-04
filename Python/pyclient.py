# TCP client example
import socket
client_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
client_socket.connect(("hackathon.hopto.org", 19012))

print "CONNECTED SUCCESSFULLY"

sendinit = raw_input ("Type INIT Guffaws: ")
client_socket.send(sendinit)

print sendinit

datainit = client_socket.recv(6) #should be ACCEPT

print datainit

sendrecd = raw_input ("TYPE RECD: ")
client_socket.send(sendrecd)

datarecd = client_socket.recv(14) #should be COSTS # # # #

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