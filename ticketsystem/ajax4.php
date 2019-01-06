<?php
require_once 'autoload.php';

$name = $_GET['term'];

if (null !== $name) {
  
    $object = new Benutzer();
    $inhalt = $object->findeSupporter($name);
    
   
        
        echo json_encode($inhalt);
        
    
}

