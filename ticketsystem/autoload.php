<?php
spl_autoload_register(function($class_name){
	 
		require_once 'src/Entities/'.$class_name.'.Class.php';
        
    });
 