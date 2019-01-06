<?php
require_once 'Observer.Class.php';


class ConcreteMessageObserver extends Observer {
    
    private $state;
    
    public function __construct(Message $message){
            $this->attach($message);
      
        
    }
    
    public function update(){
        
      
            $this->message->setState('1 Neue Nachricht');
            $this->state = $this->message->getState();
         
    }
}