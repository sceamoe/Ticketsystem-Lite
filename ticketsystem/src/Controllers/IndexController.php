<?php

class IndexController extends AbstractBase
{

	protected function indexAction()
	{

       $this->setActionParameters('benutzer', setObjektNameAusKlassenName());

	}


    protected function logoutAction()
    {
        $this->setActionParameters('benutzer', setObjektNameAusKlassenName());
    }
  
 
	protected function zeigeAction()
	{

       $this->setActionParameters('benutzer', setObjektNameAusKlassenName());

	}
  
}
