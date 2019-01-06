<?php

class LogfileController extends AbstractBase {
	
	protected function getLogfileAction()
    {
 
         $this->setActionParameters( 'log' , setObjektNameAusKlassenName());
    }
}