<?php
require dirname(__DIR__) . "/model/ClientModel.php";

class ClientController {

  public static function formClient() {
    require dirname(__DIR__) . "/view/ClientFormView.php";
  }

  public static function createClient() {
    $objClientModel = new ClientModel();
    $objClientModel->createClient($_POST);

    header("Location: formulario-cliente");
  }

  public static function readClient() {
    $objClientModel = new ClientModel();
    $result = $objClientModel->readClient();

    require dirname(__DIR__) . "/view/ClientListView.php";
  }
}