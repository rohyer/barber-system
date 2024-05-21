<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/barbersystem/app/vendor/autoload.php";
use Guilherme\Barbersystem\model\ClientModel;

class ClientController
{
  // Static Class

  /**
   * Chamado na view
   */
  public static function createClient()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $objClientModel = new ClientModel();
      $result = $objClientModel->create($_POST, "client");

      // Create ocorreu corretamente
      if ($result === true) {
        $result = ["name" => "", "sex" => "", "address" => "", "birth" => "", "phone" => ""];
      }
    } else {
      $result = ["name" => "", "sex" => "", "address" => "", "birth" => "", "phone" => ""];
    }

    require dirname(__DIR__) . "/view/ClientCreateFormView.php";
  }

  public static function readClient()
  {
    $objClientModel = new ClientModel();
    $result = $objClientModel->read("client");

    require dirname(__DIR__) . "/view/ClientListView.php";
  }

  public static function deleteClient($id)
  {
    $objClientModel = new ClientModel();
    $result = $objClientModel->delete($id, "client");

    if ($result) {
      header("Location: /barbersystem/app/public/clientes");
    }
  }

  public static function editClient($id)
  {
    $objClientModel = new ClientModel();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $objClientModel->edit($_POST, "client");
      $result = $objClientModel->getUserToEdit($id, "client");
    } else {
      $result = $objClientModel->getUserToEdit($id, "client");
    }

    require_once dirname(__DIR__) . "/view/ClientEditFormView.php";
  }
}
