$(document).ready(() => {
  $('#create').click(create);
  $('#update').click(update);
  $('#delete').click(deletee);
  $('#cancel').click(clean);
  read();
});

function create() {
  let user = {
    idCard: $('#idCardC').val(),
    name: $('#nameC').val(),
    lastname: $('#lastnameC').val(),
    username: $('#usernameC').val(),
    email: $('#emailC').val(),
    password: $('#passwordC').val(),
    password2: $('#password2C').val(),
    type: 'create'
  }

  if(valPass()){
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
    url: 'controllers/userCtrl.php',
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
                      <th>Correo</th>\n\
                      <th>Opciones</th>\n\
                  </tr></thead>";

     list+= "<tbody>"
      for (element of data) {
        list += '<tr>';
        list += `<td>${element.idUser}</td>`;
        list += `<td>${element.idCard}</td>`;
        list += `<td>${element.name} ${element.lastname}</td>`;
        list += `<td>${element.email}</td>`;
        list += '<td>';
        list += `<a onclick="readById(${element.idUser})" class="btn btn-dark`
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

