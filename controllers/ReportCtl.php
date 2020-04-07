<?php


include '../DAOs/GenericDAO.php';



$tabla = isset($_POST['tabla']) ? $_POST['tabla'] : "";
//$valor = isset($_POST['valor']) ? $_POST['valor'] : "";
$conex = new GenericDAO();
 switch ($tabla) {
 case "user()":$conex->crearReporte();
 break;
case "client()":$conex->crearReporteC();
break; 
case "medicine()":$conex->crearReporteM();
break;
case "sale()":$conex->crearReporteV();
break;
}