<?php
require 'autoload.php';;

@define('USER_LOGIN_VAR', 'login');
@define('USER_PASSW_VAR', 'passwort');
@define('USER_TABLE', 'mitarbeiter');
@define('USER_TABLE_LOGIN', 'login');
@define('USER_TABLE_PASSW', 'passwort');

class Auth extends Model{
    protected $table_properties = array(
        
        'db',
        'session',
        'session_handler',
        'redirect',
        'hashKey',
        'bicrypt'
    );
    
    protected $table_names = array(
        
        USER_TABLE
    );
    
    
    
    public function __construct($db, $redirect, $hashKey, $bicrypt = true){
        $this->db        = Db::getInstance();
        $this->redirect  = $redirect;
        $this->hashKey   = $hashKey;
        $this->bicrypt   = $bicrypt;
        $this->session   = new Session();
        $this->session_handler = new MysqlSessionHandler();
        $this->login();
    }
    
    /*
     * Pr�ft Benutzername und Passwort gegen die Datenbank
     * return void
     * @access private
     */
    private function login(){
        
        if($this->session->getSessionName('login_hash')){
            $this->�berpr�feAuthentication();
            return;
        }
        
        $benutzer = new Benutzer();
        $passwort= $benutzer->holePasswort();
       
        
        if(password_verify($_POST[USER_TABLE_PASSW], $passwort))
        {
                        
   
        $login =$_POST[USER_LOGIN_VAR];
       
       
       
        $model = new Model();
        

        $result = $model->select(SQL_COMMAND_COUNT)->from(USER_TABLE)
        ->where(USER_TABLE_NAME,':login')->where(USER_TABLE_PASSW,':passwort')
        ->executeQuery(
            array(
            ':login',
            ':passwort'                
        ),
            array($login,
                  $passwort
            )
            )->as_object();
            
           
       if($result->num_users !== 1){
           
           
            $this->redirect();
        
        } else {
        
             $this->speichereSession($login, $passwort);
            
             echo 'Ihr Login war erfolgreich';
             echo '<a href="index.php?action=zeige">Weiter</a>';
             
        }
        
        
      }
      
    }
    
    /*
     * Setzt die SessionVariable nach erfolgreichem Login
     * @return void
     * @access protected
     */
    
    protected function speichereSession($login, $passwort){
        
        $this->session->setSessionName(USER_LOGIN_VAR, $login);
        $this->session->setSessionName(USER_PASSW_VAR, $passwort);
        $data = $this->session->setSessionName('login_hash', $passwort);
        $this->session_handler->schreibeNeueSessionDaten($data);
        
    }
    
    /*
     * Best�tigt, ob ein bestehender Login noch g�ltig ist.
     * return void
     * @access private
     */
    
    private function �berpr�feAuthentication(){
        
        $login = $this->session->getSessionName(USER_LOGIN_VAR);
        $passwort = $this->session->getSessionName(USER_PASSW_VAR);
        $hashKey = $this->session->getSessionName('login_hash');
        
        if($passwort !== $hashKey ){
            echo 'logout';
            $this->logout(true);
            
        }
         echo 'Auth::confirmAuth()';
         echo '<a href="index.php?action=zeige">Weiter</a>';      
        
        
    }
    
    /*
     * Meldet den Benutzer ab
     * @access public
     */
    
    public function logout($from  = false){
        
        $this->session->deleteSession(USER_LOGIN_VAR);
        $this->session->deleteSession(USER_PASSW_VAR);
        $this->session->deleteSession('login_hash');
        
      
        
        $this->redirect($from);
       
      
    }
    
    /*
     * Leitet den Browser um und beendet die Ausf�hrung des Scripts
     * @ param boolean die URL, von der dieser Benutzer kam
     */

    private function redirect($from = true){
        
        if($from){
            header('Location:'. $this->redirect.'?from'.
                $_SERVER['REQUEST_URI']);
        } else {
            header('Location:'.$this->redirect);
        
        }
        echo 'Auth::redirect()';
        exit();
    }


}