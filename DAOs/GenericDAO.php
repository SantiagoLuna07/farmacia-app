<?php
  /**
   *
   */
  class GenericDAO {
    private $dbConnection;
    private $connect;
    
    

    function __construct() {
      require_once('../resources/html2pdf_4.0/html2pdf.class.php');
      require '../config/Database.php';

      $this->dbConnection = new Database();
      $this->connect = $this->dbConnection->getConnect();
    
        
        
    }

    /**
    * Función que ejecuta una funcion en la base de datos.
    *
    * @param $name Nombre de la funcion.
    * @param $dats Arreglo con los datoS.
    **/
    public function executeFunction($name, $dats, $opcRes) {
        try {
          $query = "SELECT " . $name . "(";
          foreach ($dats as $dat) {
            $query .= "'" . $dat . "',";
          }

          $query = trim($query, ',');
          $query .= ");";

          // echo json_encode(['query' => $query]);

          $stmt = $this->connect->prepare($query);

          if ($stmt->execute()) {
            if($opcRes == 1) {
              return 1;
            } else {
              echo json_encode(['status' => 200]);
            }
          } else {
            if($opcRes == 1) {
              return 0;
            } else {
              echo json_encode(['status' => 409]);
            }
          }
        } catch(PDOException $pE) {
          echo json_encode(['status' => 409, 'Exception' => $pE]);
        }
    }

    /**
    * Función que ejecuta una funcion en la base de datos.
    *
    * @param $name Nombre de la funcion.
    * @param $dats Arreglo con los datoS.
    **/
    public function executeProcedure($name, $dats, $opcRes) {
      try {
        $query;
        if ($dats != null) {
          $query = "CALL " . " " . $name . "(";
          foreach ($dats as $dat) {
            $query .= "'" . $dat . "',";
          }
          $query = trim($query, ',');
          $query .= ");";
        } else {
          $query = "CALL " . $name . "();";
        }

        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($data != null) {
          if($opcRes == 1) {
            return $data;
          } else {
            echo json_encode(['status' => 200, 'data' => json_encode($data)]);
          }
        } else {
          if($opcRes) {
            return null;
          } else {
            echo json_encode(['status' => 404]);
          }
        }
      } catch(PDOException $pE) {
        echo json_encode(['status' => 409, 'Exception' => $pE]);
      }
    }

    /**
    * Funcion que ejecuta un procedimiento en la base de datos.
    *
    * @param $name nombre de la funcion en la base de datos
    * @param $dats datos
    **/
    public function login($name, $dats) {
      try {
        $query = "CALL " . $name . "(";
        foreach ($dats as $dat) {
          $query .= "'" . $dat . "',";
        }

        $query = trim($query, ',');
        $query .= ");";

        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        while($user_data = $stmt->fetch(PDO::FETCH_ASSOC)){
          $_SESSION['user_id'] = $user_data['idUser'];
          $_SESSION['fullname'] = $user_data['name'] . ' '
            . $user_data['lastname'];

          return 1;
        }

        return 0;
      } catch (PDOException $pE) {
        // echo $pE;
        return false;
      }
    }

    public function crearReporte()
    {
        
        $query = "call read_user();";
        $result = $this->dbConnection->ExecuteReport($query);
        $resultKeys = array_keys($result[0]);
       

        ob_start(); //Habilita el buffer para la salida de datos 
        ob_get_clean(); //Limpia lo que actualmente tenga el buffer
        // //En la variable content entre las etiquetas <page></page> va todo el contenido del pdf en formato html
        $content = "<page backtop='40mm' backbottom='30mm' backleft='20mm' backright='20mm' footer='date;page'>";
        
    

       $content .= "<h1 style='text-align:center';>FARMACIA</font></h1>";
       $content .= "<h3 style='text-align:center';>Reporte Usuarios</h3>";
        $content .= '<link href="../resources/css/tabla.css" type="text/css" rel="stylesheet">';
        
        $content .= "<page_header>
                                <div ><label class='logo'><img src='../resources/imgs/logo.png'></label></div>
             </page_header>";


        $content .= "<table  >";
        $content .= "<tr>";
        for ($i = 1; $i < count($resultKeys); $i++) {
             $content .= "<th>" . $resultKeys[$i] . "</th>";
        }
       
        $content .= "</tr>";
        for ($i = 0; $i < count($result); $i++) {
            $aux = $result[$i];
            for ($j = 1; $j < count($result[$i]); $j++) {
                if ($j == 1) {
                    $content .= "<tr>";
                }
                $b = $resultKeys[$j];
                $content .= "<td>" . $aux[$b] . "</td>";
                if ($j == count($result[$i]) - 1) {
                    $content .= "</tr>";
                }
                
            }
        }
       
        print_r($content);

        $content .= "</table>";
        $content .= "</page>";

      

        $html2pdf = new HTML2PDF('P', 'A4', 'es'); //formato del pdf (posicion (P=vertical L=horizontal), tamaño del pdf, lenguaje)
        $html2pdf->WriteHTML($content); //Lo que tenga content lo pasa a pdf
        ob_end_clean(); // se limpia nuevamente el buffer
        $html2pdf->Output('ReporteUsuario.pdf'); //se genera el pdf, generando por defecto el nombre indicado para guardar

    }

    public function crearReporteM()
    {
        // $sql = "SELECT * FROM " . $tabla;
        $query = "call read_medicine();";
        $result = $this->dbConnection->ExecuteReport($query);
        $resultKeys = array_keys($result[0]);
       // print_r($result);
        // print_r($resultKeys);

        ob_start(); //Habilita el buffer para la salida de datos 
        ob_get_clean(); //Limpia lo que actualmente tenga el buffer
        // //En la variable content entre las etiquetas <page></page> va todo el contenido del pdf en formato html
        $content = "<page backtop='40mm' backbottom='30mm' backleft='20mm' backright='20mm' footer='date;page'>";
        
       
        $content .= "<h1 style='text-align:center';>FARMACIA</font></h1>";
        $content .= "<h3 style='text-align:center';>Reporte Medicamentos</h3>";
         
        $content .= '<link href="../resources/css/tabla.css" type="text/css" rel="stylesheet">';
        $content .='<link href="https://fonts.googleapis.com/css?family=Rock+Salt" rel="stylesheet" type="text/css">';
        $content .= "<page_header>
                    <div ><label class='logo'><img src='../resources/imgs/logo.png'></label></div>
                </page_header>";

                               
        //         <page_footer>
        //             <table style='width: 100%;'>
        //                 <tr>
        //                     <td>
        //                         <div><label class='footer'>Aqui pueden cargar una imagen que va en el footer</label></div>
        //                     </td>                                        
        //                  </tr>
        //             </table>
        //         </page_footer>";

        $content .= "<table >";
        $content .= "<tr >";
        for ($i = 1; $i < count($resultKeys); $i++) {
            // print_r($resultKeys[$i]);
            $content .= "<th>" . $resultKeys[$i] . "</th>";
        }
        // $content .= "<th>Codigo</th>";
        // $content .= "<th>Nombre</th>";
        // $content .= "<th>Apellido</th>";
        // $content .= "<th>Cedula</th>";
        // $content .= "<th>Edad</th>";
        // $content .= "<th>Semestre</th>";
        $content .= "</tr>";
        for ($i = 0; $i < count($result); $i++) {
            $aux = $result[$i];
            for ($j = 1; $j < count($result[$i]); $j++) {
                if ($j == 1) {
                    $content .= "<tr>";
                }
                $b = $resultKeys[$j];
                $content .= "<td>" . $aux[$b] . "</td>";
                if ($j == count($result[$i]) - 1) {
                    $content .= "</tr>";
                }
                // print_r($aux[$b] . $j . "   ");
            }
        }
        print_r($content);
        // for ($cont = 0; $cont < 20; $cont++) {
        //     $content .= "<tr>";
        //     $content .= "<td>Codigo " . $cont . "</td>";
        //     $content .= "<td>Nombre " . $cont . "</td>";
        //     $content .= "<td>Apellido " . $cont . "</td>";
        //     $content .= "<td>Cedula " . $cont . "</td>";
        //     $content .= "<td>Edad " . $cont . "</td>";
        //     $content .= "<td>Semestre " . $cont . "</td>";
        //     $content .= "</tr>";
        // }

        $content .= "</table>";
        $content .= "</page>";


        $html2pdf = new HTML2PDF('P', 'A4', 'es'); //formato del pdf (posicion (P=vertical L=horizontal), tamaño del pdf, lenguaje)
        $html2pdf->WriteHTML($content); //Lo que tenga content lo pasa a pdf
        ob_end_clean(); // se limpia nuevamente el buffer
        $html2pdf->Output('ReporteInventario.pdf'); //se genera el pdf, generando por defecto el nombre indicado para guardar

    }



    public function crearReporteC()
    {
        // $sql = "SELECT * FROM " . $tabla;
        $query = "call read_client();";
        $result = $this->dbConnection->ExecuteReport($query);
        $resultKeys = array_keys($result[0]);
      //  print_r($result);
        // print_r($resultKeys);

        ob_start(); //Habilita el buffer para la salida de datos 
        ob_get_clean(); //Limpia lo que actualmente tenga el buffer
        // //En la variable content entre las etiquetas <page></page> va todo el contenido del pdf en formato html
        $content = "<page backtop='40mm' backbottom='30mm' backleft='20mm' backright='20mm' footer='date;page'>";
        $content .= "<h1 style='text-align:center';>FARMACIA</font></h1>";
       $content .= "<h3 style='text-align:center';>Reporte Clientes</h3>";
        
        $content .= '<link href="../resources/css/tabla.css" type="text/css" rel="stylesheet">';
        
        $content .= "<page_header>
                     <div ><label class='logo'><img src='../resources/imgs/logo.png'></label></div>

                </page_header>";

                               
        //         <page_footer>
        //             <table style='width: 100%;'>
        //                 <tr>
        //                     <td>
        //                         <div><label class='footer'>Aqui pueden cargar una imagen que va en el footer</label></div>
        //                     </td>                                        
        //                  </tr>
        //             </table>
        //         </page_footer>";

        $content .= "<table '>";
        $content .= "<tr >";
        for ($i = 1; $i < count($resultKeys); $i++) {
            
            $content .= "<th>" . $resultKeys[$i] . "</th>";
        }
        
        $content .= "</tr>";
        for ($i = 0; $i < count($result); $i++) {
            $aux = $result[$i];
            for ($j = 1; $j < count($result[$i]); $j++) {
                if ($j == 1) {
                    $content .= "<tr>";
                }
                $b = $resultKeys[$j];
                $content .= "<td>" . $aux[$b] . "</td>";
                if ($j == count($result[$i]) - 1) {
                    $content .= "</tr>";
                }
               
            }
        }
        print_r($content);
       

        $content .= "</table>";
        $content .= "</page>";


        $html2pdf = new HTML2PDF('P', 'A4', 'es'); //formato del pdf (posicion (P=vertical L=horizontal), tamaño del pdf, lenguaje)
        $html2pdf->WriteHTML($content); //Lo que tenga content lo pasa a pdf
        ob_end_clean(); // se limpia nuevamente el buffer
        $html2pdf->Output('ReporteClientes.pdf'); //se genera el pdf, generando por defecto el nombre indicado para guardar

    }

    public function crearReporteV()
    {
        // $sql = "SELECT * FROM " . $tabla;
        $query = "call read_sale();";
        $result = $this->dbConnection->ExecuteReport($query);
        $resultKeys = array_keys($result[0]);
      //  print_r($result);
        // print_r($resultKeys);

        ob_start(); //Habilita el buffer para la salida de datos 
        ob_get_clean(); //Limpia lo que actualmente tenga el buffer
        // //En la variable content entre las etiquetas <page></page> va todo el contenido del pdf en formato html
        $content = "<page backtop='40mm' backbottom='30mm' backleft='20mm' backright='20mm' footer='date;page'>";
        $content .= "<h1 style='text-align:center';>FARMACIA</font></h1>";
       $content .= "<h3 style='text-align:center';>Reporte Ventas</h3>";
        
        $content .= '<link href="../resources/css/tabla.css" type="text/css" rel="stylesheet">';
        
        $content .= "<page_header>
                     <div ><label class='logo'><img src='../resources/imgs/logo.png'></label></div>

                </page_header>";

                               

        $content .= "<table '>";
        $content .= "<tr >";
        for ($i = 1; $i < count($resultKeys); $i++) {
            
            $content .= "<th>" . $resultKeys[$i] . "</th>";
        }
        
        $content .= "</tr>";
        for ($i = 0; $i < count($result); $i++) {
            $aux = $result[$i];
            for ($j = 1; $j < count($result[$i]); $j++) {
                if ($j == 1) {
                    $content .= "<tr>";
                }
                $b = $resultKeys[$j];
                $content .= "<td>" . $aux[$b] . "</td>";
                if ($j == count($result[$i]) - 1) {
                    $content .= "</tr>";
                }
               
            }
        }
        print_r($content);
       

        $content .= "</table>";
        $content .= "</page>";


        $html2pdf = new HTML2PDF('P', 'A4', 'es'); //formato del pdf (posicion (P=vertical L=horizontal), tamaño del pdf, lenguaje)
        $html2pdf->WriteHTML($content); //Lo que tenga content lo pasa a pdf
        ob_end_clean(); // se limpia nuevamente el buffer
        $html2pdf->Output('ReporteClientes.pdf'); //se genera el pdf, generando por defecto el nombre indicado para guardar

    }





    public function crearReporteCCSV()
    {
        // $sql = "SELECT * FROM " . $tabla;
        $query = "call read_client();";
        $result = $this->dbConnection->ExecuteReport($query);
        $resultKeys = array_keys($result[0]);
      //  print_r($result);
        // print_r($resultKeys);

        ob_start(); //Habilita el buffer para la salida de datos 
        ob_get_clean(); //Limpia lo que actualmente tenga el buffer
        // //En la variable content entre las etiquetas <page></page> va todo el contenido del pdf en formato html
        /* Se define la zona horaria en Colombia para generar el archivo */
        date_default_timezone_set("America/Bogota");
        /* Se genera el nombre del archivo con la fecha y hora de la generacion */
        $fileName = 'ReporteClientes'. '-' . date("Y-m-d") . "(" . date("h:i:sa") . ")" . '.csv';
        /* Se define que se retornara un archivo CVS */
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=' . $fileName);

        $caracterSeparado = $_POST['txtCaracter'];
      

        $content = '';
        for ($i = 1; $i < count($resultKeys); $i++) {
         
          $content .=  $resultKeys[$i] .$caracterSeparado;
         
      }
    
      
      for ($i = 0; $i < count($result); $i++) {
          $aux = $result[$i];
          for ($j = 1; $j < count($result[$i]); $j++) {
              if ($j == 1) {
                //  $content .= $caracterSeparado;
                  $content.= "\n";
              }
              $b = $resultKeys[$j];
              $content .=  $aux[$b] . $caracterSeparado;
              if ($j == count($result[$i])) {
               //   $content .= $caracterSeparado;
                  $content.= "\n";
              }
              
          }
      }


        
        echo $content;



    }



    public function crearReporteCsv()
    {
        // $sql = "SELECT * FROM " . $tabla;
        $query = "call read_user();";
        $result = $this->dbConnection->ExecuteReport($query);
        $resultKeys = array_keys($result[0]);
      //  print_r($result);
        // print_r($resultKeys);

        ob_start(); //Habilita el buffer para la salida de datos 
        ob_get_clean(); //Limpia lo que actualmente tenga el buffer
        // //En la variable content entre las etiquetas <page></page> va todo el contenido del pdf en formato html
        /* Se define la zona horaria en Colombia para generar el archivo */
        date_default_timezone_set("America/Bogota");
        /* Se genera el nombre del archivo con la fecha y hora de la generacion */
        $fileName = 'ReporteUsuarios' . '-' . date("Y-m-d") . "(" . date("h:i:sa") . ")" . '.csv';
        /* Se define que se retornara un archivo CVS */
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=' . $fileName);

        $caracterSeparado = $_POST['txtCaracter'];

        $content = '';
        for ($i = 1; $i < count($resultKeys); $i++) {
         
          $content .=  $resultKeys[$i] .$caracterSeparado;
         
      }
    
      
      for ($i = 0; $i < count($result); $i++) {
          $aux = $result[$i];
          for ($j = 1; $j < count($result[$i]); $j++) {
              if ($j == 1) {
                //  $content .= $caracterSeparado;
                  $content.= "\n";
              }
              $b = $resultKeys[$j];
              $content .=  $aux[$b] . $caracterSeparado;
              if ($j == count($result[$i])) {
               //   $content .= $caracterSeparado;
                  $content.= "\n";
              }
              
          }
      }


        
        echo $content;



    }

    public function crearReporteMCsv()
    {
        // $sql = "SELECT * FROM " . $tabla;
        $query = "call read_medicine();";
        $result = $this->dbConnection->ExecuteReport($query);
        $resultKeys = array_keys($result[0]);
      //  print_r($result);
        // print_r($resultKeys);

        ob_start(); //Habilita el buffer para la salida de datos 
        ob_get_clean(); //Limpia lo que actualmente tenga el buffer
        // //En la variable content entre las etiquetas <page></page> va todo el contenido del pdf en formato html
        /* Se define la zona horaria en Colombia para generar el archivo */
        date_default_timezone_set("America/Bogota");
        /* Se genera el nombre del archivo con la fecha y hora de la generacion */
        $fileName = 'ReporteMedicamentos' . '-' . date("Y-m-d") . "(" . date("h:i:sa") . ")" . '.csv';
        /* Se define que se retornara un archivo CVS */
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=' . $fileName);

        $caracterSeparado = $_POST['txtCaracter'];

        $content = '';
        for ($i = 1; $i < count($resultKeys); $i++) {
         
          $content .=  $resultKeys[$i] .$caracterSeparado;
         
      }
    
      
      for ($i = 0; $i < count($result); $i++) {
          $aux = $result[$i];
          for ($j = 1; $j < count($result[$i]); $j++) {
              if ($j == 1) {
                //  $content .= $caracterSeparado;
                  $content.= "\n";
              }
              $b = $resultKeys[$j];
              $content .=  $aux[$b] . $caracterSeparado;
              if ($j == count($result[$i])) {
               //   $content .= $caracterSeparado;
                  $content.= "\n";
              }
              
          }
      }


        
        echo $content;



    }

    public function crearReporteVCsv()
    {
        // $sql = "SELECT * FROM " . $tabla;
        $query = "call read_sale();";
        $result = $this->dbConnection->ExecuteReport($query);
        $resultKeys = array_keys($result[0]);
      //  print_r($result);
        // print_r($resultKeys);

        ob_start(); //Habilita el buffer para la salida de datos 
        ob_get_clean(); //Limpia lo que actualmente tenga el buffer
        // //En la variable content entre las etiquetas <page></page> va todo el contenido del pdf en formato html
        /* Se define la zona horaria en Colombia para generar el archivo */
        date_default_timezone_set("America/Bogota");
        /* Se genera el nombre del archivo con la fecha y hora de la generacion */
        $fileName = 'ReporteVentas' . '-' . date("Y-m-d") . "(" . date("h:i:sa") . ")" . '.csv';
        /* Se define que se retornara un archivo CVS */
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=' . $fileName);

        $caracterSeparado = $_POST['txtCaracter'];

        $content = '';
        for ($i = 1; $i < count($resultKeys); $i++) {
         
          $content .=  $resultKeys[$i] .$caracterSeparado;
         
      }
    
      
      for ($i = 0; $i < count($result); $i++) {
          $aux = $result[$i];
          for ($j = 1; $j < count($result[$i]); $j++) {
              if ($j == 1) {
                //  $content .= $caracterSeparado;
                  $content.= "\n";
              }
              $b = $resultKeys[$j];
              $content .=  $aux[$b] . $caracterSeparado;
              if ($j == count($result[$i])) {
               //   $content .= $caracterSeparado;
                  $content.= "\n";
              }
              
          }
      }


        
        echo $content;



    }

  }
 ?>
