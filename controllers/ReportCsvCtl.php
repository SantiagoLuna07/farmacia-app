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
case "sale()":$conex->crearReporteVCSV();
break;
case "sale1()":$conex->crearReporteConsulta();
break;
case "sale2()":$conex->crearReporteVCsv2();
break;
case "sale3()":$conex->crearReporteVCsv3();
break;
case "sale4()":$conex->crearReporteVCsv4();
break;
}