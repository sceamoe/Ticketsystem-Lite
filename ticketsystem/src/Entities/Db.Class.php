<?php

abstract class Db {
	
	
	 private static $instance = NULL;
	  
	  
	  public static function getInstance(){
   
   
		if(!isset(self::$instance)){
			try  { 
						self::$instance = new PDO('mysql:host=localhost;dbname=ticket','root','',
                             array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
   
						self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						self::$instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			}  catch(PDOException $e) {
         
				echo "Keine Verbindung zur Datenbank möglich: %s" ,$e->getMessage();

			}

		}
			return self::$instance;
 
  }
 
 
  
}