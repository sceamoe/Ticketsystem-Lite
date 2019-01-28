<html>
<meta charset="utf-8">
<head>
<title id='title'></title>
<link rel="stylesheet" href="style2.css" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<head>
<body>
<h2> Incident Request </h2>

<p>
<?php
	
	header('Content-Type: text/html; charset=utf-8'); // sorgt für die Codierung
	header('Cache-Control: must-revalidate, pre-check=0, no-store, no-cache, max-age=0, post-check=0');

	
	echo '<ul>';
	echo '<a href="index.php?action=zeige&amp">Startseite</a>';
	echo '</ul>';
?>

<?php

		function show_form() {
		
		
		 ?>
	<div id="formular">
	<form name="f" 
	action="index.php?controller=ticket&action=fuegeTicketEin" enctype="multipart/form-data" method="post">
	
	<fieldset>
	
	
	<script >
	$( function() {			 
	    $( "#kunde" ).autocomplete({
	      source: "ajax2.php",
	      minLength: 2,
	      
	      focus: function( event, ui ) {
	          $( "#kunde" ).val( ui.item.kunde );
	          return false;
	        },
	      select: function( event, ui ) {
		      event.preventDefault();
			  $( "#kunde" ).val( ui.item.kunde );
		      
		      
	      }
	    })
	    .autocomplete( "instance" )._renderItem = function( ul, item ) {
	        return $( "<li>" )
	          .append( "<div>" + item.kunde + "</div>" )
	          .appendTo(ul);
	      };
	  } );
	  </script>
		<div class="ui-widget">
			<input 
			type="text" 
			id="kunde" 
			name ="kunde" 
			placeholder="Kunde">
			
		</div>
	<p></p>
	<div class ="ticket">
			<a href="index.php?action=findeTicket&amp;rang=<?php  echo $rang ?>&amp;supporter=<?php echo $supporter ?>">
			Ticket suchen
			</a>
	</div><br/>
	<p>	
	
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
	</div>
	<p>
	<div id="kurz">		
			<textarea name="kurzbeschreibung" value="<?php echo htmlspecialchars($kurzbeschreibung); ?>" cols="100" placeholder="Kurzbeschreibung" ></textarea>
	</div>
	<p>
	<div id="nachricht">
			<textarea name="nachricht" value="<?php echo htmlspecialchars($nachricht); ?>" cols="100" rows ="10" placeholder="Arbeitshinweise"></textarea>
	
	
	</div>
	
    <p>
	<div class="zuweisung">
	Direktzuweisung:
	<p>
		<?php 
		$user = new Benutzer;
		$posts = $user->findeMitarbeiterFueTicketZuweisung();
		foreach($posts as $nr => $post) {
		  $name[$nr] .= $post['name'];
		}
	echo '<select name="name" size=7" >',
		    
		 '<option value="'.$name[0].'">'.$name[0].'</option>',
		 '<option value="'.$name[1].'">'.$name[1].'</option>',
		 '<option value="'.$name[2].'">'.$name[2].'</option>',
		 '<option value="'.$name[3].'">'.$name[3].'</option>',
		 '<option value="'.$name[4].'">'.$name[4].'</option>',
		 '</select>';
		
		
		?>
	</div>
	<div id="lösung">
			<textarea name="lösung" value="<?php echo htmlspecialchars($lösung); ?>" cols="100" rows ="5" placeholder="Lösung"></textarea>
	</div>
	<p/>
	
	

	
	
	Anhaenge hochladen
	<p/>
	
			Waehlen Sie eine Textdatei (*.txt, *.html usw.) von Ihrem Rechner aus.
		</p>
   	
   		<input name="datei" type="file" size="50" accept="*/*"> 
  	
  	</label>  
	
	<div id="button">
		<input type="submit" value="speichern" />
	
	
	</div>

	
		
	
	
	</fieldset>
	
	
		
			<br/>
			<br/>
	
	
	</form>
	
	 </div>
	 
	 
		<?php
	} 

// end of show_form();
	show_form();
?> 
	<script src="drop_down_menue.js"></script>
	<script>
	document.body.onload = geladen();	
	
	function geladen() {
		console.log('Dokument wurde geladen.');
	}
	</script>
	
	 

		

</body>
</html>