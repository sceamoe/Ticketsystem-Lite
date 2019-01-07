<?php
require_once 'autoload.php';
/*
 * Definitionen f�r Parameter f�r die Mitarbeiter-Klasse 
 * mit Atrributen aus der Datenbank-tabelle 'mitarbeiter'
 * und 'signup'
 */

// Tabelle Mitarbeiter
@define('USER_TABLE', 'mitarbeiter');
@define('USER_TABLE_LOGIN','login');
@define('USER_LOGIN_VAR', 'login');
@define('USER_TABLE_ID','mitarbeiter_id');
@define('USER_TABLE_PASSW','passwort');
@define('USER_TABLE_EMAIL','email');
@define('USER_TABLE_NAME','name');
@define('USER_TABLE_SIGN','signature');
@define('SIGNUP_TABLE_ID','signup_id');

//Tabelle permission
@define('PERM_TABLE','permission');
@define('PERM_TABLE_ID', 'permission_id');
@define('PERM_TABLE_NAME', 'name');

//Tabelle gruppen_mitarbeiter
@define('GRUPPEN_MITABEITER_TABLE', 'mitarbeiter_gruppen');
@define('GRUPPEN_MITARBEITER_TABLE_ID','mitarb_gruppen_id');
@define('GRUPPEN_MITARBEITER_TABLE_USER_ID_FK','mitarbeiter_id_fk');
@define('GRUPPEN_MITARBEITER_TABLE_GRUPPEN_ID_FK','gruppen_id_fk' );

//Tabelle gruppen_permission
@define('GRUPPEN_PERM_TABLE', 'gruppen_permission');
@define('GRUPPEN_PERM_TABLE_ID','gruppen_permission_id');
@define('GRUPPEN_PERM_TABLE_GRUPPEN_ID_FK','gruppen_id_fk');
@define('GRUPPEN_PERM_TABLE_PERM_ID_FK','permission_id_fk');

/*
 * Die eigentliche Klasse Benutzer, erbt von der Datenbank-abstraction-layer
 * zum Speichern von Informationen �ber den Benutzer, wie etwa seiner Rechte, 
 * abh�ngig von der Sessionvariablen
 * @access public
 * @package SPLIB
 */

class Benutzer extends Model {
    
 
   protected $table_properties = array(
       
       'mitarbeiter_id',
       'email',
       'name',
       'signature',
       'permissions',
       'session_handler',
       'loginVariable'
   );
   
   protected $table_names = array(
       
       USER_TABLE
   );
   
   
  /* public function __construct(){
       
       $this->populate();
   }*/
   
   public function populate(){
       
       
       
       $session = new Session();
       $this->loginVariable = $session->getSessionName(USER_LOGIN_VAR);
       
       $model = new Model();
       $result = $model->select(array(USER_TABLE_ID,
                            USER_TABLE_NAME,
                            USER_TABLE_SIGN
       ))->from(USER_TABLE)
       ->where(USER_TABLE_PASSW,':loginVariable')
       ->executeQuery(':loginVariable',$this->loginVariable)->as_object();
       
      
       if(null !== $result){
         
       return $result;
       } 
   }
   
   public function findeAngemeldeteBenutzer($data){
      
       $model = new Model();
       $this->session_handler = new MysqlSessionHandler();
       $sessionVariable = $this->session_handler->findeGespeicherteSessionVariablen();
       
       foreach($sessionVariable as $variable => $daten ){
       
                      
       $result[] = $model->select(USER_TABLE_NAME)->from(USER_TABLE)
       ->where(USER_PASSW_VAR,':data')->executeQuery(':data', $daten['data'])
       ->as_object();
       
       
      }
      
      return $result;
      
   }
   
   public function findeBenutzerId(){
       
       $session = new Session();
       $passwort = $session->getSessionName(USER_PASSW_VAR); 
       $model = new Model();
       
       $result = $model->select(USER_TABLE_ID)->from(USER_TABLE)
       ->where(USER_PASSW_VAR,':passwort')
       ->executeQuery(':passwort', $passwort)->as_object();
       
       return $result->mitarbeiter_id;
   }
   
   public function checkPermissions($permissions){
      
           $this->permissions = array();
           $model = new Model();
         
           $result = $this->populate();
           $mitarbeiterId = $result->mitarbeiter_id;
           
           
       $result = $model->select(PERM_TABLE_NAME)->from(array(
           GRUPPEN_MITABEITER_TABLE,
               GRUPPEN_PERM_TABLE,
               PERM_TABLE
           ))
           ->where(GRUPPEN_MITARBEITER_TABLE_USER_ID_FK,':mitarbeiter_id_fk')
           ->where(GRUPPEN_MITARBEITER_TABLE_GRUPPEN_ID_FK,'gruppen_id_fork')

           ->where(GRUPPEN_PERM_TABLE_GRUPPEN_ID_FK, PERM_TABLE_ID)
                     
     

           ->where(GRUPPEN_PERM_TABLE_GRUPPEN_ID_FK, 'permission_id')
           ->executeQuery(':mitarbeiter_id_fk',$mitarbeiterId)->as_object();           
    

       
       
           $permissions[] = $result->name;
                  
       
      return  $permissions;
     
     
    
   }
   /*
    *  Holt das Passwort-hash-tag aus der 
    *  Datenbank zum Vergleich mit dem Input-passwort
    */
  
