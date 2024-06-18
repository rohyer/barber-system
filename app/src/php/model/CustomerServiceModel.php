<?php

namespace Guilherme\Barbersystem\model;

use Guilherme\Barbersystem\model\ConnectionModel;
use PDOException;

require_once $_SERVER["DOCUMENT_ROOT"] . "/barbersystem/app/vendor/autoload.php";

class CustomerServiceModel
{
  private $id;
  private $date;
  private $time;
  private $idService;
  private $idClient;
  private $idEmployee;
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
    $dateError = $timeError = $clientError = $serviceError = "";

    if (empty($data["date"])) {
      $dateError = "Campo data necessário";
    } else {
      $this->date = $this->testInput($data["date"]);
    }
    if (empty($data["time"])) {
      $timeError = "Campo horário necessário";
    } else {
      $this->time = $this->testInput($data["time"]);
    }
    if (empty($data["client"])) {
      $clientError = "Campo cliente necessário";
    } else {
      $this->idClient = $this->testInput($data["client"]);
    }
    if (empty($data["employee"])) {
      $employeeError = "Campo colaborador necessário";
    } else {
      $this->idEmployee = $this->testInput($data["employee"]);
    }
    if (empty($data["service"])) {
      $serviceError = "Campo serviço necessário";
    } else {
      $this->idService = $this->testInput($data["service"]);
    }

    if ($dateError || $timeError || $clientError || $serviceError) {
      return ["date" => $dateError, "time" => $timeError, "client" => $clientError, "service" => $serviceError];
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
        $sql = "INSERT INTO customer_service (date, time, id_service, id_client, id_employee) values (:date, :time, :id_service, :id_client, :id_employee)";

        $stmt = $getConnection->prepare($sql);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":time", $this->time);
        $stmt->bindParam(":id_service", $this->idService);
        $stmt->bindParam(":id_client", $this->idClient);
        $stmt->bindParam(":id_employee", $this->idEmployee);

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

  public function read()
  {
    $getConnection = $this->objConnection->getConnection();

    try {
      $sql = "SELECT cs.id, cs.date, cs.time, c.phone, c.name as client, s.name as service FROM customer_service cs JOIN client c ON cs.id_client = c.id JOIN service s ON cs.id_service = s.id ORDER BY cs.date, cs.time";

      $stmt = $getConnection->prepare($sql);

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

  public function delete($id)
  {
    $getConnection = $this->objConnection->getConnection();

    $this->id = $id;

    try {
      $sql = "DELETE FROM customer_service WHERE id = :id";

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

  public function getCustomerServiceToEdit($id)
  {
    $getConnection = $this->objConnection->getConnection();

    $this->id = $id;

    try {
      $sql = "SELECT cs.id, cs.date, cs.time, c.id as id_client, s.id as id_service, e.id as id_employee, c.name as client, s.name as service, e.name as employee FROM customer_service cs JOIN client c ON cs.id_client = c.id JOIN service s ON cs.id_service = s.id JOIN employee e ON cs.id_employee = e.id WHERE cs.id = :id LIMIT 1";

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
        $sql = "UPDATE customer_service SET date = :date, time = :time, id_service = :id_service, id_client = :id_client LIMIT 1";

        $stmt = $getConnection->prepare($sql);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":time", $this->time);
        $stmt->bindParam(":id_service", $this->idService);
        $stmt->bindParam(":id_client", $this->idClient);

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

  public function getDataByService()
  {
    $getConnection = $this->objConnection->getConnection();

    try {
      $sql = "SELECT count(*) as amount, s.name FROM customer_service cs JOIN service s ON cs.id_service = s.id GROUP BY s.name";

      $stmt = $getConnection->prepare($sql);

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
}
