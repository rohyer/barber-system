<?php

namespace Guilherme\Barbersystem\controller;

use Guilherme\Barbersystem\model\CustomerServiceModel;
use Guilherme\Barbersystem\model\AdminModel;

class AdminController
{

  public static function getHome()
  {
    $objCustomerService = new CustomerServiceModel();
    $dataByService = $objCustomerService->getDataByService();
    $dataByEmployee = $objCustomerService->getDataByEmployee();
    $amountClosedData = $objCustomerService->getClosedDataOnCurrentMonth();
    $amountOpenData = $objCustomerService->getOpenDataOnCurrentMonth();
    $dateByWeekend = $objCustomerService->getClosedDataOnCurrentMonthByWeekend();
    $dataByMonths = $objCustomerService->structureClosedDataByMonths();
    $closedValueSum = $objCustomerService->getSumOfClosedData();
    $openValueSum = $objCustomerService->getSumOfOpenData();

    include dirname(__DIR__) . "/view/AdminHomeView.php";
  }

  public static function getRegister()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $objAdminModel = new AdminModel();
      $result = $objAdminModel->create($_POST);

      if ($result === true) {
        $result = ["name" => "", "email" => "", "password" => ""];
      }
    } else {
      $result = ["name" => "", "email" => "", "password" => ""];
    }
    include dirname(__DIR__) . "/view/AdminRegisterView.php";
  }
}
