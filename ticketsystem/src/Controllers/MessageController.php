<?php
class MessageController extends AbstractBase {
    
    protected function ladeMessageFormularAction(){
        
        $this->setActionParameters('message', setObjektNameAusKlassenName());
    }
    
    
    protected function schreibNeueMessageInDbAction(){
        
        $this->setActionParameters('message', setObjektNameAusKlassenName());
    }
}