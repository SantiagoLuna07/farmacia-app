<?php
  require '../DAOs/GenericDAO.php';

  $id = isset($_POST['id'])? $_POST['id'] : '';
  $name = isset($_POST['name'])? $_POST['name'] : '';
  $description = isset($_POST['description'])? $_POST['description'] : '';
  $expirationDate = isset($_POST['expirationDate'])? $_POST['expirationDate'] : '';
  $quantity = isset($_POST['quantity'])? $_POST['quantity'] : '';
  $fabricationDate = isset($_POST['fabricationDate'])? $_POST['fabricationDate'] : '';
  $price = isset($_POST['price'])? $_POST['price'] : '';
  $labId = isset($_POST['labId'])? $_POST['labId'] : '';
  $userId = isset($_POST['userId'])? $_POST['userId'] : '';
  $type = isset($_POST['type'])? $_POST['type'] : '';

  $gdao = new GenericDAO();

  switch ($type) {
      case 'create':
        $gdao->executeFunction('save_medicine', array($name, $description,
          $expirationDate, $quantity, $fabricationDate, $price, $labId, $userId), 0);
      break;

      case 'read':
      $gdao->executeProcedure('read_medicine', null);
      break;

      case 'update':
        $gdao->executeFunction('update_medicine',array($id, $name, $description,
          $expirationDate, $quantity, $fabricationDate, $price, $labId, $userId), 0);
      break;

      case 'delete':
        $gdao->executeFunction('delete_medicine', array($id), 0);
        break;

      case 'readById':
        $gdao->executeProcedure('read_by_id_medicine', array($id));
        break;

      case 'loadLaboratories':
        $gdao->executeProcedure('read_laboratories', null);
        break;

    default:
      echo $type;
      break;
  }
 ?>
