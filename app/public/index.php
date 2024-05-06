<?php

require dirname(__DIR__) . "/src/php/controller/ClientController.php";
require dirname(__DIR__) . "/src/php/controller/AdminController.php";
require dirname(__DIR__) . "/src/php/controller/EmployeeController.php";

$uri = $_SERVER["REQUEST_URI"];

// echo $uri;


switch ($uri) {
  case '/barbersystem/app/public/':
    AdminController::getHome();
    break;

  case '/barbersystem/app/public/formulario-cliente':
    ClientController::formClient();
    break;
  
  case '/barbersystem/app/public/cadastro-cliente':
    ClientController::createClient();
    break;

  case '/barbersystem/app/public/clientes':
    ClientController::readClient();
    break;

  case '/barbersystem/app/public/colaboradores':
    EmployeeController::readEmployee();
  
  default:
    # code...
    break;
}