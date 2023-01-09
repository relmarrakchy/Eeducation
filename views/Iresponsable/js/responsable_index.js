var xValues0 = [100,200,300,400,500,600,700,800,900,1000];

        new Chart("myChart0", {
        type: "line",
        data: {
            labels: xValues0,
            datasets: [{ 
            data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
            borderColor: "#b91d47",
            fill: false
            }, { 
            data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,7000],
            borderColor: "#00aba9",
            fill: false
            }, { 
            data: [300,700,2000,5000,6000,4000,2000,1000,200,100],
            borderColor: "#2b5797",
            fill: false
            }, { 
            data: [400,900,100,800,6000,500,100,60,200,10],
            borderColor: "#e8c3b9",
            fill: false
            }, { 
            data: [300,800,1000,50,800,200,700,600,20,1000],
            borderColor: "#1e7145",
            fill: false
            }]
        },
        options: {
            legend: {display: true}
        }
        });

        var xValues = ["SVT", "PC", "EX", "SM", "L"];
        var yValues = [55, 49, 44, 24, 15];
        var barColors = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#1e7145"
        ];

        new Chart("myChart", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            title: {
            display: true,
            text: "Nombre des eleves en classes"
            }
        }
        });