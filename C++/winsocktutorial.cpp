/*
Information Gleaned from the Windows Tutorial on Socket Programming (Winsock)

* The difference b/t blocking and non-blocking circuits
    - blocking: old way
        - "oh, you didn't successfully perform the operation you wanted? No API for you!"
    - non-blocking: new way
        - "you didn't finish it, but my function will return as soon as possible, idgaf.
           I'll just send a message and it'll be k."

*** Things We Need (not necessarily in the right order) ***
1) initialize the winstock library

2) Set up socket

3) Close socket

---Definition for Byte Ordering---
Because protocols like TCP/IP have to work between different type of systems with different
type of byte ordering, the standard is that values are stored in big-endian format, also
called network byte order. For example, a port number (which is a 16-bit number) like 12345
(0x3039) is stored with its most significant byte first (ie. first 0x30, then 0x39). A
32-bit IP address is stored in the same way, each part of the IP number is stored in one byte,
and the first part is stored in the first byte. For example, 216.239.51.100 is stored as the
byte sequence '216,239,51,100', in that order.

4) sockaddr stuff

5) Connect the socket

6) Bind the socket (give it an address)

7) Listen for a reply

8) Accept

9) send and recv

*/

//=============================== initialize application and main ========================================

#include <iostream>

#define WIN32_MEAN_AND_LEAN
#include <winsock2.h>
#include <windows.h>

using namespace std;

class HRException
{
public:
    HRException() :
         m_pMessage("") {}
    virtual ~HRException() {}
    HRException(const char *pMessage) :
         m_pMessage(pMessage) {}
    const char * what() { return m_pMessage; }
private:
    const char *m_pMessage;
};

const int  REQ_WINSOCK_VER   = 2;   // Minimum winsock version required
const char DEF_SERVER_NAME[] = "www.google.com";
const int  SERVER_PORT       = 80;
const int  TEMP_BUFFER_SIZE  = 128;

const char HEAD_REQUEST_PART1[] =
{
    "HEAD / HTTP/1.1\r\n"           // Get root index from server
    "Host: "        // Specify host name used
};

const char HEAD_REQUEST_PART2[] =
{
    "\r\n"                          // End hostname header from part1
    "User-agent: HeadReqSample\r\n" // Specify user agent
    "Connection: close\r\n"         // Close connection after response
    "\r\n"                          // Empty line indicating end of request
};

// IP number typedef for IPv4
typedef unsigned long IPNumber;


int main(int argc, char* argv[]) {
    int iRet = 1;
    WSADATA wsaData;

    cout << "Initializing winsock... ";

    if (WSAStartup(MAKEWORD(REQ_WINSOCK_VER,0), &wsaData)==0) {
        
        // Check if major version is at least REQ_WINSOCK_VER
        if (LOBYTE(wsaData.wVersion) >= REQ_WINSOCK_VER) {
            cout << "initialized.\n";

            // Set default hostname:
            const char *pHostname = DEF_SERVER_NAME;

            // Set custom hostname if given on the commandline:
            if (argc > 1)
                pHostname = argv[1];

            iRet = !RequestHeaders(pHostname);
        } else {
            cerr << "required version not supported!";
        }

        cout << "Cleaning up winsock... ";

        // Cleanup winsock
        if (WSACleanup()!=0) {
            cerr << "cleanup failed!\n";
            iRet = 1;
        }
        cout << "done.\n";
    } else {
        cerr << "startup failed!\n";
    }
    
    return iRet;
}

//============================== creating socket =========================================

// Lookup hostname and fill sockaddr_in structure:
cout << "Looking up hostname " << pServername << "... ";
FillSockAddr(&sockAddr, pServername, SERVER_PORT);
cout << "found.\n";

// Create socket
cout << "Creating socket... ";
if ((hSocket = socket(AF_INET, SOCK_STREAM, IPPROTO_TCP)) == INVALID_SOCKET)
    throw HRException("could not create socket.");
cout << "created.\n";

if (hSocket!=INVALID_SOCKET)
    closesocket(hSocket);

//============================= connecting socket ========================================

// Connect to server
cout << "Attempting to connect to " << inet_ntoa(sockAddr.sin_addr)
     << ":" << SERVER_PORT <<  "... ";

if (connect(hSocket, reinterpret_cast<sockaddr*>(&sockAddr), sizeof(sockAddr))!=0)
    throw HRException("could not connect.");

cout << "connected.\n";

//============================== sending the request =====================================

cout << "Sending request... ";

// send request part 1
if (send(hSocket, HEAD_REQUEST_PART1, sizeof(HEAD_REQUEST_PART1)-1, 0)==SOCKET_ERROR)
    throw HRException("failed to send data.");

// send hostname
if (send(hSocket, pServername, lstrlen(pServername), 0)==SOCKET_ERROR)
    throw HRException("failed to send data.");

// send request part 2
if (send(hSocket, HEAD_REQUEST_PART2, sizeof(HEAD_REQUEST_PART2)-1, 0)==SOCKET_ERROR)
    throw HRException("failed to send data.");

cout << "request sent.\n";

//================================== receiving the reponse ===============================

