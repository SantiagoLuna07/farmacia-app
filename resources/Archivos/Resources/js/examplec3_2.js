/* global c3 */

//http://c3js.org/gettingstarted.html
//http://c3js.org/examples.html



/*Se define una variable chart, la cual contiene el id del div contenedor y los 
 * datos que tendra la grafica que se generara (datos + nombre columnas), el 
 * tipo es grafico de barras, se indica el grosor de la barra*/

var chart = c3.generate({
    bindto: '#chart',
    data: {
        columns: [
            ['data1', 30, 200, 100, 400, 150, 250],
            ['data2', 130, 100, 140, 200, 150, 50]
        ],
        type: 'bar'
    },
    bar: {
        width: {
            ratio: 0.5
        }        
    }
});



/*Se pueden agregar datos a la grafica de barras*/
function agregarDatos() {
    chart.load({
        columns: [
            ['data3', 130, -150, 200, 300, -200, 100]
        ]
    });
}






/*Se define una variable chart, la cual contiene el id del div contenedor y los 
 * datos que tendra la grafica que se generara (datos + nombre columnas)*/
var chart2 = c3.generate({
    bindto: '#chart2',
    data: {
        columns: [
            ['data1', 30, 200, 100, 400, 150, 250],
            ['data2', 130, 100, 140, 200, 150, 50]
        ],
        type: 'spline'
    }
});





/*Se define una variable chart, la cual contiene el id del div contenedor y los 
 * datos que tendra la grafica que se generara (datos + nombre columnas)*/
var chart3 = c3.generate({
    bindto: '#chart3',
    data: {
        columns: [
            ['data1', 30, 200, 100, 400, 150, 250],
            ['data2', 50, 20, 10, 40, 15, 25]
        ],
        /*Se indica para cada columna el tipo*/
        regions: {
            'data1': [{'start':1, 'end':2, 'style':'dashed'},{'start':3}],
            'data2': [{'end':3}]
        }
    }
});


