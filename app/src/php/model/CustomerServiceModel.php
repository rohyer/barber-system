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
  private $objConnection;

  public function __construct()
  {
    $this->objConnection = new ConnectionModel();
  }

  public function read()
  {
    $getConnection = $this->objConnection->getConnection();

    try {
      $sql = "SELECT id, date, time, id_service, id_client FROM customer_service";

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
}
