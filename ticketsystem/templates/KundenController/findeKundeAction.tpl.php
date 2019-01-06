</html>
<head></head>
<body>


<?php

	$supporter = $_GET['supporter'];
	$rang = intval($_GET['rang']);
?>
<div class="neu">
		<a href="index.php?controller=kunden&action=neuerKunde">
		Neukunde
		</a>
</div>
<ul>
	
		<a href="index.php?action=zeige">Startseite</a>
	
</ul>
<?php

echo  '<link rel="stylesheet" href="style2.css" type="text/css" />';
	
	
	
 
	echo "Kundenliste:";	
 
	$result = $kunde->findeKunde();
	
	foreach($result as $nr => $post) {
		
		$kunden_id[$nr] .= $post['kunden_id'];
		$kundenName[$nr] .= $post['kunde'];
	
	
		echo 	'<ul>' ;
		echo	'<a href="index.php?controller=kunden&action=ladeKunde&amp;kunden_id='.$kunden_id[$nr].'&amp;rang='.$rang.'&amp;supporter='.$supporter.'">';
		echo  	($kundenName[$nr]);
		echo	'</a>',
		
				'</ul>';
	}
	
?>
	