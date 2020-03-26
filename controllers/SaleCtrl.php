<?php

  require '../DAOs/GenericDAO.php';

  $id = isset($_POST['idSale'])? $_POST['idSale'] : "";
  $saleDate = isset($_POST['saleDate'])? $_POST['saleDate'] : "";
  $idCardClient = isset($_POST['idCardClient'])? $_POST['idCardClient'] : "";
  $totalValue = isset($_POST['totalValue'])? $_POST['totalValue'] : "";
  $medicines = isset($_POST['medicines[]'])? $_POST['medicines[]'] : "";
  $userId = isset($_SESSION['user_id'])? $_SESSION['user_id'] : '1';
  $type = isset($_POST['type'])? $_POST['type'] : "";

  $gdao = new GenericDAO();

  switch ($type) {
    case 'create':
      // echo json_decode($medicines);

      $gdao->executeFunction('save_sale', array($saleDate, $totalValue,
        $idCardClient, $userId, $medicines));
      break;

    default:
      // code...
      break;
  }
 ?>
