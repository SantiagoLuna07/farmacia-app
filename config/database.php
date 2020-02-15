<?php

  class Database {
    private $host;
    private $user;
    private $password;
    private $dbname;
    private $connect;

    function __construct() {
        $this->host = "localhost";
        $this->user = "root";
        $this->password = "theROOTpass$%";
        $this->dbname = "Inventory";

        try {
          // ultimo atributo, evitar errores con las tildes y las Ñ en la base de datos..
          $this->connect = new PDO("mysql:host=$this->host;dbname=$this->dbname",
            $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

          // cambio de error pdo a excepción..
          $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $pE) {
          $exception = $pE->getMessage();
          echo json_encode(['error' => 'Connection Failed' ,'Exception: ' => $exception]);
        }
    }

    public function getConnect() {
      return $this->connect;
    }
  }

 ?>
