<?php
echo  '<link rel="stylesheet" href="style2.css" type="text/css" />';
	


$benutzer = new Benutzer();
$result = $benutzer->checkPermissions($permissions);

foreach ($result as $row){

    $permission = $row;
}

if($permission == 'Supporter') {
 echo '<h2>Incident Managment</h2>',
      '<ul>', 
      '<a href="index.php?controller=ticket&action=zeigeTicket">Mir zugewiesen</a><p>',
	  '<a href="index.php?controller=ticket&action=erstelleTicket">Incident erstellen</a>',
	  '<a href="index.php?controller=ticket&action=findeTicket"></p>',
		'Ticket suchen',
		'</a>',
	  '<a href="index.php?controller=message&action=ladeMessageFormular"></p>',
	    'Message senden',
	    '</a>',
      '</ul>';

}

if($permission == 'Manager')
{
 echo '<h2> Manager Console </h2>';
 echo '<ul>',
      '<a href="index.php?controller=ticket&action=zeigeAlleTickets">Alle Tickets anzeigen</a><br /><p>',
	  
	  '<a href="index.php?controller=ticket&action=erstelleTicket">Incident erstellen</a><p>',
      
      '<a href="index.php?controller=ticket&action=lade">Supporter anlegen</a><br /><p>',
	  
	  '<a href="index.php?controller=ticket&action=findeTicket"></p>',
		'Ticket suchen',
		'</a>',
		
	  '<a href="index.php?controller=message&action=ladeMessageFormular"></p>',
	   'Message senden',
	   '</a>',
      '</ul>';
}

if($permission == 'Admin'){
 echo '<h2> Admin Console </h2>';
 echo '<ul>' ,
      
      '<a href="index.php?controller=benutzer&action=ladeFormularZumHinzufuegen">',
      'Supporter und Manager anlegen',
      '</a><br/><p>',

      
      '<a href="index.php?controller=ticket&action=zeigeAlleTickets">',
      'Alle Tickets anzeigen',
      '</a><br/><p>',

      
      '<a href="index.php?controller=logfile&action=getLogfile">',
      'Logfiles anzeigen',
      '</a><br/><p>',

	  
	  '<a href="index.php?controller=ticket&action=erstelleTicket">',
	  'Incident erstellen',
	  '</a><br/><p>',
	  
	  '<a href="index.php?controller=ticket&action=findeTicket">',
		'Ticket suchen',
		'</a><br/><p>',
	  
	  '<a href="index.php?controller=kunden&action=findeKunde">',
		'Kundenmanagement',
		'</a><br/><p>',
		
		'<a href="index.php?controller=message&action=ladeMessageFormular"></p>',
		'Message senden',
		'</a>',
      '</ul>';
 }

?>
