<!DOCTYPE html>

<head> 
  <title>Benutzer anlegen</title>
</head>
<body>

<?php
 

 
 if(isset($_GET['register'])) {
 
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
<form action="index.php?controller=benutzer&action=fuegeBenutzerinDbHinzu" method="post">
 <input type="text" name="login" placeholder="Ihr username"/>
 <input type ="text" name="name" placeholder="Name" />
 <input type ="password" name="passwort" placeholder="Passwort" />
 <input type ="password" name="passwort2" placeholder="Passwort wiederholen" />
 <input type ="text" name="gruppe" placeholder="GruppenName">
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
