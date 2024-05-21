<?php
namespace Guilherme\Barbersystem\model;

use Guilherme\Barbersystem\model\ConnectionModel;

require_once $_SERVER["DOCUMENT_ROOT"] . "/barbersystem/app/vendor/autoload.php";

abstract class BaseUserModel
{
  protected $objConnection;
  protected $id;
  protected $name;
  protected $address;
  protected $sex;
  protected $birth;
  protected $phone;

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

  public function create($data, $table)
  {
    $validateResult = $this->validateForm($data);

    if ($validateResult !== true) {
      return $validateResult;
    } else {
      $getConnection = $this->objConnection->getConnection();

      try {
        $sql = "INSERT INTO " . $table . " (name, address, sex, birth, phone) values (:name, :address, :sex, :birth, :phone)";

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
      } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
      }
    }
  }

  public function read($table)
  {
    $getConnection = $this->objConnection->getConnection();

    try {
      $sql = "Select id, name, birth, sex, phone FROM " . $table;

      $stmt = $getConnection->prepare($sql);

      if ($stmt->execute()) {
        $result = $stmt->fetchAll();
        return $result;
      }
    } catch (PDOException $error) {
      echo "Error: " . $error->getMessage();
    }
  }

  public function delete($id, $table)
  {
    $getConnection = $this->objConnection->getConnection();

    $this->id = $id;

    try {
      $sql = "DELETE FROM " . $table . " WHERE id = :id";

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

  public function getUserToEdit($id, $table)
  {
    $getConnection = $this->objConnection->getConnection();

    $this->id = $id;

    try {
      $sql = "SELECT name, address, sex, birth, phone FROM " . $table . " WHERE id=:id";

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

  public function edit($data, $table)
  {
    $this->id = intval($data["id"]);
    $validateResult = $this->validateForm($data);

    if ($validateResult !== true) {
      return $validateResult;
    } else {
      $getConnection = $this->objConnection->getConnection();

      try {
        $sql = "UPDATE " . $table . " SET name = :name, address = :address, sex = :sex, birth = :birth, phone = :phone WHERE id = :id LIMIT 1";

        $stmt = $getConnection->prepare($sql);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":sex", $this->sex);
        $stmt->bindParam(":birth", $this->birth);
        $stmt->bindParam(":phone", $this->phone);
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
