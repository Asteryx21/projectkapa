per();
GraphIt();
modalControl();

const picker = new tempusDominus.TempusDominus(document.getElementById('inputDate'), {
    useCurrent: false,
    display: {
        viewMode: "calendar",
        components: {
            decades: false,
            year: false,
            month: true,
            date: true,
            hours: false,
            minutes: false,
            seconds: false
        }
    },
    localization:{
        locale: 'el'
    }
});

picker.dates.formatInput = date => moment(date).format('YYYY-MM-DD')

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

function modalControl(){

    const modal = document.getElementById("exampleModal");
    const btn = document.getElementById("addevent");
    const cancelBtn = document.getElementById("cancel-btn");

    btn.onclick = function() {
    modal.style.display = "block";
    }

    cancelBtn.onclick = function() {
    modal.style.display = "none";
    }

 
    // window.onclick = function(event) {
    //     if (event.target == modal) {
    //         modal.style.display = "none";
    //     }
    // }
}

document.getElementById("form").addEventListener("submit", function(event) {
    event.preventDefault();
    const formData = new FormData(this);

    fetch("post_event.php", {
      method: "POST",
      body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        showSuccessMessage();
    })
    .catch(error => console.error(error));
});

function showSuccessMessage() {
    const successMessage = document.querySelector('.alert-success');
    successMessage.style.display = "block";
    successMessage.textContent = "Το event έγινε upload!";
    setTimeout(() => {
        successMessage.style.opacity = "0";
        successMessage.style.transition = "opacity 0.5s ease-out";
        setTimeout(() => {
            successMessage.style.display = "none";
        }, 500);
    }, 3000);
}