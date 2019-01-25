<?php
require 'autoload.php';


@define(TICKET_TABLE_NAME, 'ticket');

class Ticket extends Model
{

  protected $table_properties = array( 
                
               'ticket_id',
               'kurzbeschreibung',
               'prioritaet',
               'dringlichkeit',
               'nachricht',
               'loesung',
               'ticket_zeit');
  
 protected $table_names = array(
     
    TICKET_TABLE_NAME
  );
  
  
   
  
     public function zeigeAlleTickets() {
        
      $model = new Model();
      $result = $model->select()->from(TICKET_TABLE_NAME)
      ->join('kunde')->on('kunde.kunden_id','ticket.kunden_id_fk')
      ->join('mitarb_ticket')->on('mitarb_ticket.ticket_id_fk','ticket.ticket_id')
      ->join('mitarbeiter')->on('mitarbeiter.mitarbeiter_id','mitarb_ticket.mitarbeiter_id_fk')
      ->where('kunden_id_fk', 'kunden_id')
      ->where('ticket_id_fk','ticket_id')
      ->where('mitarbeiter_id_fk','mitarbeiter_id')
      ->executeQuery($parameter, $value)->as_array();
      
      
     
                
                return $result;
           
     }
 
    public function zeigeTicket(){
   
        
        
        $model = new Model();
        $result = $model->select()->from(TICKET_TABLE_NAME)
        ->join('kunde')->on('kunde.kunden_id','ticket.kunden_id_fk')
        ->join('mitarb_ticket')->on('mitarb_ticket.ticket_id_fk','ticket.ticket_id')
        ->join('mitarbeiter')->on('mitarbeiter.mitarbeiter_id','mitarb_ticket.mitarbeiter_id_fk')
        ->where('kunden_id_fk', 'kunden_id')
        ->where('ticket_id_fk','ticket_id')
        ->where('mitarbeiter_id_fk','mitarbeiter_id')
        ->where('status',':status')
        ->executeQuery(':status', "Erstellt" )->as_array();

        return $result;

      }

      
          
      public function erzeugeTicketId() {
              
             $ticket_id = uniqid(0000);
              
             return $ticket_id;
         
          
      }
    
    public function ladeTicket(){
  
     
        
        $model = new Model();
        
        $model->update(TICKET_TABLE_NAME)->set(
            array('status'),
            array( '"In Bearbeitung"'))
        ->where('ticket_id', ':ticket_id')
            ->executeQuery(':ticket_id',$_GET['ticket_id']);
        
        

        $model = new Model();
         $result = $model->select()->from(TICKET_TABLE_NAME)
         ->join('kunde')->on('kunde.kunden_id','ticket.kunden_id_fk')
         ->join('mitarb_ticket')->on('mitarb_ticket.ticket_id_fk','ticket.ticket_id')
         ->join('mitarbeiter')->on('mitarbeiter.mitarbeiter_id','mitarb_ticket.mitarbeiter_id_fk')
         ->where('status',OPERATOR_NOT_EQUAL,'"Geloest"')
         ->where('ticket_id', ':ticket_id')
         ->where('ticket_id', 'ticket_id_fk')
         ->where('mitarbeiter_id', 'mitarbeiter_id_fk')
         ->where('kunden_id','kunden_id_fk')
         ->executeQuery(':ticket_id', $_GET['ticket_id'])->as_array();
	
		return $result;
	}

  
	
	
	
	
	
    
    public function updateTicket(){
	
    
    
	
      if(empty($_POST['loesung'])) {
      
      $model = new Model();
      $model->update('ticket')->set(array(
        'kurzbeschreibung',
        'status',
        'dringlichkeit',
        'nachricht'
         ),
        array(
         ':kurzbeschreibung',   
         ':status',
         ':dringlichkeit',
         ':nachricht'
         
        )
          )->where('ticket_id',intval($_GET['ticket_id']))
        ->executeQuery(
            array(
                    ':kurzbeschreibung',
                    ':status',  
                    ':dringlichkeit',
                    ':nachricht',
                   
                 
        ),
            array(
                $_POST['kurzbeschreibung'],
                "Erstellt",
                $_POST['dringlichkeit'],
                $_POST['nachricht'],
                
                
            )
        );
            
      }
          
       
     
      
   
   else if(isset($_POST['loesung'])) {
 
       $model = new Model();
       $model->update('ticket')->set(array(
           'kurzbeschreibung',
           'status',
           'dringlichkeit',
           'nachricht',
           'loesung'
       ),
           array(
               ':kurzbeschreibung',
               ':status',
               ':dringlichkeit',
               ':nachricht',
               ':loesung'               
           )
           )->where('ticket_id',intval($_GET['ticket_id']))
           ->executeQuery(
               array(
                   ':kurzbeschreibung',
                   ':status',
                   ':dringlichkeit',
                   ':nachricht',
                   ':loesung'
                   
                   
               ),
               array(
                   $_POST['kurzbeschreibung'],
                   "Erstellt",
                   $_POST['dringlichkeit'],
                   $_POST['nachricht'],
                   $_POST['loesung']
                   
                   
               )
               );
           
   }
 }


