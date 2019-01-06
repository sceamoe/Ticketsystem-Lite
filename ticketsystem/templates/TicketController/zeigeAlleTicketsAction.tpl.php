

<ul>
   <li><a href="index.php?action=zeige">Startseite</a>
   </li>
</ul>
<?php


 ($inhalt = $ticket->zeigeAlleTickets());

 foreach($inhalt as  $post){
   
   $ticket_id 			= $post['ticket_id'];
   $kunde				= $post['kunde'];
   $dringlichkeit      	= $post['dringlichkeit'];
   $_supporter			= $post['name']; 
   $kurzbeschreibung 	= $post['kurzbeschreibung'];
  
   $status 				= $post['status'];
           
    
      echo  '<link rel="stylesheet" href="style.css" type="text/css" />',
	  '<a href="index.php?controller=ticket&action=ladeTicket&amp;ticket_id='.$ticket_id.'">',
            '<table><thead>',
            '<tr>',
            '<th>Ticket_nr</th>',
            '<th>Kunde</th>',
			'<th>Dringlichkeit</th>',
			'<th>Zuletzt bearbeitet</th>',
            '<th>Kurzbeschreibung</th>',
			
            '<th>Status</th>',
            '</tr>',
            '</thead>';
      echo  '<tbody>',
            '<td>'.$ticket_id.'</td>',
            '<td>'.$kunde.'</td>',
			'<td>'.$dringlichkeit.'</td>',
			'<td>'.$_supporter.'</td>',
            '<td>'.$kurzbeschreibung.'</td>',
			
            '<td>'.$status.'</td>',
            '</tbody>',
            '</table> ';
			'</a>';
			
 
  
 
}
?>
