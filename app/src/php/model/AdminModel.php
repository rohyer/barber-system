<?php

namespace Guilherme\Barbersystem\model;

use Guilherme\Barbersystem\model\ConnectionModel;

class AdminModel
{
  private $objConnection;
  private $id;
  private $name;
  private $email;
  private $password;

  public function __construct()
  {
    require_once dirname(__DIR__) . "/model/ConnectionModel.php";
    $this->objConnection = new ConnectionModel();
  }

  public function testInput($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  public function validateForm($data)
  {
    $nameError = $emailError = $passwordError = "";

    if (empty($data["name"])) {
      $nameError = "Campo nome necessário";
    } else {
      $this->name = $this->testInput($data["name"]);
    }
    if (empty($data["email"])) {
      $emailError = "Campo e-mail necessário";
    } else {
      $this->email = $this->testInput($data["email"]);
    }
    if (empty($data["password"])) {
      $passwordError = "Campo senha necessário";
    } else {
      $this->password = $this->testInput($data["password"]);
    }


    if ($nameError || $emailError || $passwordError) {
      return ["name" => $nameError, "email" => $emailError, "password" => $passwordError];
    } else {
      return true;
    }
  }

  public function create($data)
  {
    $validateResult = $this->validateForm($data);

    if ($validateResult !== true) {
      return $validateResult;
    } else {
      $getConnection = $this->objConnection->getConnection();

      try {
        $sql = "INSERT INTO admin (name, email, password) values (:name, :email, :password)";

        $stmt = $getConnection->prepare($sql);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        if ($stmt->execute()) {
          return true;
        } else {
          return false;
        }
      } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
      }
    }
  }
}
