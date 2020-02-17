<?php
  /**
   *
   */
  class UserDAO {
    private $dbConnection;
    private $connect;

    function __construct() {
      require '../config/Database.php';

      $this->dbConnection = new Database();
      $this->connect = $this->dbConnection->getConnect();
    }

    public function login($user) {
      try {
        $query = "SELECT idPerson, name, lastname FROM user
          WHERE email = ? AND password = ?";

        $stmt = $this->connect->prepare($query);
        $dats = array($user->getEmail(), $user->getPassword());

        if ($stmt->execute($dats)) {
          while($user_data = $stmt->fetch(PDO::FETCH_ASSOC)){
            $_SESSION['user_id'] = $user_data['idPerson'];
            $_SESSION['fullname'] = $user_data['name'] . ' '
              . $user_data['lastname'];
          }
          return true;
        } else {
          return false;
        }
      } catch (PDOException $pE) {
        // echo $pE;
        return false;
      }
    }
  }

 ?>
