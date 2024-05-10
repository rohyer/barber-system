<?php

class EmployeeModel
{
  private $objConnection;
  private $id;
  private $name;
  private $address;
  private $sex;
  private $birth;
  private $phone;
  private $salary;

  public function __construct()
  {
    require_once dirname(__DIR__) . "/model/ConnectionModel.php";
    $this->objConnection = new ConnectionModel();
  }

  public function read()
  {
    $getConnection = $this->objConnection->getConnection();

    try {
      $sql = "Select name from employee";

      $stmt = $getConnection->prepare($sql);

      if ($stmt->execute()) {
        $result = $stmt->fetchAll();
        return $result;
      }
    } catch (PDOException $error) {
      echo "Error: " . $error->getMessage();
    }
  }
}
