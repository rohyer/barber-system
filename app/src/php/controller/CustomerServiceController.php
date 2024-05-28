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

  public static function deleteCustomerService($id)
  {
    $objCustomerService = new CustomerServiceModel();
    $result = $objCustomerService->delete($id);

    if ($result) {
      header("Location: /barbersystem/app/public/atendimentos");
    }
  }
}
