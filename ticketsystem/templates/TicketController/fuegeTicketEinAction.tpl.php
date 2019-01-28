<?php


$string = $_POST['name'];

echo '<a href="index.php?action=zeige">Startseite</a>';

if($_SERVER['REQUEST_METHOD'] != 'POST') {
		
		echo 'Das Formular wurde nicht abgeschickt!';
		
	} else {
		
		
		if( empty($_POST['kurzbeschreibung'])) 
		{
			echo "<p>Kurzbeschreibung ist nicht ausgefüllt, ";
		}
		
		
		if(empty($_POST['dringlichkeit']))
		{
			$_POST['dringlichkeit'] = $dringlichkeit;
			
				
		} 
		
		if(	empty($_POST['nachricht']))
		{
			echo "<p> Nachricht ist nicht ausgefüllt, ";
			
				
		} 
		
		if(	empty($_POST['kunde'])) 
		{
        	echo "<p> Namensfeld ist nicht ausgefüllt, ";		
		}
		
		
		 else {
	
			$ticket->fuegeBildPfadInDbEin();
			echo "Vielen Dank, sie haben folgendes Ticket erstellt: <p/>";
			echo 
			     "Kunde: " .htmlspecialchars($_POST['kunde']). "<br/>",
				 "Dinglichkeit: " .htmlspecialchars($_POST['dringlichkeit']). "<br/>",
				 "Kurzbeschreibung: ".htmlspecialchars($_POST['kurzbeschreibung']). "<br/>",
				 "Nachricht: ".htmlspecialchars($_POST['nachricht']). "<br/>";
			}
			
	}
	
	

    
	