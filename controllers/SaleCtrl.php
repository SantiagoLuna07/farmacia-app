<?php

  require '../DAOs/GenericDAO.php';

  $id = isset($_POST['idSale'])? $_POST['idSale'] : "";
  $saleDate = isset($_POST['saleDate'])? $_POST['saleDate'] : "";
  $idCardClient = isset($_POST['idCardClient'])? $_POST['idCardClient'] : "";
  $totalValue = isset($_POST['totalValue'])? $_POST['totalValue'] : "";
  $medIds = isset($_POST['medIds'])? $_POST['medIds'] : "";
  $medQuant = isset($_POST['medQuant'])? $_POST['medQuant'] : "";
  $userId = isset($_SESSION['user_id'])? $_SESSION['user_id'] : '1';
  $type = isset($_POST['type'])? $_POST['type'] : "";

  $gdao = new GenericDAO();

  switch ($type) {
    case 'create':
      $ids = (array) json_decode($medIds, true);
      var_dump($ids);
      // $quants = (array) json_decode($medQuant, true);
      //
      // $gdao->executeFunction('save_sale', array($saleDate, $totalValue,
      //   $idCardClient, $userId, $ids, $quants));
      break;

    default:
      // code...
      break;
  }
 ?>
