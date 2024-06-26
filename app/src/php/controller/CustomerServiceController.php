<?php

namespace Guilherme\Barbersystem\controller;

use Guilherme\Barbersystem\model\CustomerServiceModel;
use Guilherme\Barbersystem\model\ServiceModel;
use Guilherme\Barbersystem\model\ClientModel;
use Guilherme\Barbersystem\model\EmployeeModel;

require_once $_SERVER["DOCUMENT_ROOT"] . "/barbersystem/app/vendor/autoload.php";

class CustomerServiceController
{
  public static function readCustomerService()
  {
    $objCustomerService = new CustomerServiceModel();
    $result = $objCustomerService->read();

    require_once dirname(__DIR__) . "/view/CustomerServiceListView.php";
  }

  public static function createCustomerService()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $objCustomerServiceModel = new CustomerServiceModel();
      $result = $objCustomerServiceModel->create($_POST);

      if ($result === true) {
        $result = ["name" => "", "sex" => "", "address" => "", "birth" => "", "phone" => ""];
      }
    } else {
      $objServiceModel = new ServiceModel();
      $objClientModel = new ClientModel();
      $objEmployeeModel = new EmployeeModel();

      $dataService = $objServiceModel->read();
      $dataClient = $objClientModel->read("client");
      $dataEmployee = $objEmployeeModel->read("employee");

      $result = ["name" => "", "sex" => "", "address" => "", "birth" => "", "phone" => ""];
    }

    require dirname(__DIR__) . "/view/CustomerServiceCreateFormView.php";
  }

  public static function deleteCustomerService($id)
  {
    $objCustomerService = new CustomerServiceModel();
    $result = $objCustomerService->delete($id);

    if ($result) {
      header("Location: /barbersystem/app/public/agenda");
    }
  }
  
  public static function closeCustomerService($id)
  {
    $objCustomerService = new CustomerServiceModel();
    $result = $objCustomerService->close($id);

    if ($result) {
      header("Location: /barbersystem/app/public/agenda");
    }
  }

  public static function editCustomerService($id)
  {
    $objCustomerServiceModel = new CustomerServiceModel();
    $objServiceModel = new ServiceModel();
    $objClientModel = new ClientModel();
    $objEmployeeModel = new EmployeeModel();

    $dataService = $objServiceModel->read();
    $dataClient = $objClientModel->read("client");
    $dataEmployee = $objEmployeeModel->read("employee");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $objCustomerServiceModel->edit($_POST);
      $result = $objCustomerServiceModel->getCustomerServiceToEdit($id);
    } else {
      $result = $objCustomerServiceModel->getCustomerServiceToEdit($id);
    }

    require_once dirname(__DIR__) . "/view/CustomerServiceEditFormView.php";
  }
}
