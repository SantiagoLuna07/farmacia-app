$(document).ready(function(){
    
    readGrafica2();


});
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
          bindto: '#chart3',
          data: {
              columns: [
                  ["Producto",info[0]],                  
                  ["Cantidad",info[0]]             
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
