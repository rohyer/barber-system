<?php

use Guilherme\Barbersystem\controller\AdminController;
use Guilherme\Barbersystem\controller\ClientController;
use Guilherme\Barbersystem\controller\EmployeeController;
use Guilherme\Barbersystem\controller\ServiceController;
use Guilherme\Barbersystem\controller\CustomerServiceController;

require_once $_SERVER["DOCUMENT_ROOT"] . "/barbersystem/app/vendor/autoload.php";

$uri = $_SERVER["REQUEST_URI"];
$finalUri = parse_url($uri);

switch ($finalUri["path"]) {
  case '/barbersystem/app/public/':
    AdminController::getHome();
    break;

  case '/barbersystem/app/public/atendimentos':
    CustomerServiceController::readCustomerService();
    break;

  case '/barbersystem/app/public/atendimento/deleta':
    if ($finalUri["query"]) {
      $query = explode("=", $finalUri["query"])[1];
    }
    CustomerController::deleteCustomerService($query);
    break;

    // Clientes
  case '/barbersystem/app/public/cliente/cadastro':
    ClientController::createClient();
    break;

  case "/barbersystem/app/public/cliente/deleta":
    if ($finalUri["query"]) {
      $query = explode("=", $finalUri["query"])[1];
    }
    ClientController::deleteClient($query);
    break;

  case "/barbersystem/app/public/cliente/edita":
    if (isset($finalUri["query"])) {
      $query = explode("=", $finalUri["query"])[1];
      ClientController::editClient($query);
    }
    break;

  case '/barbersystem/app/public/clientes':
    ClientController::readClient();
    break;

    // Colaboradores 
  case '/barbersystem/app/public/colaboradores':
    EmployeeController::readEmployee();
    break;

  case '/barbersystem/app/public/colaborador/cadastro':
    EmployeeController::createEmployee();
    break;

  case '/barbersystem/app/public/colaborador/deleta':
    if (isset($finalUri["query"])) {
      $query = explode("=", $finalUri["query"])[1];
      EmployeeController::deleteEmployee($query);
    }
    break;

  case "/barbersystem/app/public/colaborador/edita":
    if (isset($finalUri["query"])) {
      $query = explode("=", $finalUri["query"])[1];
      EmployeeController::editEmployee($query);
    }
    break;

  case "/barbersystem/app/public/servicos":
    ServiceController::readService();
    break;

  case "/barbersystem/app/public/servico/cadastro":
    ServiceController::createService();
    break;

  case "/barbersystem/app/public/servico/deleta":
    if (isset($finalUri["query"])) {
      $query = explode("=", $finalUri["query"])[1];
      ServiceController::deleteService($query);
    }
    break;

  case "/barbersystem/app/public/servico/edita":
    if (isset($finalUri["query"])) {
      $query = explode("=", $finalUri["query"])[1];
      ServiceController::editService($query);
    }
    break;

  default:
    # code...
    break;
}