  public function resetTicket()  {
	
      $zahl = $this->findeTicketId();
	
      $ticket_id = $zahl[0];
      
      $model = new Model();
      $model->update('ticket')->set(
          array(
            'status',
         ),
          array(
            ':status',
          )
          )->where('ticket_id',intval($ticket_id))
          ->executeQuery(':status',"Erstellt");
	
  }

  public function holeZeit(){
   
     
        
        $model = new Model();
        $result = $model->select('zeit')->from('ticket')->where('ticket_id',':ticket_id')
        ->executeQuery(':ticket_id', $_GET['ticket_id'])->as_array();
    
        return $result;
 
  }

   public function findeTicketId()
   {
	  
       $model = new Model();
       $result = 
       
       $model->select('ticket_id')->from(TICKET_TABLE_NAME)
       ->where('status', '"In Bearbeitung"')->executeQuery()->as_array();
	   
	   foreach($result as $post) {
		   $ticket_id[] .= $post['ticket_id'];
	   }
		
	 	
   
   
      return $ticket_id;
	   
   }
   
   public function findeNameImTicketFormularAusString($string) {
	    
		
		$model = new Model();
		
		$result = $model->select('kunde')->from('kunde')			
		                ->where('kunde','LIKE',':string')
		                ->executeQuery(':string', $string.'%')->as_array();
		
		return $result;
   }
   
   
   public function findeMitarbeiterId() {
	   $mitarbeiter = new Benutzer();
	   $mitarbeiter_id = $mitarbeiter->findeBenutzerId();
		
		return $mitarbeiter_id;
		
   }
		private function getKundenIdAusTicketFormular(){
		
		   $model = new Model();
		   $this->inhalt = $model->select('kunden_id')->from('kunde')
	       	->where('kunde',':kunde')->executeQuery(':kunde',$_POST['kunde'])->as_array();
		
		foreach($this->inhalt as $this->post) {
			
				var_dump($kunden_id = $this->post['kunden_id']);
				
			}
			
			return $kunden_id;
		}
		