      public  function holePasswort(){
    
            $model = new Model();

            $result = $model->select('passwort')->from(USER_TABLE)
            ->where('name', ':login')
            ->executeQuery(':login', $_POST[USER_TABLE_LOGIN])->as_object();
                        
           return $result->passwort;

		
   }
   
   /*
    * F�gt einen Datensatz in die Anmeldetabelle ein
    * @ param array enth�lt Benutzerdaten, siehe die Konstanten-
    * definitionen, die f�r die Array-Schl�ssel definiert wurden.
    * return boolean true bei Erfolg
    * @access public
    */
   
   public function fuegeBenutzerinDbHinzu(){
   
            $userDetail =array( 
            
            USER_TABLE_LOGIN  => $_POST['login'],
            USER_TABLE_NAME   => $_POST['name'],
           
                  
        );
        
        $login = 
            $userDetail[USER_TABLE_LOGIN];
        
        $passwort = 
        password_hash($_POST['passwort'], PASSWORD_DEFAULT);
	    
	    $name = 
	        $userDetail[USER_TABLE_NAME];
	    
	    $signature =
	        $userDetail[USER_TABLE_SIGN];
	   
	    $model = new Model();
	    
	    $result = $model->select()->from(USER_TABLE)
	    ->where(USER_TABLE_LOGIN,':login')
	    ->where(USER_TABLE_PASSW, ':passwort')
	    ->executeQuery(
	         array(
	        ':login',
	        ':passwort'
	       ),array(
	        $login,
	        $passwort
	    ))->as_array();
	    if($result !== false){   
	    foreach($result as $row){
	    if ($row->size()>0){
	        trigger_error('Unique username and and passwort required');
	        return false;
	       }
	    }
    }
	  
		
		$db = Db::getInstance();
		$model = new Model();
		$model->insert_into(USER_TABLE)
		->set(array(
		    USER_TABLE_LOGIN,
		    USER_TABLE_PASSW,
		    USER_TABLE_NAME,
		   
		),
		    array(
		   ':login',
		   ':passwort',
		   ':name',
		   
		    ))
		    ->executeQuery(array(
		        ':login',
		        ':passwort',
		        ':name',
		        
		    ),
		array(
		    $login,
		    $passwort,
		    $name,
		    
		          )  
		    );
		    
    	$newId = $db->lastInsertId();
		
    return true;	
  }

  public  function fuegeSupporterinDbHinzu() {
      
      $userDetail =array(
          
          USER_TABLE_LOGIN  => $_POST['login'],
          USER_TABLE_NAME   => $_POST['name'],
          
          USER_TABLE_SIGN   => $_POST['signature']
      );
      
      $login =
      $userDetail[USER_TABLE_LOGIN];
      
      $passwort =
      password_hash($_POST['passwort'], PASSWORD_DEFAULT);
      
      $name =
      $userDetail[USER_TABLE_NAME];
      
      $signature =
      $userDetail[USER_TABLE_SIGN];
      
      $model = new Model();
      
      $result = $model->select()->from(USER_TABLE)
      ->where(USER_TABLE_LOGIN,':login')
      ->where(USER_TABLE_PASSW, ':passwort')
      ->executeQuery(
          array(
              ':login',
              ':passwort'
          ),array(
              $login,
              $passwort
          ))->as_array();
          
          foreach($result as $row){
              if ($row->size()>0){
                  trigger_error('Unique username and and passwort required');
                  return false;
              }
          }
          
          
          
          $db = Db::getInstance();
          $model = new Model();
          $model->insert_into(USER_TABLE)
          ->set(array(
              USER_TABLE_LOGIN,
              USER_TABLE_PASSW,
              USER_TABLE_NAME,
              
          ),
              array(
                  ':login',
                  ':passwort',
                  ':name',
                  
              ))
              ->executeQuery(array(
                  ':login',
                  ':passwort',
                  ':name',
                  
              ),
                  array(
                      $login,
                      $passwort,
                      $name,
                      )
                  );
              
              $newId = $db->lastInsertId();
              
              return true;	
  }
	
	public function findeMitarbeiterFueTicketZuweisung() {
	 
	    $model = new Model();
	    $result = $model->select(USER_TABLE_NAME)->from(USER_TABLE)
	    ->executeQuery()->as_array();
	    
	    return $result;
		
	   	}
	   	
	   	public function findeSupporter($name){
	   	 
	   	    $model = new Model();
	   	    $result = $model->select('name')->from(USER_TABLE)
	   	    ->where('name','LIKE', 'name')->executeQuery(':name', '%'.$name.'%')->as_array();
	   	   
	   	    return $result;
	   	}
	   	
	   	
	
	
   
	
	
	
	
	    
	
	
}