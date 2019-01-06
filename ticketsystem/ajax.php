<?php


require_once 'src/Entities/Ticket.Class.php';
 
$rest = $_POST['rest'];
 echo $rest;  
 
 
 
 
 
 if($rest < 0) {
 $ticket = new Ticket();
 
 print_r($ticket->findeTicketId());
 $ticket->resetTicket();
 }
 
 

    
 