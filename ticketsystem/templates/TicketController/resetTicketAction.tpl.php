<?php
 $rang = intval($_GET['rang']);
 $supporter = $_GET['supporter'];
 $ticket->resetTicket();
?>

<ul>
   <li><a href="index.php?action=zeige&amp;rang=<?php echo $rang ?>&amp;name=<?php echo $supporter ?>">Startseite</a>
   </li>
</ul>
<?php

if($rang == 1)
 {
  $inhalt = $ticket->zeigeTicket();
 
  foreach($inhalt as $nr => $post) 
 {
   
   $ticket_id = $post['ticket_id'];
   $beschreibe = $post['kurzbeschreibung'];
   $status = $post['status'];
   $kunde = $post['name'];  

 if($nr == 0) 
   {       
    
      echo  '<link rel="stylesheet" href="style.css" type="text/css" />',
            '<table><thead>',
            '<tr>',
            '<th>Ticket_nr</th>',
            '<th>Kunde</th>',
            '<th>Kurzbeschreibung</th>',
            '<th>Status</th>',
            '</tr>',
            '</thead>';
      echo  '<tbody>',
            '<td>'.$ticket_id.'</td>',
            '<td>'.$kunde.'</td>',
            '<td>'.$beschreibe.'</td>',
            '<td>'.$status.'</td>',
            '</tbody>',
            '</table> ';

  
       echo '<small>',
            '<a href="index.php?action=ladeTicket&amp;ticket_id='.$ticket_id.'&amp;rang='.$rang.'&amp;name='.$supporter.'">',
            'Bearbeiten',
            '</a></small>';
      }
   }  
}

  else if($rang == 2 || $rang == 3) 
 {
     $inhalt =  $ticket->zeigeAlleTickets();   // gibt ein mehrdimensionales Array zurück

      foreach($inhalt as $nr => $post)
    {
   
       $ticket_id = $post['ticket_id'];
       $beschreibe = $post['kurzbeschreibung'];
       $status = $post['status'];
       $kunde = $post['name'];         

      echo  '<link rel="stylesheet" href="style.css" type="text/css" />',
            '<table><thead>',
            '<tr>',
            '<th>Ticket_nr</th>',
            '<th>Kunde</th>',
            '<th>Kurzbeschreibung</th>',
            '<th>Status</th>',
            '</tr>',
            '</thead>';
      echo  '<tbody>',
            '<td>'.$ticket_id.'</td>',
            '<td>'.$kunde.'</td>',
            '<td>'.$beschreibe.'</td>',
            '<td>'.$status.'</td>',
            '</tbody>',
            '</table> ';

  
       echo '<small>',
            '<a href="index.php?action=ladeTicket&amp;ticket_id='.$ticket_id.'&amp;rang='.$rang.'&amp;name='.$supporter.'">',
            'Bearbeiten',
            '</a></small>';
  

     }

 }

 