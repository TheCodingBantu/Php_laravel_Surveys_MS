function SentimentLineChart(positive,negative){


var chLine = document.getElementById("sentimentLineChart");

// chart colors
var colors = ['#00ac69','#f44336','#333333','#c3e6cb','#dc3545','#6c757d'];


var chartData = {
    labels : ["J", "F", "M", "A", "M", "J", "J", "A", "S", "O", "N", "D"],
  datasets: [{
    data: positive,
    backgroundColor: 'transparent',
    borderColor: colors[0],
    borderWidth: 3,
    pointBackgroundColor: colors[0]
  },
  {
    data: negative,
    backgroundColor: 'transparent',
    borderColor: colors[1],
    borderWidth: 3,
    pointBackgroundColor: colors[1]
  }]
};

if (chLine) {
  new Chart(chLine, {
  type: 'line',
  data: chartData,
  options: {
    scales: {
      yAxes: [{
        gridLines: {
            color: 'rgba(0, 0, 0, .075)',
        },
        
        ticks: {
          beginAtZero: true
        }
      }],
      xAxes:[{
        gridLines: {
            display: false
        },
      }]
    },
    legend: {
      display: false
    }
  }
  });
}

    
}


function feedbackPie(input){
    /* chart.js chart examples */
    
    // chart colors
    var colors = ['#0565F4','#04BBD3','#eeb036'];
    
    
    /* 3 donut charts */
    var donutOptions = {
      cutoutPercentage: 0, 
      legend: {position:'right', padding:5, labels: {pointStyle:'circle', usePointStyle:true}}
    };
    
    // donut 1
    var chDonutData1 = {
        labels: ['Male', 'Female', 'Other'],
        datasets: [
          {
            backgroundColor: colors.slice(0,2),
            borderWidth: 0,
            data:input
          }
        ]
    };
    
    var chDonut1 = document.getElementById("genderPie");
    if (chDonut1) {
      new Chart(chDonut1, {
          type: 'pie',
          data: chDonutData1,
          options: donutOptions
      });
    }
    
    
    }

function responsePie(input){
/* chart.js chart examples */

// chart colors
var colors = ['#DA3D43','#04B06C','#eeb036'];


/* 3 donut charts */
var donutOptions = {
  cutoutPercentage: 70, 
  legend: {position:'right', padding:5, labels: {pointStyle:'circle', usePointStyle:true}}
};

// donut 1
var chDonutData1 = {
    labels: ['Negative', 'Positive'],
    datasets: [
      {
        backgroundColor: colors.slice(0,2),
        borderWidth: 0,
        data:input
      }
    ]
};

var chDonut1 = document.getElementById("chDonut1");
if (chDonut1) {
  new Chart(chDonut1, {
      type: 'pie',
      data: chDonutData1,
      options: donutOptions
  });
}


}