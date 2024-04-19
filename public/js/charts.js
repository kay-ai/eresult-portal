const ctx = document.getElementById('dashboardLineChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Amount of Internet traffic',
            data: [12, 19, 3, 5, 2, 3, 5, 10, 15, 12, 9, 8],
            borderWidth: 2,
            borderColor: '#B33336',
            tension: 0.4
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0,0,0,0.1)',
                    borderColor: 'transparent',
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        },
        plugins: {
            legend: {
                display: false
            }
        },
        maintainAspectRatio: false,
        responsive: true
    }
});
