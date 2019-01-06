<!DOCTYPE html>
<html>
<head>
  <title>Benutzerauthentifizierung</title>
</head>
<body>


<form action="index.php?action=index" method="post">
  <input type="text" name="login" id ="name" placeholder="Name" />
  <input type="password" name="passwort" id="passwort" placeholder="Passwort" />
 <input type="submit" value="Abschicken">
</form>

</body>
</html>

<?php
require 'autoload.php';



if($_SERVER['REQUEST_METHOD'] == 'POST'){
 
		$benutzer = new Benutzer();
        $passwort = $benutzer->holePasswort();
	  
	    $auth = new Auth($db, 'index.php', $passwort);
        
}
?>



