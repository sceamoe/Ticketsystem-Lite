<?php
@define('SESSION_TABLE_NAME','php_session');
@define('SESSION_TABLE_ID','session_id');
@define('SESSION_START_TIME', 'last_active');
@define('SESSION_NAME_VAR', 'data');
@define('SESSION_FORKEY','mitarbeiter_id_fk');

@define('USER_TABLE', 'mitarbeiter');
@define('USER_TABLE_PASSW','passwort');
require 'autoload.php';

class MysqlSessionHandler extends Model{
    
    protected $table_properties = array(
        
        'session_id',
        'aktivitätsZeitpunk',
        'data',
        'mitarbeiter_id_fk',
        'permissions',
        'session_handler',
        'db',
    );
    
    protected $table_names = array(
        
        SESSION_TABLE_NAME
 
        
    );
    
    private $result;
   
    
    public function __construct(){
        $this->session_id = $session_id;
        $this->aktivitätsZeitpunkt = $aktivitätsZeitpunkt;
        $this->mitarbeiter_id_fk = $mitarbeiter_id_fk;
        
    }
    
    public function findeSessionId(){
        
            $object = new Benutzer();
            $mitarbeiter_id = $object->populate()->mitarbeiter_id;
            
            try{
                $model = new Model();
                $this->result = $model->select(SESSION_TABLE_ID)
                    ->from(SESSION_TABLE_NAME)
                    ->join(USER_TABLE)
                    ->on('mitarbeiter.passwort',
                        'php_session.data')
                    ->where(SESSION_NAME_VAR,USER_TABLE_PASSW)
                    ->where(SESSION_FORKEY,USER_TABLE_ID)
                    ->executeQuery(USER_TABLE_ID,$mitarbeiter_id)
                    ->as_object();
        
                    return $this->result;
        
             } catch(PDOException $e){
        
            echo "Session_id konnte nicht ermittelt werden" , $e->getMessage(); 
        }
    }
    
    public function deleteSessionRanOff(){
        
        try{
       
            
            
            $session_id = $this->findeSessionId()->session_id;
            $model = new Model();
            return $model->delete()->from(SESSION_TABLE_NAME)
            ->where(SESSION_TABLE_ID,':session_id')
            ->executeQuery(':session_id',$session_id);
            
            
            } catch (PDOException $e){
                echo "SEssion konnte nicht gelöscht werden", $e->getMessage();
            }
            
    }
    
    public function leseSessionDatenAus($session_id){
        try{
           
            $session_id = $this->findeSessionId()->session_id;
            $model = new Model();
            $this->result = $model->select(array(
                SESSION_NAME_VAR,
                SESSION_START_TIME
            ))->from(SESSION_TABLE_NAME)->where(SESSION_TABLE_ID,':session_id')
            ->executeQuery(':session_id', $session_id)->as_object();
            
            
        
            return $this->result;
        
        } catch (PDOException $e){
            echo "Daten aus Tabelle php_session konnten nicht ausgelesen werden.", $e->getMessage();
        }
    }
    
    public function schreibeNeueSessionDaten($data){
        try{
            $db = Db::getInstance();
            
            $benutzer = new Benutzer();
            $mitarbeiter_id_fk = $benutzer->populate()->mitarbeiter_id;
            
            $session = new Session();
            $data = $session->getSessionName(USER_LOGIN_VAR);
            $sql="REPLACE INTO
                       
                        ".SESSION_TABLE_NAME." 
                SET
                        ".SESSION_NAME_VAR."=:data,

                        ".SESSION_FORKEY."=:mitarbeiter_id_fk";
        
            $stmt=$db->prepare($sql);
        
            if(!$stmt){
             echo"\nPDP::errorInfo()\n";
              }
        
            $stmt->bindParam(':mitarbeiter_id_fk', $mitarbeiter_id_fk, PDO::PARAM_INT);
            $stmt->bindParam(':data', $data, PDO::PARAM_STR);
            $stmt->execute();
        
            $newId = $db->lastInsertId();
        
            $count = $stmt->rowCount();
            echo '<br/><p>';
        
           
            print("$count Session registered.\n <br/>");
         
        }
            catch (PDOException $e){
            echo "Ein Datenbankfehler ist aufgetreten", $e->getMessage();
        }
    }
        
        public function löscheSessionAusDb($session_id){
            try{
                
                $db = Db::getInstance();
                $session_id = $this->findeSessionId()->session_id;
                
                $sql = "DELETE FROM "
                            .SESSION_TABLE_NAME.
                        " WHERE "
                            .SESSION_TABLE_ID." =:session_id";
                
                            $stmt=$db->prepare($sql);
                            
                if(!$stmt){
                echo"\nPDO::errorInfo()\n";
                }
            
               $stmt->bindParam(':session_id', $session_id, PDO::PARAM_INT);
               $stmt->execute();
            
            }catch (PDOException $e){
                echo "Session konnte nicht gelöscht werden", $e->getMessage();
            }
        }
        
        public function findeGespeicherteSessionVariablen(){
            
            $db=Db::getInstance();
           
            
           $sql = " SELECT "
                
                .SESSION_NAME_VAR.
                
                 " FROM "
                    
                    .SESSION_TABLE_NAME.";";
                    
             
             $stmt=$db->prepare($sql);
                            
             if(!$stmt){
             
                     echo "\nPDO::errorInfo()\n";
                }
                         
            
             $stmt->execute();
             
             $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
             
             
             
             return $result;
            
        }
    
    
    
}