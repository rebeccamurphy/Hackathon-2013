/*
Information Gleaned from the Windows Tutorial on Socket Programming (Winsock)

* The difference b/t blocking and non-blocking circuits
    - blocking: old way
        - "oh, you didn't successfully perform the operation you wanted? No API for you!"
    - non-blocking: new way
        - "you didn't finish it, but my function will return as soon as possible, idgaf.
           I'll just send a message and it'll be k."

* Step-by-step
1) initialize the winstock library

               V-- highest version     V-- pointer to data struct that recieves details of implementation
int WSAStartup(WORD wVersionRequested, LPWSADATA lpWSAData);
int WSACleanup();

2) set up socket

3) close socket

---Definition for Byte Ordering---
Because protocols like TCP/IP have to work between different type of systems with different
type of byte ordering, the standard is that values are stored in big-endian format, also
called network byte order. For example, a port number (which is a 16-bit number) like 12345
(0x3039) is stored with its most significant byte first (ie. first 0x30, then 0x39). A
32-bit IP address is stored in the same way, each part of the IP number is stored in one byte,
and the first part is stored in the first byte. For example, 216.239.51.100 is stored as the
byte sequence '216,239,51,100', in that order.

4) sockaddr

5) 

*/

const int iReqWinsockVer = 2;   // Minimum winsock version required

WSADATA wsaData;

if (WSAStartup(MAKEWORD(iReqWinsockVer,0), &wsaData)==0) {

    // Check if major version is at least iReqWinsockVer
    if (LOBYTE(wsaData.wVersion) >= iReqWinsockVer) {
        /* ------- Call winsock functions here ------- */
    }
    else {
        // Required version not available
    }

    // Cleanup winsock
    if (WSACleanup()!=0) {
        // cleanup failed
    }
}
else {
    //  startup failed
}

//=======================================================================

SOCKET hSocket;

//       address family, type of socket, protocol
hSocket = socket(AF_INET, SOCK_STREAM, IPPROTO_TCP);

if (hSocket==INVALID_SOCKET) {
    // error handling code
}

//=======================================================================

closesocket(hSocket);

//=======================================================================

sockaddr_in sockAddr1, sockAddr2;

// Set address family
sockAddr1.sin_family = AF_INET;

/* Convert port number 80 to network byte order and assign it to
   the right structure member. */
sockAddr1.sin_port = htons(80);

/* inet_addr converts a string with an IP address in dotted format to
   a long value which is the IP in network byte order.
   sin_addr.S_un.S_addr specifies the long value in the address union */
sockAddr1.sin_addr.S_un.S_addr = inet_addr("127.0.0.1");

// Set address of sockAddr2 by setting the 4 byte parts:
sockAddr2.sin_addr.S_un.S_un_b.s_b1 = 127;
sockAddr2.sin_addr.S_un.S_un_b.s_b2 = 0;
sockAddr2.sin_addr.S_un.S_un_b.s_b3 = 0;
sockAddr2.sin_addr.S_un.S_un_b.s_b4 = 1;




















