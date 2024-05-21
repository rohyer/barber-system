<?php
require_once dirname(__DIR__) . "/model/EmployeeModel.php";

class EmployeeController
{
  public static function readEmployee()
  {

    $objEmployeeModel = new EmployeeModel();
    $result = $objEmployeeModel->read("employee");

    include dirname(__DIR__) . "/view/EmployeeListView.php";
  }

  public static function createEmployee()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $objEmployeeModel = new EmployeeModel();
      $result = $objEmployeeModel->create($_POST, "employee");

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
    $result = $objEmployeeModel->delete($id, "employee");

    if ($result) {
      header("Location: /barbersystem/app/public/colaboradores");
    }
  }

  public static function editEmployee($id)
  {
    $objEmployeeModel = new EmployeeModel();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $objEmployeeModel->edit($_POST, "employee");
      $result = $objEmployeeModel->getUserToEdit($id, "employee");
    } else {
      $result = $objEmployeeModel->getUserToEdit($id, "employee");
    }

    require_once dirname(__DIR__) . "/view/EmployeeEditFormView.php";
  }
}
