$(document).ready(function(){
  loadLaboratories();
  loadUsers();
    read();
    $("#create").click(create);
   $("#update").click(modificarr);
    $("#delete").click(eliminar);


});

function modificarr() {
  let user = {
    id: $('#idU').val(),
    name: $('#nameU').val(),
    description: $('#descriptionU').val(),
    expirationDate: $('#txtFechaExpU').val(),
    quantity: $('#quantityU').val(),
    fabricationDate: $('#txtFechaFaU').val(),
    labId: $('#nameLabU').val(),
    price: $('#priceU').val(),
    userId: $('#priceU').val(),
    type: 'update'
  }

  $.ajax({
    url: 'controllers/MedicineCtrl.php',
    method: 'POST',
    beforeSend: function () {
      $('#progress').removeClass('no-display');
    },
    data: user,
    success: function (resServer) {
      let res = JSON.parse(resServer);
      if (res.status === 200) {
        toastr.success('Modificado Con Exito');
        read();
      } else {
        console.log('0');
        console.log(resServer)
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


function eliminar() {
  let country = {
    id: $('#idU').val(),
    type: 'delete'
  };
  $.ajax({
    url: 'controllers/MedicineCtrl.php',
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



function create() {
  let user = {
    idMedicine:$("#txtIdMedicine").val(),
      name:$("#txtNombreM").val(),
      description:$("#txtDescripcion").val(),
      expirationDate:$("#txtFecha").val(),
      quantity:$("#txtCantidad").val(),
      fabricationDate:$("#txtFechaFabricacion").val(),
      price:$("#txtPrecio").val(),
      labId:$("#txtLaboratorio option:selected").val(),
     userId:$("#txtPersona").val(),
    // userId:$("#txtPersona option:selected").val(),
      type:'create'
  }

  if(1===1){
    $.ajax({
      url: 'controllers/MedicineCtrl.php',
      method: 'POST',
      beforeSend: function () {
        $('#progressbarr').removeClass('no-display');
      },
      data: user,
      success: function (resServer) {
         console.log(resServer);
        let res = JSON.parse(resServer);
        console.log(resServer);

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
    toastr.info('Verifique los datos ingresados','ADVERTENCIA');    }

}

function read () {
    $.ajax({
      url: 'controllers/MedicineCtrl.php',
      method: 'POST',
      data: {type: 'read'},
      success: function(resServer) {
        let res = JSON.parse(resServer);
        // console.log(res);
        let data = JSON.parse(res.data);

        let list = "<thead><tr>\n\
                   <th>Codigo</th>\n\
                    <th>Nombre Medicamento</th>\n\
                    <th>Descripcion</th>\n\
                    <th>Fecha Expiracion</th>\n\
                    <th>Fecha Fabricacion</th>\n\
                    <th>Laboratorio</th>\n\
                    <th>Precio</th>\n\
                    <th>Cantidad</th>\n\
                    <th>Usuario</th>\n\
                    <th>Opciones</th>\n\
        </tr></thead>";

        list+= "<tbody>"
        for (element of data) {
          list += '<tr>';
          list += `<td>${element.idMedicine}</td>`;
         list += `<td>${element.name}</td>`;
          list += `<td>${element.description}</td>`;
          list += `<td>${element.expirationDate}</td>`;
          list += `<td>${element.fabricationDate}</td>`;
          list += `<td>${element.laboratory}</td>`;
          list += `<td>${element.price}</td>`;
          list += `<td>${element.quantity}</td>`;
          list += `<td>${element.username}</td>`;


          list += '<td>';
          list += `<a onclick="readById(${element.idMedicine})" class="btn btn-dark`
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
      url: 'controllers/MedicineCtrl.php',
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
            $('#idU').val(element.idMedicine);
            $('#nameU').val(element.name);
            $('#descriptionU').val(element.description);
           $('#txtFechaExpU').val(element.expirationDate);
            $('#txtFechaFaU').val(element.fabricationDate);
            $('#nameLabU').val(element.labId);
            $('#quantityU').val(element.quantity);
            $('#priceU').val(element.price);
            $('#userIdU').val(element.userId);
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


  function loadLaboratories() {
    $.ajax({
      url: 'controllers/MedicineCtrl.php',
      method: 'POST',
      data: { type: 'loadLaboratories'},
      success: function (req) {
        $('#txtLaboratorio option').remove();
        $('#txtLaboratorio').append(`<option value="0">--Seleccione--</option>`);
        const elements = JSON.parse(req);
        console.log(req);
        if (elements.status === 200) {
          let data = elements.data;
          let cities = JSON.parse(data);

          $.each(cities, (key, value)=> {
            $('#txtLaboratorio').append(`<option value="${value.idlaboratory}">${value.name}</option>`);
          })
        } else {
          $('#txtLaboratorio').append(`<option value="0">--No hay laboratorios registradas--</option>`);
        }
      },
      error: function (jqXRH, textStatus, errorThrown) {
        console.error('error on server: ', textStatus);
        console.error('Exception on server:', errorThrown);
      }
    });
  }

  function loadUsers() {
    $.ajax({
      url: 'controllers/MedicineCtrl.php',
      method: 'POST',
      data: { type: 'loadUsers'},
      success: function (req) {
        $('#txtPersona option').remove();
        $('#txtPersona').append(`<option value="0">--Seleccione--</option>`);
        const elements = JSON.parse(req);
        console.log(req);
        if (elements.status === 200) {
          let data = elements.data;
          let cities = JSON.parse(data);

          $.each(cities, (key, value)=> {
            $('#txtPersona').append(`<option value="${value.idUser}">${value.name}</option>`);
          })
        } else {
          $('#txtPersona').append(`<option value="0">--No hay laboratorios registradas--</option>`);
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
    $("#txtDescripcion").val("");
    $("#txtFecha").val("12/12/2020");
    $("#txtCantidad").val(0);
    $("#txtFechaFabricacion").val("12/12/2020");
    $("#txtPrecio").val("0");
    $("#txtLaboratorio").val(0);
    $("#txtPersona").val(0);

  }

  function cleanModal(){
    $("#idU").val("");
    $("#nameU").val("");
    $("#descriptionU").val("");
    $("#quantityU").val("");
    $("#txtFechaExpU").val("");
    $("#txtFechaFaU").val("");
    $("#nameLabU").val(0);
    $("#priceU").val("");

  }
