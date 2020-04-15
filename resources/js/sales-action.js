$(document).ready(() => {
    loadClients();
    $('#create').click(create);
    $('#update').click(update);
    $('#delete').click(deletee);
    $('#cancel').click(clean);
    read();
  });


  function loadClients() {
    $.ajax({
      url: 'controllers/saleCtrl.php',
      method: 'POST',
      data: { type: 'loadClients'},
      success: function (req) {
        $('#txtCliente option').remove();
        $('#txtCliente').append(`<option value="0">--Seleccione--</option>`);
        const elements = JSON.parse(req);
        console.log(req);
        if (elements.status === 200) {
          let data = elements.data;
          let cities = JSON.parse(data);

          $.each(cities, (key, value)=> {
            $('#txtCliente').append(`<option value="${value.idCard}">${value.idCard}</option>`);
          })
        } else {
          $('#txtCliente').append(`<option value="0">--No hay Clientes registrados--</option>`);
        }
      },
      error: function (jqXRH, textStatus, errorThrown) {
        console.error('error on server: ', textStatus);
        console.error('Exception on server:', errorThrown);
      }
    });


  }


  function create() {
    let user = {
        saleDate: $('#txtFechaVenta').val(),
        idCardClient: $('#txtCliente option:selected').val(),
        totalValue: $('#txtVenta').val(),
        medicines: $('#usernameC').val(),
        type: 'create'
    }

    if(1==1){
      $.ajax({
        url: 'controllers/userCtrl.php',
        method: 'POST',
        beforeSend: function () {
          $('#progressbarr').removeClass('no-display');
        },
        data: user,
        success: function (resServer) {
           console.log(resServer);
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
      toastr.info('Verifique los datos ingresados','ADVERTENCIA');    }

  }


  function read () {
    $.ajax({
      url: 'controllers/SaleCtrl.php',
      method: 'POST',
      data: {type: 'read_sales'},
      success: function(resServer) {
        let res = JSON.parse(resServer);
        // console.log(res);
        let data = JSON.parse(res.data);

        let list = "<thead><tr>\n\
                        <th>Fecha Venta</th>\n\
                        <th>Valor Venta</th>\n\
                        <th>Cliente</th>\n\
                        <th>Opciones</th>\n\
                    </tr></thead>";

       list+= "<tbody>"
        for (element of data) {
          list += '<tr>';
          list += `<td>${element.saleDate}</td>`;
          list += `<td>${element.totalValue}</td>`;
          list += `<td>${element.client} </td>`;
          list += '<td>';
          list += `<a onclick="readById(${element.idCard})" class="btn btn-dark`
            +' btn-block" data-toggle="modal" data-target="#updelModal" '
            +'style="color: #ffffff">mas opciones..</a>';
          list += '</td>';
          list += '</tr>';

        }
        list+= "<tbody>"
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
      url: 'controllers/userCtrl.php',
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
            $('#idU').val(element.idUser);
            $('#idCardU').val(element.idCard);
            $('#nameU').val(element.name);
            $('#lastnameU').val(element.lastname);
            $('#emailU').val(element.email);
            $('#usernameU').val(element.username);
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
      email: $('#emailU').val(),
      username: $('#usernameU').val(),

      type: 'update'
    }

    $.ajax({
      url: 'controllers/userCtrl.php',
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
      url: 'controllers/userCtrl.php',
      method: 'POST',
      beforeSend: function () {
        $('#progress').removeClass('no-display');
      },
      data: country,
      success: function (resServer) {
        let res = JSON.parse(resServer);
        if (res.status === 200) {

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

  function valPass() {
    if ($('#passwordC').val() === $('#password2C').val()) {
      $('#password').addClass('is-valid');
      $('#password2').addClass('is-valid');
      return true;
    } else {
      $('#password').addClass('is-invalid');
      $('#password2').addClass('is-invalid');
      return false;
    }
  }

  function clean() {
    $('#idCardC').val('');
    $('#idCardC').removeClass('is-valid');
    $('#idCardC').removeClass('is-invalid');
    $('#nameC').val('');
    $('#nameC').removeClass('is-valid');
    $('#nameC').removeClass('is-invalid');
    $('#lastnameC').val('');
    $('#lastnameC').removeClass('is-valid');
    $('#lastnameC').removeClass('is-invalid');
    $('#usernameC').val('');
    $('#usernameC').removeClass('is-valid');
    $('#usernameC').removeClass('is-invalid');
    $('#emailC').val('');
    $('#emailC').removeClass('is-valid');
    $('#emailC').removeClass('is-invalid');
    $('#passwordC').val('');
    $('#passwordC').removeClass('is-valid');
    $('#passwordC').removeClass('is-invalid');
    $('#password2C').val('');
    $('#password2C').removeClass('is-valid');
    $('#password2C').removeClass('is-invalid');
  }
