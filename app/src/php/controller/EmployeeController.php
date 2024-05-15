<?php
require_once dirname(__DIR__) . "/model/EmployeeModel.php";

class EmployeeController
{
  public static function readEmployee()
  {

    $objEmployeeModel = new EmployeeModel();
    $result = $objEmployeeModel->read();

    include dirname(__DIR__) . "/view/EmployeeListView.php";
  }

  public static function createEmployee()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $objEmployeeModel = new EmployeeModel();
      $result = $objEmployeeModel->createEmployee($_POST);

      // Create ocorreu corretamente
      if ($result === true) {
        $result = ["name" => "", "sex" => "", "address" => "", "birth" => "", "phone" => ""];
      }
    } else {
      $result = ["name" => "", "sex" => "", "address" => "", "birth" => "", "phone" => ""];
    }

    require dirname(__DIR__) . "/view/EmployeeCreateFormView.php";
  }

  public static function deleteEmployee($id)
  {
    $objEmployeeModel = new EmployeeModel();
    $result = $objEmployeeModel->deleteEmployee($id);

    if ($result) {
      header("Location: /barbersystem/app/public/colaboradores");
    }
  }

  public static function editEmployee($id)
  {
    $objEmployeeModel = new EmployeeModel();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $objEmployeeModel->editClient($_POST);
      $result = $objEmployeeModel->getEmployeeToEdit($id);
    } else {
      $result = $objEmployeeModel->getEmployeeToEdit($id);
    }

    require_once dirname(__DIR__) . "/view/EmployeeEditFormView.php";
  }
}
