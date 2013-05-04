/* 	Head request example
 *  View with tabsize = 4
 *	Part of the Winsock networking tutorial by Thomas Bleeker
 *	Visit www.MadWizard.org
 */
#include <iostream>

#define WIN32_MEAN_AND_LEAN
#include <windows.h>

//#include <winsock2.h>

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

const int  REQ_WINSOCK_VER   = 2;	// Minimum winsock version required
const char DEF_SERVER_NAME[] = "www.google.com";
const int  SERVER_PORT       = 80;	
const int  TEMP_BUFFER_SIZE  = 128;

const char HEAD_REQUEST_PART1[] =
{
	"HEAD / HTTP/1.1\r\n" 			// Get root index from server
	"Host: "						// Specify host name used
};

const char HEAD_REQUEST_PART2[] =
{
	"\r\n"							// End hostname header from part1
	"User-agent: HeadReqSample\r\n" // Specify user agent
	"Connection: close\r\n" 		// Close connection after response
	"\r\n"							// Empty line indicating end of request
};

// IP number typedef for IPv4
typedef unsigned long IPNumber;

IPNumber FindHostIP(const char *pServerName)
{
	HOSTENT *pHostent;

	// Get hostent structure for hostname:
	if (!(pHostent = gethostbyname(pServerName)))
			throw HRException("could not resolve hostname.");
	
	// Extract primary IP address from hostent structure:
	if (pHostent->h_addr_list && pHostent->h_addr_list[0])
		return *reinterpret_cast<IPNumber*>(pHostent->h_addr_list[0]);
	
	return 0;
}

void FillSockAddr(sockaddr_in *pSockAddr, const char *pServerName, int portNumber)
{
	// Set family, port and find IP
	pSockAddr->sin_family = AF_INET;
	pSockAddr->sin_port = htons(portNumber);
	pSockAddr->sin_addr.S_un.S_addr = FindHostIP(pServerName);
}

bool RequestHeaders(const char *pServername)
{
	SOCKET 		hSocket = INVALID_SOCKET;
	char		tempBuffer[TEMP_BUFFER_SIZE];
	sockaddr_in	sockAddr = {0};
	bool		bSuccess = true;
	
	try
	{
		// Lookup hostname and fill sockaddr_in structure:
		cout << "Looking up hostname " << pServername << "... ";
		FillSockAddr(&sockAddr, pServername, SERVER_PORT);
		cout << "found.\n";
	
		// Create socket
		cout << "Creating socket... ";
		if ((hSocket = socket(AF_INET, SOCK_STREAM, IPPROTO_TCP)) == INVALID_SOCKET)
			throw HRException("could not create socket.");
		cout << "created.\n";
		
		// Connect to server
		cout << "Attempting to connect to " << inet_ntoa(sockAddr.sin_addr)
		     << ":" << SERVER_PORT <<  "... ";
		if (connect(hSocket, reinterpret_cast<sockaddr*>(&sockAddr), sizeof(sockAddr))!=0)
		    throw HRException("could not connect.");
		cout << "connected.\n";
		
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
		
		cout <<	"Dumping received data...\n\n";
		// Loop to print all data
		while(true)
		{
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
	}
	catch(HRException e)
	{
		cerr << "\nError: " << e.what() << endl;
		bSuccess = false; 
	}

	if (hSocket!=INVALID_SOCKET)
	{
		closesocket(hSocket);
	}
	return bSuccess;
}	

int main(int argc, char* argv[])
{
	int iRet = 1;
	WSADATA wsaData;

	cout << "Initializing winsock... ";

	if (WSAStartup(MAKEWORD(REQ_WINSOCK_VER,0), &wsaData)==0)
	{
		// Check if major version is at least REQ_WINSOCK_VER
		if (LOBYTE(wsaData.wVersion) >= REQ_WINSOCK_VER)
		{
			cout << "initialized.\n";
			
			// Set default hostname:
			const char *pHostname = DEF_SERVER_NAME;
			
			// Set custom hostname if given on the commandline:
			if (argc > 1)
				pHostname = argv[1];
				
			iRet = !RequestHeaders(pHostname);
		}
		else
		{
			cerr << "required version not supported!";
		}

		cout << "Cleaning up winsock... ";

		// Cleanup winsock
		if (WSACleanup()!=0)
		{
			cerr << "cleanup failed!\n";
			iRet = 1;
		}   
		cout << "done.\n";
	}
	else
	{
		cerr << "startup failed!\n";
	}
	return iRet;
}