<?php
require_once dirname(__DIR__) . "/model/ConnectionModel.php";

class ClientModel {
  private $objConnection;
  private $id;
  private $name;
  private $address;
  private $sex;
  private $birth;
  private $phone;

  public function __construct() {
    $this->objConnection = new ConnectionModel();
  }

  private function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  private function validateForm($data) {
    $nameError = $addressError = $sexError = $birthError = $phoneError = "";

    if (empty($data["name"])) {
      $nameError = "Campo nome necessário";
    } else {
      $this->name = $this->testInput($data["name"]);
    }
    if (empty($data["sex"])) {
      $sexError = "Campo sexo necessário";
    } else {
      $this->sex = $this->testInput($data["sex"]);
    }
    if (empty($data["address"])) {
      $addressError = "Campo endereço necessário";
    } else {
      $this->address = $this->testInput($data["address"]);
    }
    if (empty($data["birth"])) {
      $birthError = "Campo data de nascimento necessário";
    } else {
      $this->birth = $this->testInput($data["birth"]);
    }
    if (empty($data["phone"])) {
      $phoneError = "Campo telefone necessário";
    } else {
      $this->phone = $this->testInput($data["phone"]);
    }

    if ($nameError || $addressError || $sexError || $birthError || $phoneError) {
      return ["name" => $nameError, "address" => $addressError, "sex" => $sexError, "birth" => $birthError, "phone" => $phoneError];
    } else {
      return true;
    }
  }

  public function createClient($data) {
    $validateResult = $this->validateForm($data);
    
    if ($validateResult !== true) {
      return $validateResult;
    } else {
      $getConnection = $this->objConnection->getConnection();

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
  }

  public function readClient() {
    $getConnection = $this->objConnection->getConnection();

    try {
      $sql = "Select id, name, birth, sex FROM client";

      $stmt = $getConnection->prepare($sql);

      if ($stmt->execute()) {
        $result = $stmt->fetchAll();
        return $result;
      }
    } catch(PDOException $error) {
      echo "Error: " . $error->getMessage();
    }
  }

  public function deleteClient($id) {
    $getConnection = $this->objConnection->getConnection();

    $this->id = $id;

    try {
      $sql = "DELETE FROM client WHERE id = :id";

      $stmt = $getConnection->prepare($sql);
      $stmt->bindParam(":id", $this->id);

      if ($stmt->execute()) {
        return true;
      } else {
        return false;
      }

    } catch(PDOException $error) {
      echo "Error: " . $error->getMessage();
    }
  }
}