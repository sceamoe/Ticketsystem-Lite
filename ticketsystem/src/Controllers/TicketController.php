<?php

class TicketController extends AbstractBase {

  protected function zeigeAlleTicketsAction()
   {
   
        $this->setActionParameters('ticket', setObjektNameAusKlassenName());
  
   }
   
   protected function zeigeTicketAction()
	{ 

        $this->setActionParameters( 'ticket', setObjektNameAusKlassenName());

    }
	
	
	public function erstelleTicketAction() {
			$this->setActionParameters( 'ticket', setObjektNameAusKlassenName());
	}
	
	
   protected function ladeTicketAction()
   {    
 
        $this->setActionParameters('ticket', setObjektNameAusKlassenName());      
      
    }
 
    protected function resetTicketAction()
    {
 
         $this->setActionParameters('ticket', setObjektNameAusKlassenName()); 
       
    } 

    protected function updateTicketAction()
    {
     
         $this->setActionParameters('ticket', setObjektNameAusKlassenName());

    }
	
	protected function fuegeTicketEinAction() {
		
	    $this->setActionParameters('ticket', setObjektNameAusKlassenName());
			
	}
	
	protected function findeTicketAction() {
		
		$this->setActionParameters('ticket', setObjektNameAusKlassenName());
	}
	
	protected function sucheTicketAction() {
		
			$this->setActionParameters('ticket', setObjektNameAusKlassenName());
	}
	
	protected function zeigeDateiInhalteAction() {
	    
	    $this->setActionParameters('ticket', setObjektNameAusKlassenName());
	}
	
}