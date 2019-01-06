<?php
require 'src/Entities/Ticket.Class.php';
$ticket_nr = $_POST['ticket_nr'];


$ticket = new Ticket;
$inhalt = $ticket->sucheTicket($ticket_nr);

foreach($inhalt as $nr => $post){
   
				$ticket_id          = $post['ticket_id'];
				$kurzbeschreibung   = $post['kurzbeschreibung'];
				$status             = $post['status'];
				$nachricht			= $post['nachricht'];
				$dringlichkeit      = $post['dringlichkeit'];
				$kunde              = $post['kunde'];
				$_supporter			= $post['name'];
				
	
}

 if(!$inhalt) {
		
			echo "Ticket Nr $ticket_nr nicht gefunden.";
		} else {
		
				
			echo 	'<div class="zeige">';
			echo  	'<link rel="stylesheet" href="style.css" type="text/css" />',
					
					'<table><thead>',
					'<tr>',
					'<th>Ticket_nr</th>',
					'<th>Zuletzt bearbeitet</th>',
					'<th>Kunde</th>',
					'<th>Dringlichkeit</th>',
					'<th>Kurzbeschreibung</th>',
					'<th>Nachricht</th>',
					'<th>Status</th>',
					'</tr>',
					'</thead>';
			echo	'<tbody>',
					'<td>'.$ticket_id.'</td>',
					'<td>'.$_supporter.'</td>',
					'<td>'.$kunde.'</td>',
					'<td>'.$dringlichkeit.'</td>',
					'<td>'.$kurzbeschreibung.'</td>',
					'<td>'.$nachricht.'</td>',
					'<td>'.$status.'</td>',
					'</tbody>',
					'</table> ',
					'<br/>';
					
			echo 	'</div>';
		
		}
	?>