<?php
require'autoload.php';
@define('USER_LOGIN_VAR', 'login');
@define('USER_PASSW_VAR', 'passwort');
@define('USER_TABLE', 'mitarbeiter');
@define('USER_TABLE_LOGIN', 'login');
@define('USER_TABLE_PASSW', 'passwort');

class SessionAnalyser extends Db {
    
    private $sessions;
    private $session_handler;
    
    public function __construct(){
        $this->sessions =array();
        $this->session_handler = new MysqlSessionHandler();
    }
    
    public function erstelleWarteschlangeAusSessionDaten($sessionDaten){
         
        $this->sessions[] = $this->parseSessions($sesssionDaten);
    }
    
    public function fetch(){
        $session = each($this->sessions);
        if($session){
            return $session['value'];
        }
        else {
            reset($this->sessions);
            return False;
        }
    }
    
    
    
    private function parseSessions($sessionDaten){
     $benutzer = new Benutzer();
    
     $benutzerDaten = $benutzer->findeAngemeldeteBenutzer($data);
     
     if(null !== $benutzerDaten ){
        
         foreach($benutzerDaten as $membersOnline){
            
          $name[] .= $membersOnline->name;
        
        }
    
         return $name;
        }
    }
}

class SessionStore{}