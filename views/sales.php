<head>
<script type="text/javascript" src="resources/js/sales-action.js"></script>
        <script type="text/javascript" src="resources/datatables/js/jquery.datatables.js"></script>
        <script type="text/javascript" src="resources/datatables/js/jquery.datatables.js"></script>
        <link rel="stylesheet" href="resources/datatables/css/jquery.datatables.css"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="row">
    <div class="col-md-12 mx-auto">
      <div class="card">
        <div class="card-header">
        <i class="fas fa-capsules fa-7x"></i>
          <h5>Gestión Ventas</h5>
        </div>
        <form>
          <div class="card-body">
             <div class="row">
               <div class="col-md-4">
                 <div class="form-group">
                   <label for="saleDate">Fecha de la Venta:</label>
                   <input type="date" name="saleDate" id="saleDate" class="form-control">
                 </div>
                 <div class="form-group">
                   <label for="idCardClient">Cedula del Cliente:</label>
                   <input type="number" name="idCardClient" id="idCardClient" class="form-control">
                 </div>
                 <hr>
                 <form>
                   <div class="form_group">
                     <label for="idMedicine">Codigo medicamento</label>
                     <input type="number" name="idMedicine" id="idMedicine" class="form_control">
                   </div>
                   <br>
                   <a id="addMedicine" class="btn btn-primary btn-block my-auto"
                    style="color: #ffffff;">Agregar</a>
                 </form>
               </div>
               <div class="col-md-8" style="border-left: 1px solid #b1b1b1">
                 <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">Codigo #</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Cant. Disponible</th>
                      <th scope="col">Precio</th>
                      <th scope="col">Cant. a vender</th>
                    </tr>
                  </thead>
                  <tbody id="medicinesList">
                  </tbody>
                </table>
               </div>
              <!--<div class="col-md-6">
                <div class="form-group">
                <label >Fecha Venta</label>
         <input id="txtFechaVenta" width="276" placeholder="11/21/1998" />
         <script>
              $('#txtFechaVenta').datepicker({
                  uiLibrary: 'bootstrap4'
            });
          </script>
                </div>
                <div class="form-group ">
                     <label for="inputState">Cliente</label>
                      <select class="form-control" id="txtCliente"   >
                          <option value="0">SELECCIONE UN CLIENTE</option>
                        </select>
                 </div>
                 <div class="form-group">
                  <label for="">Cantidad:</label>
                  <input type="number" id="Cantidad" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Medicamento:</label>
                  <input type="text" id="medicamento" class="form-control"
                    placeholder="Ingresa el nombre de medicamento">
                </div>
                <div class="form-group ">
                     <label for="inputState">Medicamento</label>
                      <select class="form-control" id="txtMedicamento"   >
                          <option value="0">SELECCIONE UN Medicamento</option>
                        </select>
                 </div>

                <div class="form-group">
                  <label for="">Valor Venta:</label>
                  <input type="number" id="txtVenta" class="form-control"
                    placeholder="Ingresa el valor de la venta">
                </div>

              </div>-->
            </div>
            <div id="progressbarr" class="progress no-display">
              <div class="progress-bar progress-bar-striped progress-bar-animated"
                role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                  style="width: 100%"></div>
            </div>
          </div>
          <div class="card-footer text-right">
            <a id="create" class="btn btn-success"
              style="color: #ffffff"> <i class="fas fa-save fa-2x"></i></a>
            <a id="cancel" class="btn btn-danger"
              style="color: #ffffff"><i class="fas fa-broom fa-2x"></i></a>

          </div>

        </form>
      </div>
    </div>
  </div>
<form name="formPDF" method="post" target="_blank" action="./controllers/ReportCtl.php">
  <input type="text" id="txtReportU" style="display:none" value="saleV()" name="tabla">
  <button type="submit" style="margin: 5px" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">

<i class="fas fa-file-pdf "></i> Exportar a PDF  </button>

</form>

<form name="formPDF" method="post" target="_blank" action="./controllers/ReportCtl.php">
  <input type="text" id="txtReportU" style="display:none" value="saleDV()" name="tabla">
  <button type="submit" style="margin: 5px" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">

<i class="fas fa-file-pdf "></i> Exportar a PDF DV </button>

</form>

<button style="margin: 5px" type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal2">

<i class="fas fa-file-csv fa-1x"></i> Exportar a csv
</button>

<div class="modal" tabindex="-1" role="dialog" id="exampleModal2">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Exportar a CSV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form name="formCsv" method="post" target="_blank" action="./controllers/ReportCsvCtl.php">
      <label >Ingrese el caracter por el cual desea delimitar la Informacion</label>
           <input type="text" class="form-control" name="txtCaracter" required>
      </div>

         <input type="text" id="txtReportCsv" style="display:none" value="sale()" name="tabla">
         <button type="submit" style="margin: 5px" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
         <i class="fas fa-file-csv fa-1x"></i>  Exportar a csv  </button>
       </form>

    </div>
  </div>
</div>
<button style="margin: 5px" type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal6">

<i class="fas fa-file-csv fa-1x"></i> Exportar a csv DV
</button>

