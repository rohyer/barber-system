<?php
namespace Guilherme\Barbersystem\model;
use \PDO;

class ConnectionModel {
  private $dsn;
  private $user;
  private $pass;

  public function __construct() {
    $this->dsn = "mysql:host=localhost;dbname=barbersystem";
    $this->user = "root";
    $this->pass = "";
  }

  public function getConnection() {
    try {
      $pdo = new PDO($this->dsn, $this->user, $this->pass);
      return $pdo;
    } catch(PDOException $error) {
      echo "Error: " . $error->getMessage();
    }
  }
}