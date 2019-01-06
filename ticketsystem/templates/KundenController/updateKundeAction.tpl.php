<?php

	echo  '<link rel="stylesheet" href="style2.css" type="text/css" />';
	
	$kunde->updateKunde();
	
	
	$supporter = $_GET['supporter'];
	$rang = intval($_GET['rang']);
	$kunden_id = intval($_GET['kunden_id']);
	
	if(!empty($_GET['kunden_id'])){
	
		$inhalt = $kunde->ladeKunde();
	
		foreach($inhalt as $post) {
			
			$kunde 		= $post['kunde'];
			$telefon	= $post['telefon'];
			$vip		= $post['vip'];
		
	}
	
		echo "Name:  $kunde Telefon: $telefon VIP: $vip<br/><p>"; 
	
		echo '<a href="index.php?controller=kunden&action=findeKunde&amp;rang='.$rang.'&amp;supporter='.$supporter.'">',
			'Zurück zur Kundenübersicht',
			'</a></p>';
	}
	
	else {
		
			echo   "Keine Kunden-ID übermittelt.";
	
	}