<?php

namespace Guilherme\Barbersystem\controller;

use Guilherme\Barbersystem\model\CustomerServiceModel;

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
}
