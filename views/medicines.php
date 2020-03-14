<head>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="resources/js/medicines-action.js"></script>
    <script type="text/javascript" src="resources/datatables/js/jquery.datatables.js"></script>
    <link rel="stylesheet" href="resources/datatables/css/jquery.datatables.css"/>
</head>  
<body>
<div class="row">
  <div class="col-lg-5"  >
     <div class="container">
          <button type="button" class="btn btn-dark " data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus"></i> Registrar Medicamentos  
          </button>
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro Clientes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
               <input type="text" class="form-control" id="txtIdMedicine" style="display: none" value="" >
                  <label >Nombre del Medicamento</label>
                    <input type="text" class="form-control" id="txtNombre" placeholder="">
                      <label >Descripcion</label>
                        <input type="text" class="form-control" id="txtDescripcion" placeholder="" >
                          <label >Fecha Expiracion</label>
                             <input id="txtFecha" width="276" placeholder="11/21/1998" />               
                                <script>
                                  $('#txtFecha').datepicker({
                                      uiLibrary: 'bootstrap4'
                                });
                               </script> 
                                  <label >Cantidad</label>    
                                    <input type="number" class="form-control" id="txtCantidad" placeholder="" >
                                      <label >Fecha Fabriacion</label>
                                        <input id="txtFechaFabricacion" width="276" placeholder="11/21/1998" />               
                                            <script>
                                                $('#txtFechaFabricacion').datepicker({
                                                    uiLibrary: 'bootstrap4'
                                              });
                                            </script> 
                                              <label >Precio</label>    
                                                <input type="number" class="form-control" id="txtPrecio" placeholder="" >     
                                                 <div class="form-group ">
                                                  <label for="inputState">Laboratorio</label>
                                                     <select class="form-control" id="txtLaboratorio"   >
                                                        <option value="0">SELECCIONE UNA OPCIÓN</option>
                                                          
                                                      </select>

                                            
                                            <!--    <label for="inputState">Persona</label>
                                              <select class="form-control" id="txtPersona"   >
                                                    <option value="0">SELECCIONE UNA OPCIÓN</option>
                                                        <option value="0">Seleccione un Empleado</option>

                                                </select>
                                              </div>
                                              <input type="number" class="form-control" id="txtPersona" placeholder="" > --> 

           </div>
    

<br>
<div class="botones">
  <button type="button" class="btn btn-primary btn-lg" id="create" >Guardar</button>
  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>   
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
                  Listado de Medicamentos
                </th>
            </tr> 
               <tr>
               <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">fecha de Expiracion</th>
                <th scope="col">fecha de Fabricacion</th>
                <th scope="col">precio</th>
                <th scope="col">labotatorio</th>
               </tr>
         </thead>
           <tbody id="list">
         </tbody>
      </table>
      </div>
     </div>
   </div>
 </div>
</body>
