<html>
	<head>
	<title id='title'></title>
	<style>
    </style>
     	
     	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>
    <body>
    <ul><?php 
	    $session_handler = new MysqlSessionHandler();
		
		echo '<a href="index.php?action=zeige&amp;login='.$session_handler->leseSessionDatenAus($session_id)->data.'">Startseite</a>';
		
		
				
       
        ?>
    </ul>
	<ul id="output">
	
	</ul>
    	 
	  <script type="text/javascript">

	  function createMessageOutputNodes(neuName, neuDate, neuNachricht) {
			showEntry = document.getElementById('output');
			neuSpan = document.createElement('span');
			neuSpan.setAttribute('class','entry');
			neuSmall = document.createElement('small');
			neuDiv = document.createElement('div');
			neuDiv.setAttribute('id', 'message');
			
			neuDate = document.createTextNode(neuDate);
			neuName = document.createTextNode(neuName);
			neuDiv.appendChild(neuName);
			neuSmall.appendChild(neuDate);
			neuDiv.appendChild(document.createElement('br'));
			neuDiv.appendChild(neuSmall);
			neuSpan.appendChild(neuDiv);
			neuSpan.appendChild(document.createElement('br'));
			neuNachricht = document.createTextNode(neuNachricht);
			neuSpan.appendChild(neuNachricht);
			neuSpan.appendChild(document.createElement('br'));
			showEntry.insertBefore(neuSpan, showEntry.firstChild.nextSibling);
			neuSpan.appendChild(document.createElement('p'));
		
		}	

		
	  
						 
						function LinkedList(){
							this.head = null;
							this.tail = null;
							}	  	

						 function Node(value, next, prev){
							this.value = value;
							this.next = next;
							this.prev = prev;
							 }

						 LinkedList.prototype.addToHead = function(value){
							const newNode = new Node(value, this.head, null);
							if(this.head) this.head.prev = newNode;
							else this.tail = newNode;
							this.head = newNode;
						};

						var x =  JSON.parse(jsonObject);
						for(i=0;i<x.length;i++){
							
							const list = new LinkedList();
							list.addToHead(x[i].nachricht);
							list.addToHead(x[i].message_zeit);
							list.addToHead(x[i].message_id);
							list.addToHead(x[i].absender);
							console.log(`Middle node value: ${list.head.next.value}`);

							createMessageOutputNodes(`${list.head.value}`, `${list.head.next.value}`, `${list.tail.value}`)
							latestID = `${list.head.next.value}`;
					
		
		
		

		
		
		
			
		</script>
		<p/>
		<form 
		name="h" 
		action="index.php?controller=message&action=ladeMessageFormular&login'.$session_handler->leseSessionDatenAus($session_id)->data.'" method="post" >
		
		<fieldset>
		<div class="name">
	    
		
		
		
		<script type="text/javascript">
			$( function() {			 
			    $( "#mitarbeiter" ).autocomplete({
			      source: "ajax4.php",
			      minLength: 2,
			      
			      focus: function( event, ui ) {
			          $( "#mitarbeiter" ).val( ui.item.name );
			          return false;
			        },
			      select: function( event, ui ) {
				      $( "#mitarbeiter" ).val( ui.item.name );
				      
				      
			      }
			    })
			    .autocomplete( "instance" )._renderItem = function( ul, item ) {
			        return $( "<li>" )
			          .append( "<div>" + item.name + "</div>" )
			          .appendTo( ul );
			      };
			  } );
			  </script>
			  <script type="text/javascript">
			  $('#submit').click(function() {
				    $.ajax({
				        url: 'index.php?controller=message&action=ladeMessageFormular',
				        type: 'POST',
				        data: {
				            //email: 'email@example.com',
				            message: '<?php $_POST['nachricht']?>'
				        },
				        success: function(msg) {
				            alert('Email Sent');
				        }               
				    });
				});</script>
			  <div class="ui-widget">
			  <input 
				type="text" 
				name="mitarbeiter" 
				id="mitarbeiter" 
				placeholder="Empfaenger" />
			  </div>
			  
	
		
		
		

   		<p/>
		</div>
		<div id="nachricht">
	
		<textarea name="nachricht" 
		value="<?php  echo htmlentities($nachricht); ?>" 
		cols="50" rows ="5" placeholder="Schreib etwas...">
		</textarea>

	
		</div>
		<div id="button">
		<label for="submit"></label>
		<input type="submit" value="senden" />
		</div>
		</fieldset>
		
		
		
		</form>
		<?php require 'autoload.php';
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$message = new ConcreteMessageSubject();
		$observer = new ConcreteMessageObserver($message);
		$messageNotification = $message->schreibNeueMessageInDb();
		?>
		<script>
var url = 'ws://localhost:8080';
var socket = new WebSocket(url);
var message = '<?php echo $messageNotification ?>';



	socket.onopen = function(e) {
		var message = '<?php echo $messageNotification?>';
	
		console.log('Connection established!');
		
		if (socket.readyState === WebSocket.OPEN){
			console.log(socket.send(message));
			if(typeof socket.send(message) !== 'undefinded'){
				
			console.log('message send: ' +data);
			}
		}
		
		
	 	
	}

	socket.onmessage = function(e){
		
		 console.log(e.data);
		 
  		
	 
		
	}
			
	
	
 	socket.onerror = function(error) {

		  console.log('WebSocket Error: ' + error);
 	}

 		
 	socket.onclose = function(e) {

			  socket.close();
   	}


</script> 
<?php }?>  
    </body>
</html>



