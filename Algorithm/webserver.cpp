//Let's say we're deciding between transferring a client over to 
//another server, or turning a server on in his most local region
//Example: Tranferring client to EU from NA, or turning on NA server
//on webserver tier
//kill yourself pls
	

	
	
//let's assume that we got the information and it's parsed and stored
//in variables of some sort?	

	
	
	
class WebServer{
	protected: 
		int serverCost;
		int numTrans;
						
		
	public:
		WebServer(): serverCost(0), numTrans(0){}
		WebServer(int cost, int numT){
			serverCost = cost;
			numTrans = numT;
		}
		fillServer(int newTrans){
			numTrans += newTrans;
		}
		
		{
			
		}
		
		
