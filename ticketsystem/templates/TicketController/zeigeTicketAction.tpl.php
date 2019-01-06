<?php

$rang = intval($_GET['rang']);
$supporter = $_GET['supporter'];

?>

<ul>
   <li><a href="index.php?action=zeige&amp;rang=<?php echo $rang ?>&amp;supporter=<?php echo $supporter ?>">Startseite</a>
   </li>
</ul>

<?php
  $inhalt = $ticket->zeigeTicket();
 
  foreach($inhalt as $nr => $post){
   
   $ticket_id[]          .= $post['ticket_id'];
   $kurzbeschreibung[]   .= $post['kurzbeschreibung'];
   $status[]             .= $post['status'];
   $dringlichkeit[]      .= $post['dringlichkeit'];
   $kunde[]              .= $post['kunde'];
  }
         
      echo 	'<div class="zeige">';
      echo  '<link rel="stylesheet" href="style.css" type="text/css" />',
			'<a href="index.php?controller=ticket&action=ladeTicket&amp;ticket_id='.$ticket_id[0].'&amp;rang='.$rang.'&amp;supporter='.$supporter.'">',
            '<table><thead>',
            '<tr>',
            '<th>Ticket_nr</th>',
            '<th>Kunde</th>',
			'<th>Dringlichkeit</th>',
            '<th>Kurzbeschreibung</th>',
            '<th>Status</th>',
            '</tr>',
            '</thead>';
     echo	'<tbody>',
			'<td>'.$ticket_id[0].'</td>',
			'<td>'.$kunde[0].'</td>',
			'<td>'.$dringlichkeit[0].'</td>',
			'<td>'.$kurzbeschreibung[0].'</td>',
			'<td>'.$status[0].'</td>',
			'</tbody>',
			'</table> ',
			'</a><br/>';
	echo 	'</div>';
