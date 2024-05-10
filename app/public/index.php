<?php

require_once dirname(__DIR__) . "/src/php/controller/ClientController.php";
require_once dirname(__DIR__) . "/src/php/controller/AdminController.php";
require_once dirname(__DIR__) . "/src/php/controller/EmployeeController.php";

$uri = $_SERVER["REQUEST_URI"];
$finalUri = parse_url($uri);

switch ($finalUri["path"]) {
  case '/barbersystem/app/public/':
    AdminController::getHome();
    break;

  case '/barbersystem/app/public/cliente/cadastro':
    ClientController::createClient();
    break;

  case "/barbersystem/app/public/cliente/deleta":
    if ($finalUri["query"]) {
      $query = explode("=", $finalUri["query"])[1];
    }
    ClientController::deleteClient($query);

  case '/barbersystem/app/public/clientes':
    ClientController::readClient();
    break;

  case '/barbersystem/app/public/colaboradores':
    EmployeeController::readEmployee();

  default:
    # code...
    break;
}
