<?php

namespace Guilherme\Barbersystem\controller;

use Guilherme\Barbersystem\model\CustomerServiceModel;

require_once $_SERVER["DOCUMENT_ROOT"] . "/barbersystem/app/vendor/autoload.php";

class CustomerServiceController
{
  public static function readCustomerService()
  {
    $objCustomerService = new CustomerServiceModel();
    $result = $objCustomerService->read();

    require_once dirname(__DIR__) . "/view/CustomerServiceListView.php";
  }
}
