<?php
@define(DATAFILE_TABLE_NAME, 'datafile');
@define(DATAFILE_DATEI_ID, 'datei_id');
@define(DATAFILE_TABLE_DATEI,'datei');
@define(DATAFILE_UPLOAD_TIME,'upload_time');
@define(DATAFILE_DATEI_NAME, 'datei_name');
@define(DATAFILE_FOREIGN_KEY,'ticket_id_fk');
class Datafile extends Model{

    protected $table_names = array(
      
        DATAFILE_TABLE_NAME
    );
    
    protected $table_properties = array(
        
        DATAFILE_DATEI_ID,
        DATAFILE_TABLE_DATEI,
        DATAFILE_DATEI_NAME,
        DATAFILE_UPLOAD_TIME,
        DATAFILE_FOREIGN_KEY
    );
    
    public function ladeDatafile() {
    
        $ticket_id = $_GET['ticket_id'];
        $model = new Model();
    
        $result = $model->select()->from(DATAFILE_TABLE_NAME)
        ->where(DATAFILE_FOREIGN_KEY, ':ticket_id')
        ->executeQuery(':ticket_id', $ticket_id )->as_array();
    
     
        return $result;
    
    }
    
    public function erzeugeBildDateiAusBinaercode(){
        
        $inhalt = $this->ladeDatafile();
        if(false !== $inhalt){
        foreach($inhalt as $post){
            $datei = base64_decode($post['datei']);
        }
        
       
        return $datei;
        } else {
            return false;
        }
    }
    
    
    
    
    //$db = Db::getInstance();
    
    /*$sql = 'SELECT * FROM datafile
     WHERE ticket_id_fk = :ticket_id';
     
     $stmt = $db->prepare($sql);
     
     if(!$stmt){
     echo "\nPDO::errorInfo():\n";
     }
     
     
     $stmt->bindParam(':ticket_id', $_GET['ticket_id'], PDO::PARAM_INT);
     $stmt->execute();
     $result = $stmt->fetch(PDO::FETCH_OBJ);
     
     return $result*/
    

}