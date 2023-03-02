per();
GraphIt();

async function per(){
    const response = await fetch('participants.php');
    const data = await response.json();

    // Initialize empty arrays for the names and counts
    const names = [];
    const counts = [];

    // Loop through the data object and extract the name and count properties into separate arrays
    data.forEach(item => {
        names.push(item.name);
        counts.push(item.count);
    });


    return {names, counts};
}


async function GraphIt(){

    const data = await per();

    const canvas = document.getElementById('myChart');
    const myChart = new Chart(canvas, {
        type: 'bar',
        data: {
            labels: data.names,//["January", "February", "March", "April", "May", "June", "July"],//
            datasets: [{
                barThickness: 100,
                label: 'Συμμετοχές',
                data: data.counts,//[10, 20, 30, 40, 50, 60, 70],
                backgroundColor: 'rgb(42, 206, 78, 0.5)',
                barThickness: 50 // set the bar width to 30 pixels
            }]
        },
        options: {
            responsive: true, // Make the canvas responsive
            maintainAspectRatio: false, // Don't maintain aspect ratio
       
            scales: {
                x:{
                    // barPercentage: 51,
                    // categoryPercentage: 51
                },
                y: {
                    ticks: {
                        stepSize: 1,
                        // callback: function(value, index, ticks) {
                        //     return '#' + value + '#';
                        // }
                    }
                }
            },
            onResize: function(chart, size) {
                var width = size.width;
                var barWidth;
                if (width >= 1200) {
                    barWidth = 70;
                } else if (width >= 768) {
                    barWidth = 50;
                } else {
                    barWidth = 25;
                }
                chart.options.plugins.tooltip.position = 'nearest';
                chart.options.plugins.tooltip.mode = 'index';
                chart.options.plugins.tooltip.intersect = false;
                chart.options.plugins.tooltip.backgroundColor = '#FFF';
                chart.options.plugins.tooltip.borderColor = '#000';
                chart.options.plugins.tooltip.borderWidth = 1;
                chart.options.plugins.tooltip.titleColor = '#000';
                chart.options.plugins.tooltip.bodyColor = '#000';
                chart.options.plugins.tooltip.footerColor = '#000';
                chart.data.datasets.forEach((dataset) => {
                    dataset.barThickness = barWidth;
                });
                chart.update();
            }
        }
    });
    // Render the chart
    myChart.update();
}
