<head>
<!--script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="resources/datatables/js/jquery.datatables.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    
<script src="https://kit.fontawesome.com/34f588a8ba.js" crossorigin="anonymous"></script>-->
<script src="resources/js/client-action.js" charset="utf-8"></script>
<script type="text/javascript" src="resources/datatables/js/jquery.datatables.js"></script>

<script type="text/javascript" src="resources/datatables/js/jquery.datatables.js"></script>
    <link rel="stylesheet" href="resources/datatables/css/jquery.datatables.css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    
</head>    
<body>
  <div class="container">
   <div class="row">
    <div class="col-lg-5"  >
     
    
<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
<i class="fas fa-plus"></i> Registrar Clientes  
</button>

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
            <button type="button" class="btn btn-primary btn-lg" id="btnGuardar" >guardar</button>
            <button type="button" class="btn btn-success btn-lg" id="btnModificar" >Modificar</button>            
            <button type="button" class="btn btn-danger btn-lg" id="btnEliminar" >Eliminar</button>
          </div>
          
          </form>
      </div>
     <!-- <div class="modal-footer">
      
            <a id="create" class="btn btn-success"
              style="color: #ffffff"> <i class="fas fa-save fa-2x"></i></a>
            <a id="btnModificar" class="btn btn-primary"
              style="color: #ffffff"><i class="fas fa-edit fa-2x"></i></a>
              <a id="btnEliminar" class="btn btn-danger"
              style="color: #ffffff"><i class="fas fa-user-times fa-2x"></i></a>


          
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>   -->   
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
            <div class="form-group">
                <label for="idCardU">Cedula:</label>
                <input type="number" id="idCardU" class="form-control">
              </div>
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

