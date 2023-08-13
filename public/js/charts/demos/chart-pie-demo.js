

var ctx = document.getElementById('myPieChart').getContext('2d');
var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Alpha', 'Beta', 'Gamma', 'Delta'],
        datasets: [{
            data: [27.21, 15.58, 11.25, 8.32],
            backgroundColor: [primaryColor, infoColor, secondaryColor, warningColor],
        }],
    },
});
