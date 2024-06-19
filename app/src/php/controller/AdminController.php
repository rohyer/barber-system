<?php

namespace Guilherme\Barbersystem\controller;

use Guilherme\Barbersystem\model\CustomerServiceModel;

class AdminController
{

  public static function getHome()
  {
    $objCustomerServiceModel = new CustomerServiceModel();
    $dataByService = $objCustomerServiceModel->getDataByService();
    $dataByEmployee = $objCustomerServiceModel->getDataByEmployee();

    include dirname(__DIR__) . "/view/AdminHomeView.php";
  }
}
