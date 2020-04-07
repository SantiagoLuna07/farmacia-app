<?php
  require '../DAOs/GenericDAO.php';

  $id = isset($_POST['id'])? $_POST['id'] : '';
  $idCard = isset($_POST['idCard'])? $_POST['idCard'] : '';
  $name = isset($_POST['name'])? $_POST['name'] : '';
  $lastname = isset($_POST['lastname'])? $_POST['lastname'] : '';
  $username = isset($_POST['username'])? $_POST['username'] : '';
  $email = isset($_POST['email'])? $_POST['email'] : '';
  $password = isset($_POST['password'])? $_POST['password'] : '';
  $type = isset($_POST['type'])? $_POST['type'] : '';

  session_start();
  $gdao = new GenericDAO();

  switch ($type) {
    case 'login':
      if($gdao->login('login_user', array($email, md5($password))) != 0) {
        header('location: ../index.php?success-msg=ingresó');
      } else {
        header('location: ../index.php?error-msg=no ingresó');
      }
      break;

      case 'create':
        $gdao->executeFunction('save_user', array($idCard, $name, $lastname,
          $email, $username, md5($password)), 0);
      break;

      case 'read':
        $gdao->executeProcedure('read_user', null);
      break;

      case 'update':
        $gdao->executeFunction('update_user', array($id, $idCard, $name, $lastname,
          $email, $username), 0);
      break;

      case 'delete':
        $gdao->executeFunction('delete_user',array($id), 0);
        break;
      case 'readById':
        $gdao->executeProcedure('read_by_id_user',array($id));
        break;

    default:
      session_destroy();
      header('location: ../index.php?success-msg=Vuelve pronto');
      break;
  }
 ?>
