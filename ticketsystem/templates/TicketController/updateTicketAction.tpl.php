<?php

$rang = intval($_GET['rang']);
$supporter = $_GET['supporter'];
?>

<ul>
   <li><a href="index.php?controller=ticket&action=zeigeAlleTickets">Alle Tickets anzeigen</a>
   </li>
</ul>
<?php
  $ticket->updateTicket();
  echo 'Ticket wurde gespeichert';
 
  


