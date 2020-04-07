<?php

  require '../DAOs/GenericDAO.php';

  $id = isset($_POST['idSale'])? $_POST['idSale'] : '';
  $saleDate = isset($_POST['saleDate'])? $_POST['saleDate'] : '';
  $idCardClient = isset($_POST['idCardClient'])? $_POST['idCardClient'] : '';
  $totalValue = isset($_POST['totalValue'])? $_POST['totalValue'] : '';
  $medicines = isset($_POST['medicines'])? $_POST['medicines'] : '';
  $userId = isset($_SESSION['user_id'])? $_SESSION['user_id'] : '1';
  $type = isset($_POST['type'])? $_POST['type'] : '';

  $gdao = new GenericDAO();

  switch ($type) {
    case 'create':
      $medicines2 = json_decode($medicines, true);
      $res = false;

      if($gdao->executeFunction('save_sale',
        array($saleDate, $totalValue, $idCardClient, $userId), 1)) {
        $resSet = $gdao->executeProcedure('read_last_id_sale', array($saleDate, $idCardClient), 1);
        $idSale = $resSet[0]['id'];
        $success = true;

        foreach ($medicines2 as $medicine) {
          if (($gdao->executeFunction('save_sale_detail', array($medicine['id'],
            $medicine['quant'], $idSale), 1)) == null) {
              // TODO: eliminar venta.
              $success = false;
              break;
          }
        }

        if ($success) {
          echo json_encode(['status' => 200]);
        } else {
          echo json_encode(['status' => 400, 'msg' => 'error: medicaments']);
        }
      } else {
        echo json_encode(['status' => 400, 'msg' => 'error: sale']);
      }
      break;

    default:
      // code...
      break;
  }
 ?>
