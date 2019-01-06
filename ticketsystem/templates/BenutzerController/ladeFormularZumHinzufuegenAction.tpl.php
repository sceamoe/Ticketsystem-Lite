<DOCTYPE html>
<hmtl>
<head> 
  <title>Benutzer anlegen</title>
</head>
<body>

<?php
 $supporter = $_GET['supporter'];
 $rang= intval($_GET['rang']);

 
 if(isset($_GET['register'])) {
  $name      = $_POST['name'];
  $passwort = $_POST['passwort'];
  $passwort2= $_POST['passwort2'];
 
  
 if(strlen($passwort == 0)) {
  echo 'Bitte Name, Passwort und Rang eingeben<br>';
  $error = true;
  }

  if($passwort != $passwort2) {
  echo 'Die Passwörter müssen übereinstimmen<br>';
  $error=true;
  }
   
}

?>
<form action="index.php?controller=benutzer&action=fuegeBenutzerinDbHinzu&amp;rang=<?php echo $rang ?>&amp;name=<?php echo $supporter?>" method="post">
 <input type="text" name="login" value="<?php htmlentities($login) ?>" placeholder="Ihr username"/>
 <input type ="text" name="name" value="<?php htmlentities($name)?>" placeholder="Name" />
 <input type ="password" name="passwort" value="<?php htmlentities($passwort)?>" placeholder="Passwort" />
 <input type ="password" name="passwort2" value="<?php htmlentities($passwort2)?>" placeholder="Passwort wiederholen" />
 <input type ="text" name="email" value="<?php htmlentities($email) ?>" placeholder="Email" />
 <textarea rows="5" cols="10" name="signature" value="<?php htmlentities($signature)?>" placeholder="Ihre Signatur"></textarea>
 <input type="submit" value="Abschicken" />
 </form>
 <ul>
   <li><a href="index.php?action=zeige&amp;rang=<?php echo $rang ?>&amp;name=<?php echo $name ?>">Startseite</a>
   </li>
</ul>
<?php 
  
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	  echo 'Formular wurde nicht abgeschickt!';
  } else {
	  echo ' Formular wurde abgeschickt. ';
  }

?>

</body>
</html>
