<?php
require_once 'Message.Class.php';

abstract class Observer {

        protected $message;

        public function attach(Message $message){
            $this->message = $message;
            $this->message->attach($this);
        }

        public function detach() {
            if($this->message !== NULL){
              $this->message->detach($this);
            }
        }
        
        public abstract function update();
}