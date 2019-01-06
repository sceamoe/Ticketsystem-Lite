<?php
header('Content-Type: text/html; charset=utf-8'); // sorgt für die Codierung
header('Cache-Control: must-revalidate, pre-check=0, no-store, no-cache, max-age=0, post-check=0'); //  wegen IE
header('Content_Type: image/jpeg');

if(!empty($_GET['ticket_id'])){

  $ticket_id = intval($_GET['ticket_id']);
  

 $inhalt = $ticket->ladeTicket();
 $datafile = new Datafile();
 $result = $datafile->ladeDatafile();
 if(null !== $result){
    foreach($result as $posts){
         $datei_name = $posts['datei_name'];
    }
    $data = $datafile->erzeugeBildDateiAusBinaercode();
 }
  foreach($inhalt as $post)
  {
    
    $ticket_id        	= $post['ticket_id'];
    $nachricht        	= $post['nachricht'];
    $kunde            	= $post['kunde']; 
	$telefon		 	= $post['telefon'];
	$kurzbeschreibung 	= $post['kurzbeschreibung'];
	$loesung			= $post['loesung'];
  }
  

  
  
  $time = new Time();
  $time->setTicketZeit();
  $time->getTicketZeit();
  $time->setZeitJetzt();
  $time->setEnde();
  $ende = $time->getEnde();
   
  
 
		  
  ?>
<html>
	<head>
	<meta charset="utf-8">
	<style>
        
    </style>

		<script>
		
		function countdown() {
	window.setTimeout("countdown()", 1000);
	
	
	var jetzt ="<?php echo $ende; ?>";
	var a = new Date();
	var rest = Math.floor((jetzt-(a.getTime())/1000));

	var wochen = 0;
	var tage = 0;
	var stunden = 0;
	var minuten = 0;
	
	if (rest >= 604800) {
		wochen = Math.floor(rest/604800);
		rest -= wochen*604800;
	}
	
	if (rest >= 86400) {
		tage = Math.floor(rest/86400);
		rest -= tage*86400;
	}
	
	if (rest >= 3600) {
		stunden = Math.floor(rest/3600);
		rest -= stunden*3600;
	}
	
	if (rest >= 60) {
		minuten = Math.floor(rest/60);
		rest -= minuten*60;
	}
	
    document.getElementById('dc').innerHTML = stunden+' : ' +minuten+ ' : ';
	document.getElementById('dc_second').innerHTML = +rest;
  
    
	function ausblenden() {
		var aus = "Ihre Zeit ist abgelaufen!<br/>";
	     
	    if(rest >= 0) {
		  document.getElementById('formular').style.display = "block";
		  document.getElementById('link').style.display = "none";
		
		} else if (rest <0){
		  
		  document.getElementById('vorbei').innerHTML = aus ;
		  document.getElementById('formular').style.display = "none";
		  document.getElementById('timer').style.display = "none";
		  
		  document.getElementById('link').style.display = "block";
	 }
	}
    ausblenden();
	
	

	
	var request = false;

	// Request senden
	function setRequest(value) {
		// Request erzeugen
		if (window.XMLHttpRequest) {
			request = new XMLHttpRequest(); // Mozilla, Safari, Opera
		} else if (window.ActiveXObject) {
			try {
				request = new ActiveXObject('Msxml2.XMLHTTP'); // IE 5
			} catch (e) {
				try {
					request = new ActiveXObject('Microsoft.XMLHTTP'); // IE 6
				} catch (e) {}
			}
		}

		// überprüfen, ob Request erzeugt wurde
		if (!request) {
			alert("Kann keine XMLHTTP-Instanz erzeugen");
			return false;
		} else {
			var url="ajax.php";
			// Request öffnen
			request.open('post', url, true);
			// Requestheader senden
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			// Request senden
			request.send('rest='+value);
			//console.log(value);
			// Request auswerten
			request.onreadystatechange = interpretRequest;
			interpretRequest();
			
		}
	}

	// Request auswerten
	function interpretRequest() {
		switch (request.readyState) {
			// wenn der readyState 4 und der request.status 200 ist, dann ist alles korrekt gelaufen
			case 4:
				if (request.status != 200) {
					alert("Der Request wurde abgeschlossen, ist aber nicht OK\nFehler:"+request.status);
				} else {
					 var content = request.responseText;
					
					  //den Inhalt des Requests in das <div> schreiben
					  document.getElementById('content').innerHTML = content;
				}
				break;
			default:
				break;
		}
		// console.log(request.readyState);
	}
	
	setRequest(rest);
	
	
}

	</script>
	
	<link rel="stylesheet" href="style2.css" type="text/css" />	
	
	</head>
<body>
<body onload='countdown();'>


 <p>
 
 <div id="timer">
	  
	  <table class="tabBlock" align="center" cellspacing="0" cellpadding="0" border="0">
	 
	    <tr><td class="clock" id="dc"></td>
	        <td>
			  <table cellpadding="0" cellspacing="0" border="0">
			 
			  <tr><td class="clocklg" id="dc_second"></td></tr>
			  </table>
			</td>
		</tr>
	</table>
	  </div></p>

<div id ="formular">

<form action="index.php?controller=ticket&action=updateTicket&amp;ticket_id=<?php echo $ticket_id; ?>" method="post">
  <fieldset>
	<div class="name">
	    
	<input type="text" name ="kunde" value="<?php echo htmlspecialchars($kunde); ?>" onkeyup="setRequest(this.value)" autocomplete="off" placeholder="Kunde" />
		<?php echo $telefon ;?>	
		
	</div>
	
	<a rel="image" href="<?php echo $data; ?>"><?php echo $datei_name; ?></a>
	<p>	
	</p>
	<div class="dringlichkeit">
	Dringlichkeit:
	<p>	
		<?php 
		
			echo '<select name="dringlichkeit" size=3" >',
		    
			'<option value="niedrig">niedrig</option>',
			'<option value="erhöht">erhöht</option>',
			'<option value="kritisch">kritisch</option>',
  
			'</select>';
		
		
		?>
	</p>
	</div>
	<p>
	<div id="kürzel">
	
	<textarea  name="kurzbeschreibung"  value=<?php echo htmlentities($kurzbeschreibung); ?>" cols="100" placeholder="Kurzbeschreibung" ><?php echo trim($kurzbeschreibung, "\t."); ?>
	</textarea>
	
	</div>
	</p>
	
	<div id="nachricht">
	
	<textarea name="nachricht" value="<?php  echo htmlentities($nachricht) ?>" cols="100" rows ="10" placeholder="Arbeitshinweise"><?php echo trim($nachricht, "\t."); ?>
	</textarea>

	
	</div>

    <p>
	
	</p>
	<div id="lösung">
	<textarea name="lösung" value="<?php echo htmlentities($lösung) ?>" cols="100" rows ="5" placeholder="Lösung"><?php echo trim($lösung, "\t."); ?>
	</textarea>
	</div>
	</fieldset>
	
	<label for="submit"></label>
	<input type="submit" value="speichern" />

</form>


</div>

<div id ="vorbei"></div>
<div id ="link">
	<ul>
		<li>
			<a href="index.php?controller=ticket&action=zeigeTicket&amp;ticket_id=<?php echo $ticket_id ?>&amp;rang=<?php echo $rang ?>&amp;supporter=<?php echo $supporter ?>">
			Ticket neu laden</a>
		</li>
	</ul>
</div>
<div id="ticket_id"></div><div id="content"></div>
 </body>
 </html>
 
<?php




}
?>
  


 
     
  
  
