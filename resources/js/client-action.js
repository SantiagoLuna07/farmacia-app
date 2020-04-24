$(document).ready(function(){
    read();
    
    readGrafica();
    readGrafica2();
    readGrafica3();
    readGrafica4();
    readGrafica5();
    readGrafica6();
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
    let dataProcedimiento={};
    $.ajax({
      url: 'controllers/ClientCtrl.php',
      method: 'POST',
      data: {type: 'readGrafico'},
      success: function(resServer) {
        const res = JSON.parse(resServer);
        dataProcedimiento= JSON.parse(res.data);
        const info =organizarRespuesta();
        grafica(info);

      },
      error: function (jqXRH, textStatus, errorThrown) {
        console.error('error on server: ', textStatus);
        console.error('Exception on server:', errorThrown);
      }
    });

    function organizarRespuesta(){
      let datos=[];
      let hombre=[];
      let mujer=[];
    //  console.log(dataProcedimiento);
for(var j in dataProcedimiento){
  mujer.push(dataProcedimiento[j].Mujeres);
  hombre.push(dataProcedimiento[j].Hombres);
  
 // console.log(name+":"+cantidad);
 /* console.log(hombre);
  console.log(mujer);*/
}

    for(let i=0; i<dataProcedimiento.length; i++){    
     /* datos.push([nombre[i]+":"+cantidad[i],cantidad[i]]);
      let columna=[dataProcedimiento[i].name,dataProcedimiento[i].quantity];
       datos.push(columna);
       
     //  console.log(""+[i]);
       console.log(columna);*/
      datos.push(["Mujeres:"+mujer[i],mujer],["Hombres:"+hombre[i],hombre[i]]);
       console.log(datos);
    }
    return datos;
  }


function grafica(datos){
  var chart2 = c3.generate({
    bindto: '#chart2',
    data: {
        columns:datos,
        type: 'donut',
       
    },
    donut: {
        title: "Estadistica Generos"
    }
});
}
  }

/*
  function organizarGrafica2(){
    let datos=[];
    for(let i=0; i<dataProcedimiento.length; i++){
      let columna=[dataProcedimiento[i].nombre,dataProcedimiento[i].cantidad_ventas];
      datos.push(columna);
    }
    return datos;
  }*/
 
  function readGrafica2 () {
      let dataProcedimiento={};
    $.ajax({
      url: 'controllers/ClientCtrl.php',
      method: 'POST',
      data: {type: 'readGrafico2'},
      success: function(respuesta) {
        const res = JSON.parse(respuesta);
        dataProcedimiento = JSON.parse(res.data);
       // console.log(dataProcedimiento);
        const informacion = organizarRespuesta();
        Grafica(informacion);
   
       


  
      },
      error: function (jqXRH, textStatus, errorThrown) {
        console.error('error on server: ', textStatus);
        console.error('Exception on server:', errorThrown);
      }
    });

    function organizarRespuesta(){
      let datos=[];
      let nombre=[];
      let cantidad=[];
    //  console.log(dataProcedimiento);
for(var j in dataProcedimiento){
  nombre.push(dataProcedimiento[j].name);
  cantidad.push(dataProcedimiento[j].quantity);
 // console.log(name+":"+cantidad);
}

    for(let i=0; i<dataProcedimiento.length; i++){    
     /* datos.push([nombre[i]+":"+cantidad[i],cantidad[i]]);
      let columna=[dataProcedimiento[i].name,dataProcedimiento[i].quantity];
       datos.push(columna);
       
     //  console.log(""+[i]);
       console.log(columna);*/
      datos.push([nombre[i]+":"+cantidad[i],cantidad[i]]);
     //  console.log(datos);
    }
    return datos;
  }

  function Grafica(datos){
    var chart3 = c3.generate({
            
      bindto: '#chart3',
      data: {
          columns: datos,                        
          type: 'donut', 
      },
      donut: {
        title: "Productos/Cantidad"
    }
     
  });
  }

  }

  

  function readGrafica3 () {
    let dataProcedimiento2={};
    $.ajax({
      url: 'controllers/ClientCtrl.php',
      method: 'POST',
      data: {type: 'readGrafico4'},
      success: function(resServer) {
        const res = JSON.parse(resServer);
      //   console.log(res);
        dataProcedimiento2 = JSON.parse(res.data);
        const informacion2= organziar();
        llenarGrafico(informacion2);
       // console.log(res.data);    
      
      },
      error: function (jqXRH, textStatus, errorThrown) {
        console.error('error on server: ', textStatus);
        console.error('Exception on server:', errorThrown);
      }
    });

function organziar(){
  let datos=[];
  let cantidad=[];
  let nombre=[];
  let total=[];

  for(var k in dataProcedimiento2){
    cantidad.push(dataProcedimiento2[k].cantidad_ventas);
    nombre.push(dataProcedimiento2[k].name);
    total.push(dataProcedimiento2[k].total);
   /* console.log(cantidad);
    console.log(nombre);
    console.log(total);*/
  }

  for(let i=0; i<dataProcedimiento2.length; i++){  
    //let columna=[dataProcedimiento2[i].name,dataProcedimiento2[i].cantidad_ventas,dataProcedimiento2[i].total];
     datos.push(["cantidad de ventas de "+nombre[i]+" son "+cantidad[i],cantidad[i]+" y un total de "+total[i],total[i]]);
     //console.log(cantidad);
     
   //  console.log(""+[i]);
   //  console.log(datos);
  }
  return datos;
}


function llenarGrafico(datos){
  var chart4 = c3.generate({
    bindto: '#chart4',
    data: {
        columns: datos,
        type: 'bar',
      },      
      
      });
}

  }



  function readGrafica4 () {
    let dataProcedimiento3={};
    $.ajax({
      url: 'controllers/ClientCtrl.php',
      method: 'POST',
      data: {type: 'readGrafico3'},
      success: function(resServer) {
        const res = JSON.parse(resServer);
      //   console.log(res);
        dataProcedimiento3 = JSON.parse(res.data);
        const informacion3= organziar();
       // console.log(dataProcedimiento3);
        llenarGrafico2(informacion3);
      //  console.log(res.data);    
      
      },
      error: function (jqXRH, textStatus, errorThrown) {
        console.error('error on server: ', textStatus);
        console.error('Exception on server:', errorThrown);
      }
    });

function organziar(){
  let cantidad=[];
  let precio=[];
  let nombre=[];
  let datos=[];
  let total=[];

for(var k in dataProcedimiento3){
  cantidad.push(dataProcedimiento3[k].cuantity);
  precio.push(dataProcedimiento3[k].price);
  nombre.push(dataProcedimiento3[k].name);
  total.push(dataProcedimiento3[k].total);

}

  for(let i=0; i<dataProcedimiento3.length; i++){    
   /* let columna=[dataProcedimiento3[i].name,dataProcedimiento3[i].cuantity,dataProcedimiento3[i].price,dataProcedimiento3[i].total];
     datos.push(columna);
     
    // console.log(""+[i]);
     console.log(columna);*/
     datos.push(["El precio de "+nombre[i]+" es "+precio[i],precio[i],cantidad[i],total[i]]);
  }
  return datos;
}


function llenarGrafico2(datos){
   var chart5 = c3.generate({
            
      bindto: '#chart5',
      data: {
          columns: datos,                        
          type: 'bar', 
          types: {
            data3: 'spline',
            data4: 'line',
            data6: 'area',
        },
        groups:{datos
        }
      }
     
     
  });
  }
  }



 function readGrafica5 () {
    let dataProcedimiento4={};
    $.ajax({
      url: 'controllers/ClientCtrl.php',
      method: 'POST',
      data: {type: 'readGrafico5'},
      success: function(resServer) {
        const res = JSON.parse(resServer);
      //   console.log(res);
        dataProcedimiento4 = JSON.parse(res.data);
        const informacion4= organziar();
       // console.log(dataProcedimiento3);
        llenarGrafico3(informacion4);
      //  console.log(res.data);    
      
      },
      error: function (jqXRH, textStatus, errorThrown) {
        console.error('error on server: ', textStatus);
        console.error('Exception on server:', errorThrown);
      }
    });

function organziar(){
  let datos=[];
  let mes=[];

  for(var k in dataProcedimiento4){
    mes.push(dataProcedimiento4[k].Mes);
  }
  
  for(let i=0; i<dataProcedimiento4.length; i++){    
   /* let columna=[dataProcedimiento4[i].Dia,dataProcedimiento4[i].Mes,dataProcedimiento4[i].NumVentas,dataProcedimiento4[i].VentaTotal];*/
  datos.push([mes[i]+"/"+dataProcedimiento4[i].Dia,dataProcedimiento4[i].NumVentas,dataProcedimiento4[i].VentaTotal]);
   //  datos.push(columna);
     
    // console.log(""+[i]);
   //  console.log(columna);
  }
  return datos;
}


function llenarGrafico3(datos){
   var chart6 = c3.generate({
            
      bindto: '#chart6',
      data: {
          columns: datos,                        
          type: 'bar', 
          types: {
            datos: 'spline',
            datos: 'line',
            datos: 'area',
        },
        groups:{datos
        }
      }
     
     
  });
  }
  }


  function readGrafica6 () {
    let dataProcedimiento4={};
    $.ajax({
      url: 'controllers/ClientCtrl.php',
      method: 'POST',
      data: {type: 'readGrafico6'},
      success: function(resServer) {
        const res = JSON.parse(resServer);
      //   console.log(res);
        dataProcedimiento4 = JSON.parse(res.data);
        const informacion4= organziar();
       // console.log(dataProcedimiento3);
        llenarGrafico3(informacion4);
      //  console.log(res.data);    
      
      },
      error: function (jqXRH, textStatus, errorThrown) {
        console.error('error on server: ', textStatus);
        console.error('Exception on server:', errorThrown);
      }
    });

function organziar(){
  let datos=[];
  let dia=[];
  let cantidad=[];

  for(var k in dataProcedimiento4){
    dia.push(dataProcedimiento4[k].dia);
    cantidad.push(dataProcedimiento4[k].cantidad);

  }
  
  for(let i=0; i<dataProcedimiento4.length; i++){    
   /* let columna=[dataProcedimiento4[i].Dia,dataProcedimiento4[i].Mes,dataProcedimiento4[i].NumVentas,dataProcedimiento4[i].VentaTotal];*/
  datos.push(["la cantidad de ventas fueron: "+cantidad[i]+" en el dia "+dataProcedimiento4[i].dia,dataProcedimiento4[i].cantidad,dataProcedimiento4[i].total]);
   //  datos.push(columna);
     
    // console.log(""+[i]);
   //  console.log(columna);
  }
  return datos;
}


function llenarGrafico3(datos){
   var chart7 = c3.generate({
            
      bindto: '#chart7',
      data: {
          columns: datos,                        
          type: 'bar', 
          types: {
            datos: 'spline',
            datos: 'line',
            datos: 'area',
        },
        groups:{datos
        }
      }
     
     
  });
  }
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