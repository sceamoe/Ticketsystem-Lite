<?php

abstract class AbstractBase
{

	protected $actionParameters = array();
	protected $template = '';

  
	protected function setActionParameters($key, $value) {
	
		$this->actionParameters[$key] = $value;	
	}
	
   
	public function run($action) {
	
	$this->setActionParameters('action', $action);  		
	
	$methodName = $action.'Action';				
	$this->setTemplate($methodName);			
	
	if (method_exists($this, $methodName)) {	
      
		$this->$methodName();

	} else { 
      
		$this->render404();						
    }

		$this->render();						
	}

  public function render404() {
    
		header('HTTP/1.0 404 Not Found');
		die ('Error 404');
  }

  
 
  
  protected function setTemplate($template, $controller = null) {
    
		if(empty($controller)) {
	
	// fragt Objekt(index.php) nach Wert für $controller
			$controller = get_class($this); 
		}
  
		$this->template = $controller.'/'.$template.'.tpl.php';
  }

  
  /**
  * Gibt den Namen des zu ladenden Templates zurück
  **/
  
  protected function getTemplate()	{
       
	   return $this->template;
  }

  
 /**
 * Importiert Variablen des Arrays in Symboltabelle und
 * holt den Pfad des Templates aus seinem Getter
 **/
  protected function render()	{
    
	extract($this->actionParameters);					 
	$template = $this->getTemplate();					 

	require_once 'templates/layout.tpl.php';			// Lädt das Basistemplate
	
  }

}
