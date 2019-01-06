/**
 *  klasse Tabelle zum erzeugen einer Tabelle im Falle eines erfolgreichen ajax-response
 */

var Mitarbeiter = function(){}

var dropName = new Mitarbeiter();


Mitarbeiter.prototype.erzeugeTabelleMitTextKnoten = function(text)
{
	if( text == "")
		return 

		else
		{
	
			var rumpf = document.createElement("tbody");
	
			for(var z=1; z<text.length; z++)
			{
				var zeile = document.createElement("tr");
		
				for(var x of text)
				{
					var text = document.createTextNode(x);	
					var zelle = document.createElement("p");
					
					zelle.appendChild(text);
					zeile.appendChild(zelle);
				}
			}
		
			rumpf.appendChild(zeile);
				
	
			
			var tabelle = document.createElement("table");
			tabelle.appendChild(rumpf);
			document.getElementById('supporter').appendChild(tabelle);
		}
} 


Mitarbeiter.prototype.setzeTextAusTabelleInsFormular= function() 
{
		document.querySelector("p").addEventListener("click", function(evt) {
			
			 evt = (evt)? evt: ((window.event) ? window.event: "");
			 if(typeof evt == "undefined")
			 {	
				 evt=window.event; 
			 }
			console.log(evt);
			var element = (evt.target) ? evt.target: evt.srcElement;
			console.log(element);
			var quelle = element;
	        
				for(var i=0; i<quelle.childNodes.length; i++)
				{
					if(quelle.childNodes[i].nodeType == 3)
		
		 			document.h.mitarbeiter.value = quelle.childNodes[i].nodeValue;
					document.querySelector("table").style.display = "none";
				}
		
		}(), true); 

}

