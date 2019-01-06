<?php

class BenutzerController extends AbstractBase {
	
	
	protected function setSupporterAction()
   {

        if(!empty($_POST)) {
        $this->setActionParameters('benutzer', setObjektNameAusKlassenName());
      }

   }
   
  
   protected function ladeFormularZumHinzufuegenAction()
   {
       
       $this->setActionParameters('benutzer', setObjektNameAusKlassenName());
   }
   
   
   protected function fuegeBenutzerinDbHinzuAction()
   {
 
        $this->setActionParameters('benutzer', setObjektNameAusKlassenName());
  
   }

   protected function löscheDatensatzAction(){
       $this->setActionParameters('benutzer', setObjektNameAusKlassenName());
   }
	
}