<?php
echo  '<link rel="stylesheet" href="style2.css" type="text/css" />';
	
	
	$supporter = $_GET['supporter'];
	$rang = intval($_GET['rang']);
	$kunden_id = intval($_GET['kunden_id']);

if(!empty($_GET['kunden_id'])){
	
	$inhalt = $kunde->ladeKunde();
	
	foreach($inhalt as $post) {
		
		$kunden_id 	= $post['kunden_id'];
		$kunde 		= $post['kunde'];
		$telefon	= $post['telefon'];
		$vip		= $post['vip'];
		
	}
	
	  ?>
<html>
	<head>
	<meta charset="utf-8">
	</head>
	<body>
	
	<div id="formular">
		<form action="index.php?controller=kunden&action=updateKunde&amp;kunden_id=<?php echo $kunden_id; ?> &amp;rang=<?php echo $rang;?>&amp;supporter=<?php echo $supporter; ?>" method="post">    
			<input type="text" name ="kunde" value="<?php echo htmlspecialchars($kunde); ?>"/>
			<input type="text" name ="telefon" value="<?php echo htmlspecialchars($telefon);?>"/>
			<input type="text" name="vip" value="<?php echo htmlspecialchars($vip);?>"/>
			<input type="submit" value=" Daten speichern" />
			<a href="index.php?controller=kunden&action=loescheKundenDatensatz&amp;kunden_id=<?php echo $kunden_id?>">Datensatz löschen</a>
		</form>
	</div>
	</body>
</html>

<?php

}

