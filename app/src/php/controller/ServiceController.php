<?php

namespace Guilherme\Barbersystem\controller;

use Guilherme\Barbersystem\model\ServiceModel;

require_once $_SERVER["DOCUMENT_ROOT"] . "/barbersystem/app/vendor/autoload.php";

class ServiceController
{

  public static function readService()
  {
    $objServiceModel = new ServiceModel();
    $result = $objServiceModel->read();

    require_once dirname(__DIR__) . "/view/ServiceListView.php";
  }

  public static function createService()
  {
    $objServiceModel = new ServiceModel();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $result = $objServiceModel->create($_POST);

      // Create ocorreu corretamente
      if ($result === true) {
        $result = ["name" => "", "value" => ""];
      }
    } else {
      $result = ["name" => "", "value" => ""];
    }

    require_once dirname(__DIR__) . "/view/ServiceCreateFormView.php";
  }

  public static function deleteService($id)
  {
    $objServiceModel = new ServiceModel();
    $result = $objServiceModel->delete($id);

    if ($result) {
      header("Location: /barbersystem/app/public/servicos");
    }
  }

  public static function editService($id)
  {
    $objServiceModel = new ServiceModel();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $objServiceModel->edit($_POST);
      $result = $objServiceModel->getServiceToEdit($id);
    } else {
      $result = $objServiceModel->getServiceToEdit($id);
    }

    require_once dirname(__DIR__) . "/view/ServiceEditFormView.php";
  }
}
