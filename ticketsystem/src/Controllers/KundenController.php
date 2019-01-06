<?php

class KundenController extends AbstractBase {
	
	protected function findeKundeAction() {
		
		$this->setActionParameters('kunde', setObjektNameAusKlassenName());
		
	}
	
	protected function ladeKundeAction() {
		
		$this->setActionParameters('kunde', setObjektNameAusKlassenName());
		
	}
	
	protected function updateKundeAction(){
		
		if(!empty($_POST)){
			
			$this->setActionParameters('kunde', setObjektNameAusKlassenName());
		}
	}
	
	protected function neuerKundeAction() {
		
		$this->setActionParameters('kunde', setObjektNameAusKlassenName());
		
	}
	
	protected function fuegeNeuenKundenEinAction() {
		
		if(!empty($_POST)) {
			
			$this->setActionParameters('kunde', setObjektNameAusKlassenName());
		}
	}
	
	protected function loescheKundenDatensatzAction(){
	    
	    $this->setActionParameters('kunde', setObjektNameAusKlassenName());
	}
	
}