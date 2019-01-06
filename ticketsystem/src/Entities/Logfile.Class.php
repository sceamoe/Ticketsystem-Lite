<?php


class Logfile
{
  private $supporter       = '';
  private $aktion     = '';
  private $datum;
  private $dateiName  = '';
  private $format;
  private $infos;
  private $input;
  private $datei       = '';

  public function __construct()
  {
    $this->supporter    = $_GET['supporter'];
	$this->aktion   	= $_GET['action'];
  }

  public function setDatum()
  {

   $this->datum = date('l jS \of F Y h:i:s A');

  }

  public function getDatum()
  {

    return $this->datum;
   
  }
 

  public function setFormat($format)
  {
  
    $this->format   = $format;

  }
  
  public function getFormat()
  {
 
    return $this->format;

  }

  public function setDateiName()
  {
  

     $this->dateiName = "log_.".$this->getFormat();
   
  }  
   
  public function setInhalt()
  {
 
     $this->inhalt = file_get_contents('log_.txt');

  }  
  
  public function setInput()
  {
    
     $this->infos = array($this->getDatum(), $this->supporter, $this->aktion);   
     
  
   if($this->format = "txt")
    {       
          $this->input = implode("," ,$this->infos);
     } else {
      
          $this->input = implode("\t", $this->infos);
     }
 }
  
  public function setDatei()
  {
   $this->datei = fopen($this->dateiName, "a");
   fputs($this->datei, $this->input."\n");
   fclose($this->datei);
  }
  
  public function getInhalt()
  {
   return $this->inhalt;
  }
  
  public function methode(Logfile $objekt)
  {
	  $objekt = new ReflectionObject($ojekt);
	  print $objekt->getName();
	  
  }
}
$log = new Logfile();
$log->setDatum();
$log->setFormat('txt');
$log->setDateiName();
$log->setInput();
$log->setDatei();
$log->setInhalt();

