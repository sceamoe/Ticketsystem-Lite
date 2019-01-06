<?php
class Session {
    
    
    
    
    /*
     * Session Konstruktor
     * @access public
     */
    
    public function __construct(){
        session_start();
    }
    
    /*
     * Setzt eine Sessionvariable
     * @param string Name der Session
     * return void
     * @access public
     */
    public function setSessionName($name, $value){
        $_SESSION['name']= $value;
    }
    
    /*
     * Holt eine Sessionvaribale
     * @param string Name der Variable
     * return mixed
     */
    
    public function getSessionName($name){
        if(isset($_SESSION['name'])){
           
            return $_SESSION['name'];
        
        } else  {
        
            return false;
        }
    }
    
    /*
     * Löscht eine Sessionvariable
     * @param string Name der Varibalen
     * return void
     */
    
    public function deleteSession($name){
        unset($_SESSION['name']);
    }
    
    /*
     * Zerstört eine Sesssion insgesamt
     * return void
     */
    
    public function destroyCompleteSession(){
        $_SESSION = array();
        session_destroy();
    }
    
    
}