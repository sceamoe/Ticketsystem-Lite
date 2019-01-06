<?php

class Time 
{

  private $zeitJetzt;
  private $ende;
  private $zeitDiff;
  private $ticketZeit; 


  public function __construct()
  {
  
    $this->ticket = new Ticket();
    
  }

  public function setTicketZeit()
  {
 
     $this->inhalt = $this->ticket->holeZeit();
   
     foreach($this->inhalt as $this->post)
     {
    
        $this->ticketZeit = $this->post['zeit'];
  
     }
  }
 
  public function getTicketZeit()
  {

    return $this->ticketZeit;

  }
  
  
 
  public function setZeitJetzt()
  {
 
      $this->zeitJetzt   = date("H:i:s");

  }

  public function getZeitJetzt()
  { 

     return $this->zeitJetzt;

  }


  public function setEnde()
  {
 
    $this->ende      =  strtotime('+120 minutes', strtotime($this->getTicketZeit()));
  
  }

  public function getEnde()
  {

   return $this->ende;

  }

   
  public function setZeitDiff()
  {
  
     $this->zeitDiff  =  date("H:i:s",$this->getEnde() - strtotime($this->getZeitJetzt()));

  }


  public function getzeitDiff()
  {

   return $this->zeitDiff;

  }

  
  
  public function resetStatus()
  {
	  
	    
	  $this->ticket->resetTicket();
		
	  
  }
  
  public function methode(Time $objekt)
  {
	  $objekt = new ReflectionObject($objekt);
	  print $objekt->getName();
	  
  } 
}
  

