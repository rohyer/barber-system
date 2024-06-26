<?php

namespace Guilherme\Barbersystem\model;

use Guilherme\Barbersystem\model\ConnectionModel;
use PDOException;
use DateTime;
use DateTimeZone;
use PDO;

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

  public function readOpen()
  {
    $getConnection = $this->objConnection->getConnection();
    $status = "open";

    try {
      $sql = "SELECT cs.id, cs.date, cs.time, c.phone, c.name as client, s.name as service, e.name as employee FROM customer_service cs JOIN client c ON cs.id_client = c.id JOIN service s ON cs.id_service = s.id JOIN employee e ON cs.id_employee = e.id WHERE status = :status ORDER BY cs.date, cs.time";

      $stmt = $getConnection->prepare($sql);
      $stmt->bindParam(":status", $status);

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
  
  public function readClosed()
  {
    $getConnection = $this->objConnection->getConnection();
    $status = "closed";

    try {
      $sql = "SELECT cs.id, cs.date, cs.time, c.phone, c.name as client, s.name as service, e.name as employee FROM customer_service cs JOIN client c ON cs.id_client = c.id JOIN service s ON cs.id_service = s.id JOIN employee e ON cs.id_employee = e.id WHERE status = :status ORDER BY cs.date, cs.time";

      $stmt = $getConnection->prepare($sql);
      $stmt->bindParam(":status", $status);

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
        $sql = "UPDATE customer_service SET date = :date, time = :time, id_service = :id_service, id_client = :id_client, id_employee = :id_employee LIMIT 1";

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

  public function close($id) {
    $getConnection = $this->objConnection->getConnection();
    $this->id = $id;

    try {
      $sql = "UPDATE customer_service SET status = 'closed' WHERE id = :id";

      $stmt = $getConnection->prepare($sql);
      $stmt->bindParam(":id", $this->id);

      if ($stmt->execute()) {
        return true;
      } else {
        return false;
      }

    } catch (PDOException $error) {
      echo "Error " . $error->getMessage();
    }
  }

  public function getDataByService()
  {
    $getConnection = $this->objConnection->getConnection();

    try {
      $sql = "SELECT count(*) as amount_by_service, s.name as service FROM customer_service cs JOIN service s ON cs.id_service = s.id GROUP BY s.name";

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

  public function getDataByEmployee()
  {
    $getConnection = $this->objConnection->getConnection();

    try {
      $sql = "SELECT count(*) as amount_by_employee, e.name as employee FROM customer_service cs JOIN employee e ON cs.id_employee = e.id GROUP BY e.name";

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

  public function getClosedCustomerServiceOnCurrentMonth()
  {
    $getConnection = $this->objConnection->getConnection();
    $currentDate = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
    $year = $currentDate->format("Y");
    $month = $currentDate->format("m");

    $date = $year . "-" . $month . "-__";
    $status = "closed";

    try {
      $sql = "SELECT count(*) as amount FROM customer_service WHERE date LIKE :date and status = :status";

      $stmt = $getConnection->prepare($sql);
      $stmt->bindParam(":date", $date);
      $stmt->bindParam(":status", $status);

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

  public function getOpenCustomerServiceOnCurrentMonth()
  {
    $getConnection = $this->objConnection->getConnection();
    $currentDate = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
    $year = $currentDate->format("Y");
    $month = $currentDate->format("m");

    $date = $year . "-" . $month . "-__";
    $status = "open";

    try {
      $sql = "SELECT count(*) as amount FROM customer_service WHERE date LIKE :date and status = :status";

      $stmt = $getConnection->prepare($sql);
      $stmt->bindParam(":date", $date);
      $stmt->bindParam(":status", $status);

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

  public function getClosedCustomerServiceOnCurrentMonthByWeekend()
  {
    $getConnection = $this->objConnection->getConnection();

    $currentDate = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
    $year = $currentDate->format("Y");
    $month = $currentDate->format("m");

    $date = $year . "-__-__";
    $status = "closed";

    try {
      $sql = "SELECT date FROM customer_service WHERE date LIKE :date and status = :status";
      $stmt = $getConnection->prepare($sql);
      $stmt->bindParam(":date", $date);
      $stmt->bindParam(":status", $status);

      if ($stmt->execute()) {
        $result = $stmt->fetchAll();
        return $result;
      }
    } catch (PDOException $error) {
      echo "Error: " . $error->getMessage();
    }
  }

  public function getClosedCustomerServiceOnCurrentYear()
  {
    $getConnection = $this->objConnection->getConnection();

    $currentDate = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
    $year = $currentDate->format("Y");
    $date = $year . "-__-__";

    try {
      $sql = "SELECT date FROM customer_service WHERE date LIKE :date and status = 'closed' ORDER BY date";

      $stmt = $getConnection->prepare($sql);
      $stmt->bindParam(":date", $date);

      if ($stmt->execute()) {
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        return $result;
      }
    } catch (PDOException $error) {
      echo "Error: " . $error->getMessage();
    }
  }

  public function structureClosedCustomerServiceByMonths()
  {
    $result = $this->getClosedCustomerServiceOnCurrentYear();
    $monthsResult = [];
    $monthArray = [
      "Janeiro" => 0,
      "Fevereiro" => 0,
      "Março" => 0,
      "Abril" => 0,
      "Maio" => 0,
      "Junho" => 0,
      "Julho" => 0,
      "Agosto" => 0,
      "Setembro" => 0,
      "Outubro" => 0,
      "Novembro" => 0,
      "Dezembro" => 0,
    ];


    foreach ($result as $key => $value) {
      $monthsResult[$key] = substr($value, 5, 2);
    }

    for ($i = 0; $i < count($monthsResult); $i++) {
      if ($monthsResult[$i] == 01) {
        $monthArray["Janeiro"]++;
      } else if ($monthsResult[$i] == "02") {
        $monthArray["Fevereiro"]++;
      } else if ($monthsResult[$i] == "03") {
        $monthArray["Março"]++;
      } else if ($monthsResult[$i] == "04") {
        $monthArray["Abril"]++;
      } else if ($monthsResult[$i] == "05") {
        $monthArray["Maio"]++;
      } else if ($monthsResult[$i] == "06") {
        $monthArray["Junho"]++;
      } else if ($monthsResult[$i] == "07") {
        $monthArray["Julho"]++;
      } else if ($monthsResult[$i] == "08") {
        $monthArray["Agosto"]++;
      } else if ($monthsResult[$i] == "09") {
        $monthArray["Setembro"]++;
      } else if ($monthsResult[$i] == "10") {
        $monthArray["Outubro"]++;
      } else if ($monthsResult[$i] == "11") {
        $monthArray["Novembro"]++;
      } else if ($monthsResult[$i] == "12") {
        $monthArray["Dezembro"]++;
      }
    }

    return $monthArray;
  }
}
