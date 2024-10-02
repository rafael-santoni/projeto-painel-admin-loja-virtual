$(document).ready(function() {

    var loadChart = function(retorno) {

        /* ----------==========     Daily Sales Chart initialization    ==========---------- */
        
        dataDailySalesChart = {
            labels: retorno.meses,
            series: [
                retorno.valores
            ]
        };

        optionsDailySalesChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
            }),
            low: 0,
            high: retorno.max+100, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: { top: 0, right: 0, bottom: 0, left: 10},
        }

        var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

        md.startAnimationForLineChart(dailySalesChart);
        
    };
    
    charts = {
        initDashboardPageCharts: function(){

            $.ajax({
                url: '/chart/mes',
                dataType: 'json',
                success: function(retorno) {
                    // console.log(retorno);
                    
                    loadChart(retorno);
                }
            });

        }
    };

});