<html>
<head>
<meta charset="utf-8">
</head>
<body>

<?php

	$supporter = $_GET['supporter'];
	$rang = intval($_GET['rang']);
?>
<ul>
	
		<a href="index.php?action=zeige&amp;rang=<?php echo $rang ?>&amp;supporter=<?php echo $supporter ?>">Startseite</a>
	
</ul>
<div id="formular">
		<form action="index.php?action=fügeNeuenKundenEin&amp;rang=<?php echo $rang;?>&amp;supporter=<?php echo $supporter; ?>" method="post">    
			<input type="text" name ="kunde" value="<?php echo htmlspecialchars($kunde); ?>" placeholder="Kundename"/>
			<input type="text" name ="telefon" value="<?php echo htmlspecialchars($telefon);?>" placeholder="Telefon"/>
			<input type="text" name="vip" value="<?php echo htmlspecialchars($vip);?>" placeholder="ja/nein" />
			<input type="submit" value=" Daten speichern" />	
		</form>
	</div>
	</body>
</html>


