/**
 *  klasse Tabelle zum erzeugen einer Tabelle im Falle eines erfolgreichen ajax-response
 */

var Select = function(){}

var namenMenue = new Select();


Select.prototype.erzeugeTabelleMitTextKnoten = function(text)
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
			document.getElementById('kunde').appendChild(tabelle);
		}
} 




