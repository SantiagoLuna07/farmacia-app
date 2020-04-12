/* global c3 */

/*Se define una variable chart, la cual contiene el id del div contenedor y los 
 * datos que tendra la grafica que se generara (datos + nombre columnas), el 
 * cual por defecto hace un grafico de lineas*/

var chart = c3.generate({
    bindto: '#chart',
    data: {
        columns: [
            ['data1', 300, 350, 300, 0, 0, 0],
            ['data2', 130, 100, 140, 200, 150, 50]
        ],
        /*Se definen tipos especificos para cada conjunto de datos*/
        types: {
            data1: 'area',
            data2: 'area-spline'
        }
    }
});




var char2 = c3.generate({
    bindto: '#chart2',
    data: {
        columns: [
            ['data1', 300, 350, 300, 0, 0, 120],
            ['data2', 130, 100, 140, 200, 150, 50]
        ],
        /*Se definen tipos especificos para cada conjunto de datos*/
        types: {
            data1: 'area-spline',
            data2: 'area-spline'                    
        },
        /*Se definen los colores para conjunto de datos diferente*/
        groups: [['data1', 'data2']]
    }
});





/*Se define el valor del KPI, con tu respectivo tipo. Se pueden definir 
 * eventos sobre el */
var chart4 = c3.generate({
    bindto: '#chart4',
    data: {
        columns: [
            ['data', 91.4]
        ],
        type: 'gauge',
        onclick: function (d, i) {
            console.log("onclick", d, i);
        },
        onmouseover: function (d, i) {
            console.log("onmouseover", d, i);
        },
        onmouseout: function (d, i) {
            console.log("onmouseout", d, i);
        }
    },
    color: {
        /*Gama de colores para los valores definidos (Rojo, naranja, amarillo, 
         * verde)*/
        pattern: ['#FF0000', '#F97600', '#F6C600', '#60B044'], 
        threshold: {
            values: [30, 60, 90, 100]
        }
    },
    /*Tamaño del KPI*/
    size: {
        height: 180
    }
});


/*Funciones que cambiar los valores para ver el comportamiento del KPI*/
setTimeout(function () {
    chart4.load({
        columns: [['data', 10]]
    });
}, 1000);

setTimeout(function () {
    chart4.load({
        columns: [['data', 50]]
    });
}, 2000);

setTimeout(function () {
    chart4.load({
        columns: [['data', 70]]
    });
}, 3000);

setTimeout(function () {
    chart4.load({
        columns: [['data', 0]]
    });
}, 4000);

setTimeout(function () {
    chart4.load({
        columns: [['data', 100]]
    });
}, 5000);


