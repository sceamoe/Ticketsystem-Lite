<html>
<meta charset="utf-8">
<head>

<link rel="stylesheet" href="style2.css" type="text/css" />
<head>
<body>


<p>
<?php
	
	


	$supporter = $_GET['supporter'];
	$rang = intval($_GET['rang']);
	echo '<a href="index.php?action=zeige&amp;rang='.$rang.'&amp;supporter='.$supporter.'">Startseite</a>';
?>

<div class ="ticket">
	<form action="index.php?controller=ticket&action=sucheTicket&amp;ticket_id=<?php echo $ticket_id ?>&amp;rang=<?php echo $rang ?>&amp;supporter=<?php  echo $supporter ?>" method="post">
		<input type="text" id="ticket" name="ticket_id" value="<?php htmlspecialchars($ticket_id) ?> " placeholder="Ticketnummer"/>
</div>
<div id="button">
		<input type="submit" value="Ticket suchen" />
</div>
	</form>
	

	
			
</body>
</html>	