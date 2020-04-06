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
          <button style="margin: 5px" type="button" class="btn btn-dark " data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus"></i> Registrar Medicamentos  
          </button>
   
          <form name="formPDF" method="post" target="_blank" action="./controllers/ReportCtl.php">
              <input type="text" id="txtReportM" style="display:none" value="medicine()" name="tabla">
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
      <label >Ingrese el caracter por el cual desea delimitar la Informacion</label>
           <input type="text" class="form-control" name="txtCaracter" required>
      </div>
         <input type="text" id="txtReportCsv" style="display:none" value="medicine()" name="tabla">
         <button type="submit" style="margin: 5px" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
         <i class="fas fa-file-csv fa-1x"></i>  Exportar a csv  </button>
       </form>
    </div>
  </div>
</div>      

          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro Inventario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
               <input type="text" class="form-control" id="txtIdMedicine" style="display: none" value="" >
                  <label >Nombre del Medicamento</label>
                    <input type="text" class="form-control" id="txtNombreM" placeholder="">
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
                                               </div>
                                            
                                            <!--    <label for="inputState">Persona</label>
                                              <select class="form-control" id="txtPersona"   >
                                                    <option value="0">SELECCIONE UNA OPCIÓN</option>
                                                        <option value="0">Seleccione un Empleado</option>

                                                </select>
                                             --> 
                                              <input type="number" class="form-control" id="txtPersona" placeholder="" > 

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
          
<div class="col-md-15 mx-auto">
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
                <th scope="col">labotatorio</th>
                <th scope="col">precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Usuario</th>
                <th scope="col">Opciones</th>
               
               </tr>
         </thead>
           <tbody id="list">
         </tbody>
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
          <h5 class="modal-title" id="exampleModalLabel">Inventario</h5>
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
              <label for="nameU">Nombre Medicamento:</label>
              <input type="text" id="nameU" class="form-control" value="">
            </div>
            <div class="form-group">
              <label for="descriptionU">Descripcion:</label>
              <input type="text" id="descriptionU" class="form-control" value="">
            </div>
            
              <div class="form-group">
                <label for="txtFechaExpU">Fecha Expiracion:</label>
                <input type="text" width="276" id="txtFechaExpU" >
                <script>
              $('#txtFechaExpU').datepicker({
                  uiLibrary: 'bootstrap4'
            });
          </script>
              </div>
              <div class="form-group">
                <label for="txtFechaFaU">Fecha Fabricacion:</label>
                <input id="txtFechaFaU" width="276" placeholder="11/21/1998" />           
         <script>
              $('#txtFechaFaU').datepicker({
                  uiLibrary: 'bootstrap4'
            });
          </script>
              </div>  
              <div class="form-group">
                <label for="nameLabU">Laboratorio:</label>
                <input type="text" id="nameLabU" class="form-control">
              </div>
              <div class="form-group">
                <label for="quantityU">Cantidad:</label>
                <input type="text" id="quantityU" class="form-control">
              </div>
              <div class="form-group">
                <label for="priceU">Precio:</label>
                <input type="text" id="priceU" class="form-control">
              </div>
               <div class="form-group">
              <label for="userIdU">Usuario:</label>
              <input type="text" id="userIdU" class="form-control" >
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
