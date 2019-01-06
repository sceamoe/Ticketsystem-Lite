<?php
	
function setObjektNameAusKlassenName(){
		
		$controller = ucfirst(isset($_GET['controller']) ? $_GET['controller'] : 'benutzer');
		$klassenName = $controller;
	    $objekt = new $klassenName();
		
		return $objekt;
	}
