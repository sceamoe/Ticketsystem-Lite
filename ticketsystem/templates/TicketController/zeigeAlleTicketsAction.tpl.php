

<ul>
   <li><a href="index.php?action=zeige">Startseite</a>
   </li>
</ul>
<?php


 ($inhalt = $ticket->zeigeAlleTickets());

 
   
  
           
    echo '<div class="ticket">';
      echo  '<link rel="stylesheet" href="style.css" type="text/css" />',
	 
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
    
            foreach($inhalt as  $post){
      echo  '<tbody>',
            '<td><a href="index.php?controller=ticket&action=ladeTicket&amp;ticket_id='.$post['ticket_id'].'">'.$post['ticket_id'].'</td></a>',
            '<td>'.$post['kunde'].'</td>',
			'<td>'.$post['dringlichkeit'].'</td>',
			'<td>'.$post['name'].'</td>',
            '<td>'.$post['kurzbeschreibung'].'</td>',
			
            '<td>'.$post['status'].'</td>',
            '</tbody>';
            
		
			
 
  
 
}
echo '</table> ';
echo '</div>'
?>
