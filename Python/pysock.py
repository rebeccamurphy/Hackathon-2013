#!/usr/bin/env python

"""
A simple echo client that handles some exceptions
"""

import socket
import sys

host = 'hackathon.hopto.org'
port = 19012
size = 5
s = None
try:
    s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    s.connect((host,port))
except socket.error, (value,message):
    if s:
        s.close()
    print "Could not open socket: " + message
    sys.exit(1)
s.send('INIT Guffaws')
data = s.recv(size) #runs forever once it reaches here. probably a size issue
s.close()
print 'Received:', data