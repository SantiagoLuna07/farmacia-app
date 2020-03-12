<?php

  require '../DAOs/GenericDAO.php';

  $id = isset($_POST['idSale'])? $_POST['idSale'] : "";
  $saleDate = isset($_POST['saleDate'])? $_POST['saleDate'] : "";
  $idCardClient = isset($_POST['idCardClient'])? $_POST['idCardClient'] : "";
  $totalValue = isset($_POST['totalValue'])? $_POST['totalValue'] : "";
  $medicines = isset($_POST['medicines'])? $_POST['medicines'] : "";
  $type = isset($_POST['type'])? $_POST['type'] : "";

  $gdao = new GenericDAO();

  switch ($type) {
    case 'create':
      echo $medicines;

      break;

    default:
      // code...
      break;
  }
 ?>
