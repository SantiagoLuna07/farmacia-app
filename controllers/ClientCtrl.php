<?php
  require '../DAOs/GenericDAO.php';

  $id = isset($_POST['id'])? $_POST['id'] : '';
  $idCard = isset($_POST['idCard'])? $_POST['idCard'] : '';
  $name = isset($_POST['name'])? $_POST['name'] : '';
  $lastname = isset($_POST['lastname'])? $_POST['lastname'] : '';
  $gender = isset($_POST['gender'])? $_POST['gender'] : '';
  $birthDate = isset($_POST['birthDate'])? $_POST['birthDate'] : '';
  $type = isset($_POST['type'])? $_POST['type'] : '';

  $gdao = new GenericDAO();

  switch ($type) {
    case 'create':
      $gdao->executeFunction('save_client', array($name, $lastname, $idCard,
        $gender, $birthDate), 0);
    break;

    case 'read':
      $gdao->executeProcedure('read_client', null, 0);
    break;

    case 'update':
      $gdao->executeFunction('update_client', array($id, $name, $lastname, $idCard,
        $gender, $birthDate), 0);
    break;

    case 'delete':
      $gdao->executeFunction('delete_client',array($id), 0);
      break;
    case 'readById':
      $gdao->executeProcedure('read_by_id_client',array($id), 0);
      break;

      case 'readGrafico':
        $gdao->executeProcedure('listGeneros',null, 0);
        break;   

  default:
    session_destroy();
    header('location: ../index.php?success-msg=Vuelve pronto');
    break;
  }
 ?>
