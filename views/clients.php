<head>
<script src="resources/js/client-action.js" charset="utf-8"></script>
<script type="text/javascript" src="resources/datatables/js/jquery.datatables.js"></script>
<script type="text/javascript" src="resources/datatables/js/jquery.datatables.js"></script>
<link rel="stylesheet" href="resources/datatables/css/jquery.datatables.css"/>
<link rel="stylesheet" href="resources/css/master.css"/>

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
   <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    
</head>    
<body>
  <div class="container">
   <div class="row">
    <div class="col-lg-5"  >
     
    
<button style="margin: 5px" type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
<i class="fas fa-plus"></i> Registrar Clientes  
</button>
<br>
<form name="formPDF" method="post" target="_blank" action="./controllers/ReportCtl.php">
  <input type="text" id="txtReportC" style="display:none" value="client()" name="tabla">
  <button style="margin: 5px"  type="submit" class="btn btn-dark" data-toggle="modal" >

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
    
         <input type="text" id="txtReportCsv" style="display:none" value="client()" name="tabla">
         <button type="submit" style="margin: 5px" class="btn btn-dark" data-toggle="modal" >
         <i class="fas fa-file-csv fa-1x"></i>  Exportar a csv  </button>
       </form>
      
    </div>
  </div>
</div>




<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <i class="fas fa-user-plus fa-5x"></i><br>
        <h5 class="modal-title" id="exampleModalLabel">Gestion Clientes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form name="form1">
      <input type="text" class="form-control" id="txtIdCliente" style="display: none" value="">
          <label >Nombre</label>
           <input type="text" class="form-control" id="txtNombre" placeholder="Alex">
            <label >Apellidos</label>
             <input type="text" class="form-control" id="txtApellidos" placeholder="castaño" >
              <label >Cedula</label>    
               <input type="number" class="form-control" id="txtCedula" placeholder="12345" >
                <div class="form-group ">
                 <label for="inputState">Genero</label>
                  <select class="form-control" id="txtGenero"   >
                   <option value="0">SELECCIONE UNA OPCIÓN</option>
                    <option value="Hombre">Hombre</option>
                    <option value="Mujer">Mujer</option>
                    <option value="otro">otro</option>
                   </select>
       </div>
         <label >Fecha Nacimiento</label>
         <input id="txtFecha" width="276" placeholder="11/21/1998" />           
         <script>
              $('#txtFecha').datepicker({
                  uiLibrary: 'bootstrap4'
            });
          </script>
          <br>
          <div class="botones">
            <button type="button" class="btn btn-success btn-lg" id="btnGuardar" >Guardar</button>
            <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Cerrar</button> 
             </div>
          
          </form>
      </div>
    </div>
  </div>
</div>
</div>
    </div>  
  </div>
</div>
<div class="col-md-12 mx-auto">
      <div class="card mt-2 p-4">
      <table class="table">
     <table id="list" class='display' cellspacing='0' width='100%'>
            <thead class="thead-dark">
            <tr>
                <th colspan="7" scope="col" class="text-center">
                  Listado de Clientes
                </th>
            </tr>    
               <tr>
               <th scope="col">Codigo</th>
               <th scope="col">cedula</th>
               <th scope="col">Nombre Completo</th>              
                <th scope="col">genero</th>
                <th scope="col">Fecha Nacimiento</th>
                <th scope="col">Opciones</th>

               </tr>
           </thead>
        <tbody id="list"></tbody>
     </table>
     </div>
     </div>
   </div>
 </div>

 <div class="modal fade" id="updelModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Informacion Del Cliente</h5>
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
                <label for="genderU">Genero:</label>
                <input type="text" id="genderU" class="form-control">
              </div>
              <div class="form-group">
                <label for="txtFechaU">Fecha Nacimiento:</label>
                <input id="txtFechaU" width="276" placeholder="11/21/1998" />           
         <script>
              $('#txtFechaU').datepicker({
                  uiLibrary: 'bootstrap4'
            });
          </script>
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

