<?php
require 'autoload.php';

@define(KUNDEN_TABLE_NAME, 'kunde');

class Kunden {
	
	
		
	protected $table_properties = array(
	    
	    'kunden_id',
	    'kunde',
	    'telefon',
	    'vip',
	    );
	
	protected $table_names = array(
	    
	    KUNDEN_TABLE_NAME
	);
	
	

  
  public function findeKunde() {
	  
	$db = Db::getInstance();
	  
	$sql = 'SELECT kunden_id, kunde FROM kunde ORDER BY kunde';
	  
	$stmt = $db->prepare($sql);
	$stmt->execute();
	  
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	 
	return $result;
  
  }
  
  public function ladeKunde() {
	  
	$db = Db::getInstance();
	
	$sql = 'SELECT kunden_id, kunde, telefon, vip FROM kunde 
			WHERE kunden_id = :kunden_id';
			
	$stmt = $db->prepare($sql);
	
	$stmt->bindParam(':kunden_id', $_GET['kunden_id'], PDO::PARAM_INT);
	$stmt->execute();
	
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	return $result;
  
  }
  
  public function updateKunde() {
	  
	try {
		$db =  Db::getInstance();
	    
		$kunden_id = intval($_GET['kunden_id']);
		
		$sql = 'UPDATE kunde SET kunde = :kunde,
							telefon = :telefon,
							vip = :vip
							WHERE kunden_id = :kunden_id';
	
		$stmt = $db->prepare($sql);
		
		if(!$stmt){
			echo "\nPDO::errorInfo():\n";
		}
		
		$stmt->bindParam(':kunde',		$_POST['kunde'], 	PDO::PARAM_STR);
		$stmt->bindParam(':telefon',	$_POST['telefon'], 	PDO::PARAM_STR);
		$stmt->bindParam(':vip',		$_POST['vip'],		PDO::PARAM_STR);
		$stmt->bindParam(':kunden_id',	$kunden_id,			PDO::PARAM_INT);
	
		$stmt->execute();
		
		$row = $stmt->rowCount();
	
		echo "<br/>Es wurden $row Zeilen aktualisiert.<br/>";
		 
		
	
	} catch(PDOException $e) {
    
			echo $e->getMessage();
     
	 }
  }
  
	public function fuegeNeuenKundenEin() {
	  
	  try {
		$db =  Db::getInstance();
		
		$sql ='INSERT INTO kunde SET 
							kunde = :kunde,
							telefon = :telefon,
							vip = :vip';
		
		$stmt = $db->prepare($sql);
		
		if(!$stmt){
			echo "\nPDO::errorInfo():\n";
		}
		
		$stmt->bindParam(':kunde',		$_POST['kunde'], 	PDO::PARAM_STR);
		$stmt->bindParam(':telefon',	$_POST['telefon'], 	PDO::PARAM_STR);
		$stmt->bindParam(':vip',		$_POST['vip'],		PDO::PARAM_STR);
		
		$stmt->execute();
		
		$newId = $db->lastInsertId();
		
		$count = $stmt->rowCount();
		echo '<br/>';
			print("Return number of rows that were inserted:\n");
			print("Inserted $count rows.\n <br/>");
	
		} catch(PDOException $e) {
    
			echo $e->getMessage();
     
		}
	}	
	
	public function loescheKundenDatensatz(){
	    
	    $model = new Model();
	    $model->delete()->from(KUNDEN_TABLE_NAME)->where('kunden_id',':kunden_id')
	    ->executeQuery(':kunden_id',$_GET['kunden_id'])->as_array();
	}
		

}