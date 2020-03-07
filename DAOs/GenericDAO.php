<?php
  /**
   *
   */
  class GenericDAO {
    private $dbConnection;
    private $connect;

    function __construct() {
      require '../config/Database.php';

      $this->dbConnection = new Database();
      $this->connect = $this->dbConnection->getConnect();
    }

    /**
    * Función que ejecuta una funcion en la base de datos.
    *
    * @param $name Nombre de la funcion.
    * @param $dats Arreglo con los datoS.
    **/
    public function executeFunction($name, $dats) {
        try {
          $query = "SELECT " . $name . "(";
          foreach ($dats as $dat) {
            $query .= "'" . $dat . "',";
          }

          $query = trim($query, ',');
          $query .= ");";

          // echo json_encode(['query' => $query]);

          $stmt = $this->connect->prepare($query);

          if ($stmt->execute()) {
            echo json_encode(['status' => 200]);
          } else {
            echo json_encode(['status' => 409]);
          }
        } catch(PDOException $pE) {
          echo json_encode(['status' => 409, 'Exception' => $pE]);
        }
    }

    /**
    * Función que ejecuta una funcion en la base de datos.
    *
    * @param $name Nombre de la funcion.
    * @param $dats Arreglo con los datoS.
    **/
    public function executeProcedure($name, $dats) {
      try {
        $query;
        if ($dats != null) {
          $query = "CALL " . " " . $name . "(";
          foreach ($dats as $dat) {
            $query .= "'" . $dat . "',";
          }
          $query = trim($query, ',');
          $query .= ");";
        } else {
          $query = "CALL " . $name . "();";
        }

        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($data != null) {
          echo json_encode(['status' => 200, 'data' => json_encode($data)]);
        } else {
          echo json_encode(['status' => 404]);
        }
      } catch(PDOException $pE) {
        echo json_encode(['status' => 409, 'Exception' => $pE]);
      }
    }

    /**
    * Funcion que ejecuta un procedimiento en la base de datos.
    *
    * @param $name nombre de la funcion en la base de datos
    * @param $dats datos
    **/
    public function login($name, $dats) {
      try {
        $query = "CALL " . $name . "(";
        foreach ($dats as $dat) {
          $query .= "'" . $dat . "',";
        }

        $query = trim($query, ',');
        $query .= ");";

        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        while($user_data = $stmt->fetch(PDO::FETCH_ASSOC)){
          $_SESSION['user_id'] = $user_data['idUser'];
          $_SESSION['fullname'] = $user_data['name'] . ' '
            . $user_data['lastname'];

          return 1;
        }

        return 0;
      } catch (PDOException $pE) {
        // echo $pE;
        return false;
      }
    }
  }
 ?>
