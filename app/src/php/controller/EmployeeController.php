<?php

class EmployeeController {
  
  public static function readEmployee() {
    include dirname(__DIR__) . "/model/EmployeeModel.php";

    $objEmployeeModel = new EmployeeModel();
    $result = $objEmployeeModel->read();

    include dirname(__DIR__) . "/view/EmployeeListView.php";
  }
}