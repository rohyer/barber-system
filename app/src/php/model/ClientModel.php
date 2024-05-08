<?php

class ClientModel {
  private $objConnection;
  private $id;
  private $name;
  private $address;
  private $sex;
  private $birth;
  private $phone;

  public function __construct() {
    require dirname(__DIR__) . "/model/ConnectionModel.php";
    $this->objConnection = new ConnectionModel();
  }

  public function createClient($data) {
    $getConnection = $this->objConnection->getConnection();

    $this->name = $data["name"];
    $this->address = $data["address"];
    $this->sex = $data["sex"];
    $this->birth = $data["birth"];
    $this->phone = $data["phone"];

    try {
      $sql = "INSERT INTO client (name, address, sex, birth, phone) values (:name, :address, :sex, :birth, :phone)";

      $stmt = $getConnection->prepare($sql);
      $stmt->bindParam(":name", $this->name);
      $stmt->bindParam(":address", $this->address);
      $stmt->bindParam(":sex", $this->sex);
      $stmt->bindParam(":birth", $this->birth);
      $stmt->bindParam(":phone", $this->phone);

      if ($stmt->execute()) {
        return true;
      } else {
        return false;
      }

    } catch(PDOException $error) {
      echo "Error: " . $error->getMessage();
    }
  }

  public function readClient() {
    $getConnection = $this->objConnection->getConnection();

    try {
      $sql = "Select name, birth, sex FROM client";

      $stmt = $getConnection->prepare($sql);

      if ($stmt->execute()) {
        $result = $stmt->fetchAll();
        return $result;
      }
    } catch(PDOException $error) {
      echo "Error: " . $error->getMessage();
    }
  }
}