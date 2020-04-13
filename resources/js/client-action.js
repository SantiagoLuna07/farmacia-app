$(document).ready(function(){
    read();
    readGrafica();
    $("#btnGuardar").click(create);
   $("#update").click(update);
    $("#delete").click(deletee);


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
           console.log(resServer);
          let res = JSON.parse(resServer);
          console.log(res);
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
      //   console.log(res);
        let data = JSON.parse(res.data);
      //  console.log(res.data);
  
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
 


  function readGrafica () {
    $.ajax({
      url: 'controllers/ClientCtrl.php',
      method: 'POST',
      data: {type: 'readGrafico'},
      success: function(resServer) {
        let res = JSON.parse(resServer);
         console.log(res);
        let info = JSON.parse(res.data);
        console.log(res.data);    
        if(info.length>0){

       
        var chart2 = c3.generate({
          bindto: '#chart2',
          data: {
              columns: [
                  ["Hombres",info[0].Hombres],                  
                  ["Mujeres",info[0].Mujeres]             
              ],
              type: 'donut',
             
          },
          donut: {
              title: "Estadistica Generos"
          }
      });
    }

  
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
            $('#idU').val(element.idClient);
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

  function update() {
    let user = {
      id: $('#idU').val(),
      idCard: $('#idCardU').val(),
      name: $('#nameU').val(),
      lastname: $('#lastnameU').val(),
      gender: $('#genderU').val(),
      birthDate: $('#txtFechaU').val(),
      type: 'update'
    }
  
    $.ajax({
      url: 'controllers/ClientCtrl.php',
      method: 'POST',
      beforeSend: function () {
        $('#progress').removeClass('no-display');
      },
      data: user,
      success: function (resServer) {
        let res = JSON.parse(resServer);
        console.log(res);
        if (res.status === 200) {
          toastr.success('Modificado Con Exito');
          read();
        } else {
          console.log('0');
          toastr.error('ERROR','No se pudo Modificar');
        }
        $('#progress').addClass('no-display');
      },
      error: function (jqXRH, textStatus, errorThrown) {
        console.error('error on server: ', textStatus);
        console.error('Exception on server:', errorThrown);
      }
    });
  }
  
  function deletee() {
    let country = {
      id: $('#idU').val(),
      type: 'delete'
    };
    $.ajax({
      url: 'controllers/ClientCtrl.php',
      method: 'POST',
      beforeSend: function () {
        $('#progress').removeClass('no-display');
      },
      data: country,
      success: function (resServer) {
        let res = JSON.parse(resServer);
        if (res.status === 200) {
          read();
          cleanModal();
          toastr.success('Se elimino Con Exito');
          read();
        } else {
          console.log('0');
          toastr.error('ERROR','No se pudo Eliminar');
        }
        $('#progress').addClass('no-display');
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

  function cleanModal(){
    $("#idU").val("");
    $("#idCardU").val("");
    $("#nameU").val("");
    $("#lastnameU").val("");
    $("#genderU").val(0);
    $("#txtFechaU").val("");
  }