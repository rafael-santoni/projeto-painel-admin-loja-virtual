$(document).ready(function() {
    
    charts = {
        initDashboardPageCharts: function(){

            /* ----------==========     Daily Sales Chart initialization    ==========---------- */
    
            dataDailySalesChart = {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul','Ago','Set','Out','Nov','Dez'],
                series: [
                    [120, 2000, 3455, 6754, 8753, 322, 4566,43,54,16000,4000,7889]
                ]
            };
    
            optionsDailySalesChart = {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 0
                }),
                low: 0,
                high: 50000, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                chartPadding: { top: 0, right: 0, bottom: 0, left: 10},
            }
    
            var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);
    
            md.startAnimationForLineChart(dailySalesChart);
            
        }
    };

});