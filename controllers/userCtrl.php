<?php
  require '../models/User.php';
  require '../DAOs/UserDAO.php';

  $id = isset($_POST['id'])? $_POST['id'] : '';
  $identificationCard = isset($_POST['identificationCard'])?
    $_POST['identificationCard'] : '';
  $name = isset($_POST['name'])? $_POST['name'] : '';
  $lastname = isset($_POST['lastname'])? $_POST['lastname'] : '';
  $email = isset($_POST['email'])? $_POST['email'] : '';
  $username = isset($_POST['username'])? $_POST['username'] : '';
  $password = isset($_POST['password'])? $_POST['password'] : '';
  $type = isset($_POST['type'])? $_POST['type'] : '';
  // echo $type;
  session_start();


  $user = new User($id, $identificationCard, $name, $lastname, $email,
    $username, $password);
  $dao = new UserDAO();

  switch ($type) {
    case 'login':
      $user->setPassword(md5($user->getPassword()));
      // $dao->login($user);
      if($dao->login($user)) {
        header('location: ../index.php?success-msg=ingresó');
      } else {
        header('location: ../index.php?error-msg=acceso denegado');
      }
      break;

    default:
      session_destroy();
      header('location: ../index.php?success-msg=Vuelve pronto');
      break;
  }
 ?>
