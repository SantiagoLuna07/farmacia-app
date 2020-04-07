<?php


include '../DAOs/GenericDAO.php';



$tabla = isset($_POST['tabla']) ? $_POST['tabla'] : "";
//$valor = isset($_POST['valor']) ? $_POST['valor'] : "";
$conex = new GenericDAO();
 switch ($tabla) {
 case "user()":$conex->crearReporteCsv();
 break;
case "client()":$conex->crearReporteCCsv();
break; 
case "medicine()":$conex->crearReporteMCsv();
break;
case "sale()":$conex->crearReporteVCsv();
break;
}