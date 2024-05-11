<?php
require_once dirname(__DIR__) . "/model/ClientModel.php";

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
      $result = $objClientModel->createClient($_POST);

      // Create ocorreu corretamente
      if ($result === true) {
        $result = ["name" => "", "sex" => "", "address" => "", "birth" => "", "phone" => ""];
      }
    } else {
      $result = ["name" => "", "sex" => "", "address" => "", "birth" => "", "phone" => ""];
    }

    require dirname(__DIR__) . "/view/ClientFormView.php";
  }

  public static function readClient()
  {
    $objClientModel = new ClientModel();
    $result = $objClientModel->readClient();

    require dirname(__DIR__) . "/view/ClientListView.php";
  }

  public static function deleteClient($id)
  {
    $objClientModel = new ClientModel();
    $result = $objClientModel->deleteClient($id);

    if ($result) {
      header("Location: /barbersystem/app/public/clientes");
    }
  }

  public static function editClient($id)
  {
    $objClientModel = new ClientModel();
    $result = $objClientModel->editClient($id);

    require_once dirname(__DIR__) . "/view/ClientFormView.php";
  }
}
