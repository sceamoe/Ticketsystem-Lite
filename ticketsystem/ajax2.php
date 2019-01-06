<?php
require_once 'autoload.php';

$string = $_GET['term'];

if(null !== $string ){
$ticket = new Ticket();
$inhalt = $ticket->findeNameImTicketFormularAusString($string);
	
	
		
		echo (json_encode($inhalt));
		
}
	
   
					