cout << "Dumping received data...\n\n";
// Loop to print all data
while(true) {
    int retval;
    retval = recv(hSocket, tempBuffer, sizeof(tempBuffer)-1, 0);
    if (retval==0)
    {
        break; // Connection has been closed
    }
    else if (retval==SOCKET_ERROR)
    {
        throw HRException("socket error while receiving.");
    }
    else
    {
        // retval is number of bytes read
        // Terminate buffer with zero and print as string
        tempBuffer[retval] = 0;
        cout << tempBuffer;
    }
}

//=============================== request headers ========================================

/* Does these things
    Resolve the hostname to its IP.
    Create a socket.
    Connect the socket to the remote host.
    Send the HTTP request data.
    Receive data and print it until the other side closes the connection.
    Cleanup */

bool RequestHeaders(const char *pServername) {
    SOCKET      hSocket = INVALID_SOCKET;
    char        tempBuffer[TEMP_BUFFER_SIZE];
    sockaddr_in sockAddr = {0};
    bool        bSuccess = true;

    try {
        // code goes here
    }
    catch(HRException e) {
        cerr << "\nError: " << e.what() << endl;
        bSuccess = false;
    }

    return bSuccess;
}

//============================= find host ip ==========================================

IPNumber FindHostIP(const char *pServerName) {
    HOSTENT *pHostent;

    // Get hostent structure for hostname:
    if (!(pHostent = gethostbyname(pServerName)))
            throw HRException("could not resolve hostname.");

    // Extract primary IP address from hostent structure:
    if (pHostent->h_addr_list && pHostent->h_addr_list[0])
        return *reinterpret_cast<IPNumber*>(pHostent->h_addr_list[0]);

    return 0;
}

void FillSockAddr(sockaddr_in *pSockAddr, const char *pServerName, int portNumber) {
    // Set family, port and find IP
    pSockAddr->sin_family = AF_INET;
    pSockAddr->sin_port = htons(portNumber);
    pSockAddr->sin_addr.S_un.S_addr = FindHostIP(pServerName);
}



//============================ initialize library ===========================================

const int iReqWinsockVer = 2;   // Minimum winsock version required

WSADATA wsaData;

//             V-- highest version         V-- pointer to data struct that recieves details of implementation
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

//============================== set up =========================================

SOCKET hSocket;

//               address family, type of socket, protocol
hSocket = socket(AF_INET, SOCK_STREAM, IPPROTO_TCP);

if (hSocket==INVALID_SOCKET) {
    // error handling code
}

//=============================== close ========================================

closesocket(hSocket);

//================================== sockaddr =====================================

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

//============================== connect =========================================

/* This code assumes a socket has been created and its handle
is stored in a variable called hSocket*/

sockaddr_in sockAddr;

sockAddr.sin_family = AF_INET;
sockAddr.sin_port = htons(80);
sockAddr.sin_addr.S_un.S_addr = inet_addr("192.168.0.5"); // *** this is a test IP address ***

// Connect to the server
//          the socket, pointer with name of remote socket, size of pointed-to structure
if (connect(hSocket, (sockaddr*)(&sockAddr), sizeof(sockAddr))!=0)
{
    // error handling code
}

/* Note: the (sockaddr*) cast is necessary because connect requires a
   sockaddr type variable and the sockAddr variable is of the sockaddr_in
   type. It is safe to cast it since they have the same structure, but the
   compiler naturally sees them as different types.*/

//================================== bind =====================================

sockaddr_in sockAddr;

sockAddr.sin_family = AF_INET;
sockAddr.sin_port = htons(80);
sockAddr.sin_addr.S_un.S_addr = INADDR_ANY; // use default

// Bind socket to port 80
//       socket name, pointer with address to assign to socket, size of pointed-to structure
if (bind(hSocket, (sockaddr*)(&sockAddr), sizeof(sockAddr))!=0)
{
    // error handling code
}

//============================== listen =========================================

/* This code assumes the socket specified by
   hSocket is bound with the bind function */

//         bound, unconnectec socket, max length of pending-connections queue (default value)
if (listen(hSocket, SOMAXCONN)!=0) {
    // error handling code
}

//============================= accept ==========================================

sockaddr_in     remoteAddr;
int             iRemoteAddrLen;
SOCKET          hRemoteSocket;

iRemoteAddrLen = sizeof(remoteAddr);
//                     listening socket, pointer to buffer, pointer to length of prev. pointer's target
hRemoteSocket = accept(hSocket, (sockaddr*)&remoteAddr, &iRemoteAddrLen);

if (hRemoteSocket==INVALID_SOCKET) {
    // error handling code
}

//============================== send and recv =========================================
// THIS IS IN BLOCKING MODE

char buffer[128];

while(true) {
    // Receive data
    int bytesReceived = recv(hRemoteSocket, buffer, sizeof(buffer), 0);

    if (bytesReceived==0) { // connection closed 
        break;
    }
    else if (bytesReceived==SOCKET_ERROR) {
        // error handling code
    }

    // Send received data back
    if (send(hRemoteSocket, buffer, bytesReceived, 0)==SOCKET_ERROR)
    {
        // error handling code
    }
}







