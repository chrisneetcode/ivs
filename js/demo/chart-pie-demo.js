Chart.defaults.font.family = 'Nunito, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
Chart.defaults.color = '#858796';

const pieCtx = document.getElementById("myPieChart");
if (pieCtx) {
  new Chart(pieCtx, {
    type: 'doughnut',
    data: {
      labels: ["Direct", "Referral", "Social"],
      datasets: [{
        data: [55, 30, 15],
        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
        borderColor: "rgba(234, 236, 244, 1)",
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: "80%",
      plugins: {
        tooltip: {
          backgroundColor: "rgb(255,255,255)",
          titleColor: "#6e707e",
          bodyColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          padding: 15,
          displayColors: false,
          caretPadding: 10
        },
        legend: {
          display: false
        }
      }
    }
  });
}
