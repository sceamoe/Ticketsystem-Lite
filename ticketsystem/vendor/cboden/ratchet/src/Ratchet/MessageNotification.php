<?php
namespace Ratchet;


//use Rachet\MessageComponentInterface;
use Ratchet\ConnectionInterface;




class MessageNotification implements \Ratchet\MessageComponentInterface {
   
    protected $clients;
    
    public function __construct(){
        
        $this->clients = new \SplObjectStorage;
    }
    
    public function onOpen(ConnectionInterface $conn) {
       
       $this->clients->attach($conn);
       
       echo "New Connection! ({$conn->resourceId})\n";
    }
    
    public function onMessage(ConnectionInterface $from, $msg) {
      
        $numRecv = count($this->clients) -1;
        echo sprintf('Connection %d sending message "%s" to %d other connections'."\n"
        ,$from->resourceId, $msg, $numRecv, $numRecv ==1 ? '':'s');
        
        foreach($this->clients as $client){
            if($from!==$client){
                $client->send($msg);
            }
        }
    }
    
    public function onClose(ConnectionInterface $conn) {
      
        $this->clients->detach($conn);
    }
    
    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        
        $conn->close();
    }
}