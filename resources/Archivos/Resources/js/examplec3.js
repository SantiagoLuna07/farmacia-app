/* global c3 */

//http://c3js.org/gettingstarted.html
//http://c3js.org/examples.html



/*Se define una variable chart, la cual contiene el id del div contenedor y los 
 * datos que tendra la grafica que se generara (datos + nombre columnas), el 
 * cual por defecto hace un grafico de lineas*/
var chart = c3.generate({
    bindto: '#chart',
    data: {
        columns: [
            ['data1', 30, 200, 100, 400, 150, 250],
            ['data2', 50, 20, 10, 40, 15, 25],
            ['data3', 32, 87, 13, 83, 11, 72]
        ]
    }
});



/*Se define una variable chart2, el cual contiene el id del div contenedor, 
 * las columnas con sus respectivos valores, el tipo de grafica que en este 
 * caso sera una torta o dona, y se definiran eventos como onclick, onmouseover 
 * y on mouseout. Finalmente un titulo que aparecera de manera permanente*/
var chart2 = c3.generate({
    bindto: '#chart2',
    data: {
        columns: [
            ['data1', 30],
            ['data2', 120]
        ],
        type: 'donut',
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
    donut: {
        title: "Iris Petal Width"
    }
});












/*Para cargar un dataset diferente en la dona*/
function cargarDataset2() {
    /*Se quitan los posibles datos existentes, en este caso data1 y data2*/
    chart2.unload({
        ids: 'data1'
    });
    chart2.unload({
        ids: 'data2'
    });
    /*Despues de medio segundo se carga el nuevo conjunto de datos, debido 
     * a que toca darle tiempo a que quite los datos previos, sin esto 
     * no se refresca correctamente la grafica*/
    setTimeout(function () {
        chart2.load({
            columns: [
                ["setosa", 0.2, 0.2, 0.2],
                ["versicolor", 1.4, 1.5, 1.5],
                ["virginica", 2.5, 1.9, 2.1]
            ]
        });
    }, 500);
}




/*Para cargar un dataset diferente en la dona*/
function cargarDataset1() {
    /*Se quitan los posibles datos existentes, en este caso setosa, versicolor 
     * y virginica*/
    chart2.unload({
        ids: 'setosa'
    });
    chart2.unload({
        ids: 'versicolor'
    });

    chart2.unload({
        ids: 'virginica'
    });

    /*Despues de medio segundo se carga el nuevo conjunto de datos, debido 
     * a que toca darle tiempo a que quite los datos previos, sin esto 
     * no se refresca correctamente la grafica*/
    setTimeout(function () {
        chart2.load({
            columns: [
                ['data1', 30],
                ['data2', 120]
            ]
        });
    }, 500);
}





/*La grafica 3 sera de tipo lineas, y se cargara con un conjunto de datos
 * externo en formato csv*/
var chart3 = c3.generate({
    bindto: '#chart3',
    data: {
        url: 'Resources/data/datos.csv',
        type: 'line'
    }
});
