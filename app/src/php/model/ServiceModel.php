<?php

namespace Guilherme\Barbersystem\model;

require_once dirname(__DIR__) . "/model/ConnectionModel.php";

class ServiceModel
{
  private $id;
  private $name;
  private $value;
  private $objConnection;

  public function __construct()
  {
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
    $nameError = $valueError = "";

    if (empty($data["name"])) {
      $nameError = "Campo nome necessário";
    } else {
      $this->name = $this->testInput($data["name"]);
    }
    if (empty($data["value"])) {
      $valueError = "Campo preço necessário";
    } else {
      $this->value = $this->testInput($data["value"]);
    }

    if ($nameError || $valueError) {
      return ["name" => $nameError, "value" => $valueError];
    } else {
      return true;
    }
  }

  public function read()
  {
    $getConnection = $this->objConnection->getConnection();

    try {
      $sql = "SELECT id, name, value FROM service";

      $stmt = $getConnection->prepare($sql);

      if ($stmt->execute()) {
        $result = $stmt->fetchAll();
        return $result;
      }
    } catch (PDOException $error) {
      echo "Error: " . $error->getMessage();
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
        $sql = "INSERT INTO service (name, value) values (:name, :value)";

        $stmt = $getConnection->prepare($sql);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":value", $this->value);

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

  public function delete($id)
  {
    $getConnection = $this->objConnection->getConnection();

    $this->id = $id;

    try {
      $sql = "DELETE FROM service WHERE id = :id";

      $stmt = $getConnection->prepare($sql);
      $stmt->bindParam(":id", $this->id);

      if ($stmt->execute()) {
        return true;
      } else {
        return false;
      }
    } catch (PDOException $error) {
      echo "Error: " . $error->getMessage();
    }
  }

  public function getServiceToEdit($id)
  {
    $getConnection = $this->objConnection->getConnection();

    $this->id = $id;

    try {
      $sql = "SELECT id, name, value from service where id = :id";

      $stmt = $getConnection->prepare($sql);

      $stmt->bindParam(":id", $this->id);

      if ($stmt->execute()) {
        $result = $stmt->fetchAll();
        return $result;
      } else {
        return false;
      }
    } catch (PDOException $error) {
      echo "Error: " . $error->getMessage();
    }
  }

  public function edit($data)
  {
    $this->id = intval($data["id"]);
    $validateResult = $this->validateForm($data);

    if ($validateResult !== true) {
      return $validateResult;
    } else {
      $getConnection = $this->objConnection->getConnection();

      try {
        $sql = "UPDATE service SET name = :name, value = :value WHERE id = :id LIMIT 1";

        $stmt = $getConnection->prepare($sql);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":value", $this->value);
        $stmt->bindParam(":id", $this->id);

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