		private function fuegeTicketDatenEin(){
		    $db = Db::getInstance();
		    $model = new Model();
			
			$model->insert_into('ticket')->set(
			    array(
			    'kurzbeschreibung',
			    'nachricht',
			    'status',
			    'dringlichkeit',
			    'kunden_id_fk',
			    ),
			     array( 
			        ':kurzbeschreibung',
			        ':nachricht',
			        '"Erstellt"',
			        ':dringlichkeit',
			        ':kunden_id')
			    )->executeQuery(array(
			        ':kurzbeschreibung',
			        ':nachricht',
			        
			        ':dringlichkeit',
			        ':kunden_id'), 
			        array(
			             
			            $_POST['kurzbeschreibung'],
			            $_POST['nachricht'],
			            $_POST['dringlichkeit'],
			            $this->getKundenIdAusTicketFormular()
			            
			        ));
        
			    
			    
		$newId = $db->lastInsertId();
		
		return $newId;
		}
		
		
		private function fuegeDatenEinInZwischentabelle(){
		
		  $newId = $this->fuegeTicketDatenEin();
		  $model = new Model();
		  $model->insert_into('mitarb_ticket ')
		  ->set(array('mitarbeiter_id_fk',
		              'ticket_id_fk'),
		      array(':mitarbeiter_id',
		            ':new_id')
		      )->executeQuery(
		      array(':mitarbeiter_id',
		            ':new_id'),
		          array($this->findeMitarbeiterId(),
		                $newId)
		          );
		  
		      return $newId;
		}
			
		public function fuegeBildPfadInDbEin(){
		
		  $newId = $this->fuegeDatenEinInZwischentabelle();
		  $binaererCode = $this->ladeBildDateiinTempFolder();
        if(!empty($_FILES['datei']['name'])){
            $datei_name = $_FILES['datei']['name'];
			
            $model = new Model();
            $model->insert_into('datafile ')
            ->set(array('datei_name',
                      'datei',
                      'ticket_id_fk'),
                  array(':datei_name',
                      ':binaererCode',
                      ':new_id')
             )->executeQuery(array(
                      ':datei_name',
                      ':binaererCode',
                      ':new_id'),
                      array($datei_name,
                            $binaererCode,
                            $newId
                      ));
              
          }
      
        }
         
		
	private function erzeugeRandomStringF�rDateiNamen(){
	    
	    if(function_exists('random_bytes')){
	        $bytes = random_bytes(16);
	        $str = bin2hex($bytes);
	        return $str;
	    }
	}
	
	private function ladeBildDateiinTempFolder(){
	    
	    $erlaubtesFormat = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
       if(!empty($_FILES['datei']['tmp_name'])){
        $erkanntesFormat = exif_imagetype($_FILES['datei']['tmp_name']);
	    if(!in_array($erkanntesFormat, $erlaubtesFormat)){
	        die("Nur der Upload von Bilddateien ist gestattet");
	    }
	    $max_Gr��e = 500*1024; // 500 KB
	    if($_FILES['datei']['size'] > $max_Gr��e){
	        die("Bitte keine Bilder gr��er 500kb hochladen");
	    }
	    
	    $zielOrdner = 'tmp/';
	    $dateiName = $_FILES['datei']['name'];
	    $extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));
	    $randomString = $this->erzeugeRandomStringF�rDateiNamen($fileName);
	    
	    
	    $neuerPfad = $zielOrdner.$randomString.'.'.$extension;
	    
	    move_uploaded_file($_FILES['datei']['tmp_name'],$neuerPfad);
	    echo ' Bild erfolgreich hochgeladen: <a href="'.$neuerPfad.'">'.$neuerPfad.'</a>';
	    
	    $bin�rCode = base64_encode($neuerPfad);
	    
	    return $bin�rCode;
       }
       
	}
	
	
	
	
	public function sucheTicket() {
	
		$model = new Model();
	    
	    $result =
	    
	    $model->select()->from(TICKET_TABLE_NAME)
	    ->join('kunde')->on('kunde.kunden_id','ticket.kunden_id_fk')
	    ->join('mitarb_ticket')->on('mitarb_ticket.ticket_id_fk','ticket.ticket_id')
	    ->join('mitarbeiter')->on('mitarbeiter.mitarbeiter_id','mitarb_ticket.mitarbeiter_id_fk')
	    ->where('kunden_id_fk', 'kunden_id')
	    ->where('ticket_id_fk','ticket_id')
	    ->where('mitarbeiter_id_fk','mitarbeiter_id')
	    
	    ->where('ticket_id', ':ticket_id')
	    
	    
	    
	    ->executeQuery(':ticket_id', $_POST['ticket_id'])->as_array();
		
	    return $result;

	}
    
}

