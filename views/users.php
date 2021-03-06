<html>
<head>
<script type="text/javascript" src="resources/datatables/js/jquery.datatables.js"></script>
<link rel="stylesheet" href="resources/datatables/css/jquery.datatables.css"/>

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="resources/js/users-action.js" charset="utf-8"></script>
<script src="https://kit.fontawesome.com/34f588a8ba.js" crossorigin="anonymous"></script>
<!--<script type="text/javascript" src="resources/datatables/js/jquery.datatables.js"></script>
<script type="text/javascript" src="resources/datatables/js/jquery.datatables.js"></script>
<link rel="stylesheet" href="resources/datatables/css/jquery.datatables.css"/>-->

</head>
<body>
  <div class="row">
    <div class="col-md-8 mx-auto">
      <div class="card">
        <div class="card-header">
        <i class="fas fa-users-cog fa-7x"></i>
          <h5>Gestión Usuarios</h5>
        </div>
        <form>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="idCardC">Cedula:</label>
                  <input type="number" id="idCardC" class="form-control"
                    placeholder="Ingresa el numero de Cedula">
                </div>
                <div class="form-group">
                  <label for="nameC">Nombre:</label>
                  <input type="text" id="nameC" class="form-control"
                    placeholder="Ingresa Nombre">
                </div>
                <div class="form-group">
                  <label for="">Apellido:</label>
                  <input type="text" id="lastnameC" class="form-control"
                    placeholder="Ingresa el Apellido">
                </div>
                <div class="form-group">
                  <label for="">Nombre de usuario:</label>
                  <input type="text"id="usernameC" class="form-control"
                    placeholder="Ingresa el Nombre de usuario">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Correo electronico:</label>
                  <input type="email" id="emailC" class="form-control"
                    placeholder="Ingresa el Correo electronico">
                </div>
                <div class="form-group">
                  <label for="">Contreseña:</label>
                  <input type="pa ssword" id="passwordC" class="form-control"
                    placeholder="Ingresa la Contreseña">
                </div>
                <div class="form-group">
                  <label for="">Confirmar contraseña:</label>
                  <input type="password" id="password2C" class="form-control"
                    placeholder="Confirma tu contraseña">
                </div>
              </div>
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
  <input type="text" id="txtReportU" style="display:none" value="user()" name="tabla">
  <button type="submit" style="margin: 5px" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">

<i class="fas fa-file-pdf "></i> Exportar a PDF  </button>

</form>
<button style="margin: 5px" type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal1">

<i class="fas fa-file-csv fa-1x"></i> Exportar a csv 
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
      <label >Ingrese el caracter por el cual desea separar la Informacion</label>
      <div class="form-check">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="txtCaracter" value=";">Delimitado por ";"
  </label>
</div>
<div class="form-check">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="txtCaracter"value=",">Delimitado por ","
  </label>
</div>
<div class="form-check disabled">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="txtCaracter"value=":">Delimitado por ":"
  </label>
</div> 
      </div>
    
         <input type="text" id="txtReportCsv" style="display:none" value="user()" name="tabla">
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
                <th scope="col">Codigo</th>
                <th scope="col">Cedula</th>
                <th scope="col">Nombre Completo</th>
               <!-- <th scope="col">Apellidos</th>-->
                <th scope="col">Correo Electronico</th>
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

</html>