<div class="modal" tabindex="-1" role="dialog" id="exampleModal6">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Exportar a CSV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form name="formCsv" method="post" target="_blank" action="./controllers/ReportCsvCtl.php">
      <label >Ingrese el caracter por el cual desea delimitar la Informacion</label>
           <input type="text" class="form-control" name="txtCaracter" required>
      </div>

         <input type="text" id="txtReportCsv" style="display:none" value="SaleDV()" name="tabla">
         <button type="submit" style="margin: 5px" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
         <i class="fas fa-file-csv fa-1x"></i>  Exportar a csv  </button>
       </form>

    </div>
  </div>
</div>

        <button style="margin: 5px" type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal1">

<i class="fas fa-file-csv fa-1x"></i> Exportar a csv 1
</button>

        <div class="modal" tabindex="-1" role="dialog" id="exampleModal1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Exportar a CSV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form name="formCsv" method="post" target="_blank" action="./controllers/ReportCsvCtl.php">
      <label >Ingrese el caracter por el cual desea delimitar la Informacion</label>
           <input type="text" class="form-control" name="txtCaracter" required>
      </div>

         <input type="text" id="txtReportCsv" style="display:none" value="sale1()" name="tabla">
         <button type="submit" style="margin: 5px" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
         <i class="fas fa-file-csv fa-1x"></i>  Exportar a csv  </button>
       </form>

    </div>
  </div>
</div>

<button style="margin: 5px" type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal3">

<i class="fas fa-file-csv fa-1x"></i> Exportar a csv 2
</button>

<div class="modal" tabindex="-1" role="dialog" id="exampleModal3">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Exportar a CSV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form name="formCsv" method="post" target="_blank" action="./controllers/ReportCsvCtl.php">
      <label >Ingrese el caracter por el cual desea delimitar la Informacion</label>
           <input type="text" class="form-control" name="txtCaracter" required>
      </div>

         <input type="text" id="txtReportCsv" style="display:none" value="sale2()" name="tabla">
         <button type="submit" style="margin: 5px" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
         <i class="fas fa-file-csv fa-1x"></i>  Exportar a csv  </button>
       </form>

    </div>
  </div>
</div>

<button style="margin: 5px" type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal4">

<i class="fas fa-file-csv fa-1x"></i> Exportar a csv 3
</button>

<div class="modal" tabindex="-1" role="dialog" id="exampleModal4">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Exportar a CSV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form name="formCsv" method="post" target="_blank" action="./controllers/ReportCsvCtl.php">
      <label >Ingrese el caracter por el cual desea delimitar la Informacion</label>
           <input type="text" class="form-control" name="txtCaracter" required>
      </div>

         <input type="text" id="txtReportCsv" style="display:none" value="sale3()" name="tabla">
         <button type="submit" style="margin: 5px" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
         <i class="fas fa-file-csv fa-1x"></i>  Exportar a csv  </button>
       </form>

    </div>
  </div>
</div>

<button style="margin: 5px" type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal5">

<i class="fas fa-file-csv fa-1x"></i> Exportar a csv 4
</button>

<div class="modal" tabindex="-1" role="dialog" id="exampleModal5">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Exportar a CSV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form name="formCsv" method="post" target="_blank" action="./controllers/ReportCsvCtl.php">
      <label >Ingrese el caracter por el cual desea delimitar la Informacion</label>
           <input type="text" class="form-control" name="txtCaracter" required>
      </div>

         <input type="text" id="txtReportCsv" style="display:none" value="sale4()" name="tabla">
         <button type="submit" style="margin: 5px" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
         <i class="fas fa-file-csv fa-1x"></i>  Exportar a csv  </button>
       </form>

    </div>
  </div>
</div>

  <div class="row">
    <div class="col-md-12 mx-auto">

      <div class="card mt-2 p-4">

      <table class="table">

          <table id="list" class='display' cellspacing='0' width='100%'>
            <thead class="thead-dark">
              <tr>
                <th colspan="7" scope="col" class="text-center">
                  Listado de Usuarios
                </th>
              </tr>
              <tr>
                <th scope="col">Fecha Venta</th>
                <th scope="col">Valor Venta</th>
                <th scope="col">Cliente</th>
                <th scope="col">Opciones</th>
              </tr>
            </thead>
            <tbody id="list">

            </tbody>
          </table>
      </div>
    </div>
  </div>
  <!-- options modal -->
  <div class="modal fade" id="updelModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Informacion Del Usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form>
          <div class="modal-body">
            <div class="form-group">
              <label for="idU">Codigo:</label>
              <input type="text" id="idU" class="form-control" disabled>
            </div>
              <div class="form-group">
                <label for="idCardU">Cedula:</label>
                <input type="number" id="idCardU" class="form-control">
              </div>
            <div class="form-group">
              <label for="nameU">Nombre:</label>
              <input type="text" id="nameU" class="form-control" value="">
            </div>
            <div class="form-group">
              <label for="lastnameU">Apellidos:</label>
              <input type="text" id="lastnameU" class="form-control" value="">
            </div>
            <div class="form-group">
              <label for="emailU">Correo electronico:</label>
              <input type="email" id="emailU" class="form-control" value="">
            </div>
            <div class="form-group">
              <label for="usernameU">Nombre de usuario:</label>
              <input type="text" id="usernameU" class="form-control" value="">
            </div>
            <hr>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" id="delete" class="btn btn-danger">Eliminar</button>
            <button type="button" id="update" class="btn btn-success">Guardar Cambios</button>
          </div>
        </form>
      </div>
    </div>
  </div>



</body>
