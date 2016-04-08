<?php

spl_autoload_register( function ($class_name ) {

  $pathControllers = "App/Controllers/{$class_name}.php";
  $pathViews = "App/Views/{$class_name}.php";
  $pathModels = "App/Models/{$class_name}.php";

  if ( file_exists($pathControllers) ) {
       require_once($pathControllers);

   } else if ( file_exists($pathViews) ) {
     require_once($pathViews);

   } else if ( file_exists ($pathModels)) {
     require_once($pathModels);

   } else {
     return;
   }
});


$path = '';
if ( $_SERVER['PATH_INFO'] ) {
  $path = $_SERVER['PATH_INFO'];
}

if ($path == '/address') {

$serverReqMethod = $_SERVER['REQUEST_METHOD'];

  switch ($serverReqMethod) {

    case 'POST': //Create
    $controller = new AppController();
    $csv = $controller->create();
    break;

    case 'GET': //Read
    $controller = new AppController();
    $csv = $controller->read();
    break;

    case 'PUT': //Update
    $controller = new AppController();
    $csv = $controller->update();
    break;

    case 'DELETE': //Delete
    $controller = new AppController();
    $csv = $controller->delete();
    break;

    default:
    echo 'Error finding';
  }
}
?>
