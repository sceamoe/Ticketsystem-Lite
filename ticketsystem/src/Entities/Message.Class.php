<?php

require_once 'autoload.php';

class Message extends Db  {
    
    private $message_id;
    private $message_zeit;
    private $inhalt;
    private $observers = array();
   
    
   
    
    public function attach(Observer $observer) {
        
        $this->observers[] = $observer;
       
    }
    
   
    public function detach(Observer $observer){
       for ($i=0; $i<sizeof($this->observers);$i++){
            if($this->observers[$i] === $observer){
                
                unset($this->observer[$i]);
            }
        }
    }
   
    
    
    public function notify(){
        for ($i=0; $i<sizeof($this->observers);$i++){
            $this->observers[$i]->update();
           
        }
    }
   
   
    
    
    public function leseMessage($latestID){
        if($latestID == null){
            $latestID = 0;
        }
        $db = Db::getInstance();
        $object = new Benutzer();
        $mitarbeiter_id = $object->populate()->mitarbeiter_id;
        
        $sql ='SELECT * FROM message 
                WHERE mitarbeiter_id_fk = :mitarbeiter_id 
                AND message_id > :latestID';
        
        $stmt = $db->prepare($sql);
        
        if(!$stmt){
            
            echo "\nPDO::errorInfo():\n";
        }
        
        $stmt->bindParam(':mitarbeiter_id', $mitarbeiter_id,PDO::PARAM_INT);
        $stmt->bindParam(':latestID', $latestID,PDO::PARAM_INT);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    
    
        
    
}