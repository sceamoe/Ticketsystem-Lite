<?php 
error_reporting(E_ALL & ~ E_NOTICE);
ini_set('display_errors','On');

require_once 'autoload.php';
require_once 'src/Entities/Logfile.Class.php';
require_once 'inc/ObjektFactory.php';
require_once 'src/Controllers/AbstractBase.php';
require __DIR__ . '/vendor/autoload.php';

$controller       = (isset($_GET['controller']) ? $_GET['controller'] : 'index');
$controllerName   = ucfirst($controller).'Controller';
$controllerFile   = 'src/Controllers/' . $controllerName . '.php';


$action          = (isset($_GET['action']) ? $_GET['action'] : 'index' );          
 
   
  
      if(file_exists($controllerFile)) {
       require_once $controllerFile;
      
      $requestController = new $controllerName();
      $requestController->run($action);
      } else {
     
      require_once 'src/Controllers/IndexController.php';
       
     $requestController = new IndexController();
     $requestController->render404();
}

  
