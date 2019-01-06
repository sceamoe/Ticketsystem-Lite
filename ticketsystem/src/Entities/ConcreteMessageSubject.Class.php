<?php
require_once 'Message.Class.php';


class ConcreteMessageSubject extends Message{
    
    protected $state;
    
    public function getState(){
        
        return $this->state;
        
    }
    
    public function setState($state){
        $this->state = $state;
    }
    
    public function schreibNeueMessageInDb(){
        
        $db = Db::getInstance();
        
        $sql = 'SELECT MAX(message_id) from message';
        $stmt = $db->prepare($sql);
        
        if(!$stmt){
            echo "\n PDO::errorInfo():\n";
        }
        
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($result as $post) {
            $messageMaxId = $post['MAX(message_id)'];
        }
        
        $object = new Benutzer();
      
        var_dump($messageEmpfaengerId = $object->findeMessageEmpfaengerIdAusName());
        $messageAbsenderName = $object->populate()->name;
        
        $sql = 'INSERT INTO message SET
                inhalt = :inhalt,
                mitarbeiter_id_fk = :mitarbeiter_id,
                absender = :absender';
        
        $stmt = $db->prepare($sql);
        
        if(!$stmt){
            
            echo "\nPDO::errorInfo():\n";
        }
        
        $stmt->bindParam(':inhalt', $_POST['nachricht'],PDO::PARAM_STR);
        $stmt->bindParam(':mitarbeiter_id', $messageEmpfaengerId ,PDO::PARAM_INT);
        $stmt->bindParam(':absender',$messageAbsenderName, PDO::PARAM_STR);
        
        $stmt->execute();
        
        $newId = $db->lastInsertId();
        
        $count = $stmt->rowCount();
        echo '<br/><p>';
        
        
        print("Inserted $count message.\n <br/>");
        
        
        
        
           
            $this->notify();
            
        
        
        return $this->state;
        
    }
   
}