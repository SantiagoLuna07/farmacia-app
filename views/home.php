<head>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    
</head>
<body>
<div class="row">
  <div class="col-lg-5"  >
    
    
    <div class="container">
    <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdown1" data-toggle="dropdown" >
        Registro Medicamentos
      </button>
      <div class="dropdown-menu">
          <form class="pr-4 pl-4">
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
          <option value="Hombre"></option>
          <option value="Mujer"></option>
          <option value="otro"></option>
  </select>
  <label for="inputState">Persona</label>

 <select class="form-control" id="txtPersona"   >
       <option value="0">SELECCIONE UNA OPCIÓN</option>
          <option value="Hombre"></option>
          <option value="Mujer"></option>
          <option value="otro"></option>
  </select>
</div>

<br>
<div class="botones">
  <button type="button" class="btn btn-primary btn-lg" id="btnGuardar" >Guardar</button>
  <button type="button" class="btn btn-success btn-lg" id="btnModificar" >Modificar</button>            
  <button type="button" class="btn btn-danger btn-lg" id="btnEliminar" >Eliminar</button>
</div>

          
      </div>
    </div>  
  </div>
  </div>
    <div class="col-lg-7" >
        <table id="listaMedicamentos" class='display' cellspacing='0' width='100%'>
            <thead class="thead-dark">
               <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">fecha de Expiracion</th>
                <th scope="col">precio</th>
                <th scope="col">labotatorio</th>
               </tr>
         </thead>
        <tbody id="listaMedicamentos">
         </tbody>
        </table>
  </div>
</div>
</body>
