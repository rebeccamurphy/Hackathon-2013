/*
Information Gleaned from the Windows Tutorial on Socket Programming (Winsock)

* The difference b/t blocking and non-blocking circuits
    - blocking: old way
        - "oh, you didn't successfully perform the operation you wanted? No API for you!"
    - non-blocking: new way
        - "you didn't finish it, but my function will return as soon as possible, idgaf. I'll just send a message and it'll be k."

* Step-by-step
1) initialize the winstock library

               V-- highest version     V-- pointer to data struct that recieves details of implementation
int WSAStartup(WORD wVersionRequested, LPWSADATA lpWSAData);
int WSACleanup();

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

hSocket = socket(AF_INET, SOCK_STREAM, IPPROTO_TCP);

if (hSocket==INVALID_SOCKET) {
    // error handling code
}

//=======================================================================

























