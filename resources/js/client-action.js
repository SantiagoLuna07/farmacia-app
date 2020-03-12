$(document).ready(function(){
    read();
    $("#btnGuardar").click(create);
  //  $("#btnModificar").click(guardarCliente);
   // $("#btnEliminar").click(eliminarCliente);


});
function create() {
    let user = {
        id:$("#txtIdCliente").val(),
        name:$("#txtNombre").val(),
        lastname:$("#txtApellidos").val(),
        idCard:$("#txtCedula").val(),
        gender:$("#txtGenero").val(),
        birthDate:$("#txtFecha").val(),
        type:'create'
    }
  
    if(1===1){
      $.ajax({
        url: 'controllers/ClientCtrl.php',
        method: 'POST',
        beforeSend: function () {
          $('#progressbarr').removeClass('no-display');
        },
        data: user,
        success: function (resServer) {
          // console.log(resServer);
          let res = JSON.parse(resServer);
          if (res.status === 200) {
            toastr.success('Registrado Con Exito');
            read();
            clean();
          } else {
            toastr.error('ERROR','No se pudo guardar');
           // console.log('0');
          }
          $('#progressbarr').addClass('no-display');
        },
        error: function (jqXRH, textStatus, errorThrown) {
          console.error('error on server: ', textStatus);
          console.error('Exception on server:', errorThrown);
        }
      });
    }else{
      toastr.info('Verifique los datos ingresados','ADVERTENCIA');    }
  
  }
  function read () {
    $.ajax({
      url: 'controllers/ClientCtrl.php',
      method: 'POST',
      data: {type: 'read'},
      success: function(resServer) {
        let res = JSON.parse(resServer);
        // console.log(res);
        let data = JSON.parse(res.data);
  
        let list = "<thead><tr>\n\
                   <th>Codigo</th>\n\
                    <th>Cedula</th>\n\
                    <th>Nombre Completo</th>\n\
                    <th>Genero</th>\n\
                    <th>Fecha Nacimiento</th>\n\
                    <th>Opciones</th>\n\
        </tr></thead>";

        list+= "<tbody>"
        for (element of data) {
          list += '<tr>';
          list += `<td>${element.idClient}</td>`;
          list += `<td>${element.idCard}</td>`;
          list += `<td>${element.name} ${element.lastname}</td>`;
          list += `<td>${element.gender}</td>`;
          list += `<td>${element.birthDate}</td>`;
          list += '<td>';
          list += `<a onclick="readById(${element.idClient})" class="btn btn-dark`
            +' btn-block" data-toggle="modal" data-target="#updelModal" '
            +'style="color: #ffffff">mas opciones..</a>';
          list += '</td>';
          list += '</tr>';
          
        }
        list=list+ "</tbody>";
        $('#list').html(list);
        $('#list').dataTable();

  
      },
      error: function (jqXRH, textStatus, errorThrown) {
        console.error('error on server: ', textStatus);
        console.error('Exception on server:', errorThrown);
      }
    });
  }

  function readById(id) {
    $.ajax({
      url: 'controllers/ClientCtrl.php',
      method: 'POST',
      beforeSend: function () {
        $('#progressbarr').removeClass('no-display');
      },
      data: {id: id, type: 'readById'},
      success: function (resServer) {
        let res = JSON.parse(resServer);
  
        if (res.status === 200) {
          let data = JSON.parse(res.data);
          
          for(element of data) {
            $('#idCardU').val(element.idCard);
            $('#nameU').val(element.name);
            $('#lastnameU').val(element.lastname);
           $('#genderU').val(element.gender);
            $('#txtFechaU').val(element.birthDate);
            $('#progressbarr').addClass('no-display');
          }
          $('#progressbarr').addClass('no-display');
        } else {
          console.log('0');
        }
      },
      error: function (jqXRH, textStatus, errorThrown) {
        console.error('error on server: ', textStatus);
        console.error('Exception on server:', errorThrown);
      }
    });
  }
  

  function clean() {
    $("#txtNombre").val("");
    $("#txtApellidos").val("");
    $("#txtCedula").val("");
    $("#txtGenero").val(0);
    $("#txtFecha").val("12/12/2020");
   
}
/*
function guardarCliente(){
    let objClient={
        id:$("#txtIdCliente").val(),
        name:$("#txtNombre").val(),
        lastname:$("#txtApellidos").val(),
        idCard:$("#txtCedula").val(),
        gender:$("#txtGenero").val(),
        birthDate:$("#txtFecha").val(),
        type:'create'
    };

    console.log(objClient.birthDate);
   if(1===1){
        $.ajax({
          url: 'controllers/ClientCtrl.php',
          method: 'POST',
          beforeSend: function () {
            $('#progressbarr').removeClass('no-display');
          },
          data: user,
          success: function (resServer) {
            // console.log(resServer);
            let res = JSON.parse(resServer);
            if (res.status === 200) {
              toastr.success('Registrado Con Exito');
              read();
              clean();
            } else {
              toastr.error('ERROR','No se pudo guardar');
              console.log('0');
            }
            $('#progressbarr').addClass('no-display');
          },
          error: function (jqXRH, textStatus, errorThrown) {
            console.error('error on server: ', textStatus);
            console.error('Exception on server:', errorThrown);
          }
        });
      }else{
        toastr.info('Verifique los datos ingresados','ADVERTENCIA');
    if(
        objClient.name !=="" &&
        objClient.lastame !== "" &&
        objClient.idCard !== "" &&
        objClient.gender !== "" &&
        objClient.birthDate !== ""
    ){
        if(objClient.id !== ""){
            objClient.type ='update';
        }else{
            objClient.type='save';
        }
        $.ajax({
            type: 'post',
            url:"controllers/ClientCtrl.php",
            beforeSend: function() {},
            data:objClient,
            success:function(data){
                console.log(data);
                var info= JSON.parse(data);
                console.log(info);
                if(info.status ===200){
                    toastr.success('Registrado Con Exito');
                    limpiar();
                    listarClientes();
                }else{
                    toastr.error('ERROR','No se pudo guardar');
                }
            },
            error: (jqXHR, textStatus, errorThrown) =>{
                alert("Error detectado: " + textStatus + "\nException: " + errorThrown);
                alert("verifique la ruta de archivo!");
            }
        });
    }else{
        toastr.info('Verifique los datos ingresados','ADVERTENCIA');  
      }
}

function listarClientes() {
    $.ajax({
        
        type: 'post',
        url:"controllers/ClientCtrl.php",
        beforeSend: function() {

        },
        data: { type: 'list' },

        success: function(respuesta) {
           // console.log(data);
            const res = JSON.parse(respuesta);
            const info = JSON.parse(res.data);

            var lista = "<thead><tr>\n\
                                <th>nombre</th>\n\
                                <th>Apellidos</th>\n\
                                <th>cedula</th>\n\
                                <th>genero</th>\n\
                                <th>Fecha Nacimiento</th>\n\
                                //<th>Opciones</th>\n\
                        </tr></thead>";

            if (info.length > 0) {
                lista=lista + "<tbody>"
                for (k = 0; k < info.length; k++) {
                    lista= lista + '<tr id="idCard" onclick="buscarCliente('+info[k].id+')">';
                    lista = lista + '<td>' + info[k].name + '</td>';
                    lista = lista + '<td>' + info[k].lastname + '</td>';
                    lista = lista + '<td>' + info[k].idCard + '</td>';
                    lista = lista + '<td>' + info[k].gender + '</td>';
                    lista = lista + '<td>' + info[k].birthDate + '</td>';
                    lista= lista + '<td>';
                    lista = lista '<a onclick="buscarCliente('+info[k].id'+)" class="btn btn-primary'
                    +'btn-block" data-toggle="modal" data-target="#exampleModal" 
                    +'style="color:#ffffff"> mas opciones..</a>';
                    lista =lista + '</td>';
                    lista= lista + '</tr>';
                   
                    
                }
                lista=lista + "</tbody>";
                $("#listaClientes").html(lista);
                $("#listaClientes").dataTable();
            } else {
                $("#listaClientes").html("<tr><td>No se encuentra informacion</td>></tr>");
            }
        },
        error: (jqXHR, textStatus, errorThrown) => {
            alert("Error detectado: " + textStatus + "\nException: " + errorThrown);
            alert("verifique la ruta de archivo!");
        }
    });

}

function buscarCliente(idCard) {
    $("#txtIdCliente").val(idCard);
    const objClient = {
        id: $("#txtIdCliente").val(),
        type: 'search'
    };
    var aux = 0
    $.ajax({
        type: 'post',
        url:"controllers/ClientCtrl.php",
        async: false,
        beforeSend: function() {

        },
        data: objClient,
        success: function(res) {
            const info = JSON.parse(res);
            let data;
            if (info.res !== "NotInfo") {
                data = JSON.parse(info.data);
            }
            if (info.status === 200) {
                $("#txtNombre").val(data[0].name);
                $("#txtApellidos").val(data[0].lastname);
                $("#txtCedula").val(data[0].idCard);
                $("#txtGenero").val(data[0].gender);
                $("#txtFecha").val(data[0].birthDate);
                
            } else {
                toastr.info('El Usuario no se encuentra');
                limpiar();
            }
        }
    });
 
}
function eliminarCliente() {
    var dato = $("#txtIdCliente").val();
    if (dato == "") {
        alert("Debe cargar los datos a eliminar");
    } else {
        const objClient = {
            id: dato,
            type: 'delete'
        };

        $.ajax({
            type: 'post',
            url:"controllers/ClientCtrl.php",
            beforeSend: function() {

            },
            data: objClient,
            success: function(res) {
                var info = JSON.parse(res);
                if (info.res == "Success") {
                    limpiar();
                    toastr.success('Eliminado Con Exito');
                    listarClientes();
                } else {
                    toastr.error('ERROR','No se pudo Eliminar');
                    limpiar();
                }
            },
            error: (jqXHR, textStatus, errorThrown) => {
                alert("Error detectado: " + textStatus + "\nException: " + errorThrown);
                alert("verifique la ruta de archivo!");
            }
        });
    }
}



/*
$(document).ready(function() {

    $('#listaClientes').DataTable( {

      "language": {
        "decimal":        ".",
        "emptyTable":     "No hay datos para mostrar",
        "info":           "del _START_ al _END_ (_TOTAL_ total)",
        "infoEmpty":      "del 0 al 0 (0 total)",
        "infoFiltered":   "(filtrado de todas las _MAX_ entradas)",
        "infoPostFix":    "",
        "thousands":      "'",
        "lengthMenu":     "Mostrar _MENU_ entradas",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "zeroRecords":    "No hay resultados",
        "paginate": {
          "first":      "Primero",
          "last":       "Último",
          "next":       "Siguiente",
          "previous":   "Anterior"
        },
        "aria": {
          "sortAscending":  ": ordenar de manera Ascendente",
          "sortDescending": ": ordenar de manera Descendente ",
        }
      }

    } );

} ); // document ready

function abrirModal(){
    $('.openBtn').on('click',function(){
        $('.modal-body').load('content.html',function(){
            $('#myModal').modal({show:true});
        });
    });
    
}*/

