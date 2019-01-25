<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title id='title'></title>
    
</head>

<body>

	<link rel="stylesheet" href="style2.css" type="text/css" />
	<div class="network">
	<div class="bild">
	<img src ="wolkenturm.jpg" />
	<div id="red">
	<h1>Ticketsystem Lite</h1>
	<div id="time">
	</div>
	<br/>
   
    <ul id="navi">
     <?php 
    
     $session = new Session();
     $loginVar = $session->getSessionName('USER_LOGIN_VAR');
    if($loginVar !== false)
    {
       
        echo '<a href="index.php?action=logout">Abmelden</a><p/>'; 
      
        
        $sAnalyser = new SessionAnalyser();
        $sAnalyser->erstelleWarteschlangeAusSessionDaten($loginVar);
        $SessionStore = $sAnalyser->fetch();    
        $membersOnline = '';
         
            
         if(null !== $SessionStore)
                {
                    foreach($SessionStore as $sessionOutput)
                    {
                        
                        $membersOnline .= '<li>'.$sessionOutput.'<br/>';
                       
                        
                    }
                    
                    echo 'Online:'.$membersOnline;
                   
                    
                }
                   
            
        
        
       
    
    } else {
   
        echo '<a href="index.php">Anmelden</a><p>';
    }
    echo '</ul>';
    
    require $template;

  ?> 	
        

   
           
            
          
            
         
		   
      
	

		
     	<script>
       
		var url = 'ws://localhost:8080';
        var socket = new WebSocket(url);
       

     	socket.onopen = function(event){
			console.log(event);
			if (socket.readyState === WebSocket.OPEN){
				
				if(typeof socket.send(message) !== 'undefinded'){
					
				console.log('message send: '+message);
				}
			}
         	};

         socket.onmessage =  function(event) {

	     		
	     		document.title = event.data; 

	     		console.log(event.data);
	     		 
	     	}
     	socket.onerror = function(event) {

			if(event.readyState == socket.CLOSED){

	    		  console.log('WebSocket Error: ' + error);
			}
			
     	}

     	
     		
     	
 		
         </script>
        
       
        
</body>

</html>


