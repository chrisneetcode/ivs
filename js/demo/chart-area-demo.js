// Set default font family and color
Chart.defaults.font.family = 'Nunito, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
Chart.defaults.color = '#858796';

// Number formatting helper
const number_format = (number, decimals = 0, dec_point = '.', thousands_sep = ',') => {
  number = (number + '').replace(',', '').replace(' ', '');
  const n = !isFinite(+number) ? 0 : +number;
  const prec = Math.abs(decimals);
  let s = (prec ? (Math.round(n * Math.pow(10, prec)) / Math.pow(10, prec)).toFixed(prec) : Math.round(n).toString()).split('.');
  s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, thousands_sep);
  if ((s[1] || '').length < prec) s[1] += '0'.repeat(prec - s[1].length);
  return s.join(dec_point);
};

// Area chart
const ctx = document.getElementById("myAreaChart");
if (ctx) {
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      datasets: [{
        label: "Earnings",
        data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
        tension: 0.3,
        fill: true,
        backgroundColor: "rgba(78, 115, 223, 0.05)",
        borderColor: "rgba(78, 115, 223, 1)",
        pointBackgroundColor: "rgba(78, 115, 223, 1)",
        pointBorderColor: "rgba(78, 115, 223, 1)",
        pointRadius: 3,
        pointHoverRadius: 4,
        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
        pointHitRadius: 10,
        pointBorderWidth: 2
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      layout: {
        padding: { top: 25, right: 25, bottom: 0, left: 10 }
      },
      scales: {
        x: {
          grid: { display: false, drawBorder: false },
          ticks: { maxTicksLimit: 7 }
        },
        y: {
          grid: {
            color: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2]
          },
          ticks: {
            maxTicksLimit: 5,
            padding: 10,
            callback: (value) => '$' + number_format(value)
          }
        }
      },
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: "rgb(255,255,255)",
          titleColor: "#6e707e",
          bodyColor: "#858796",
          borderColor: "#dddfeb",
          borderWidth: 1,
          padding: 15,
          displayColors: false,
          mode: 'index',
          intersect: false,
          callbacks: {
            label: (context) => {
              const label = context.dataset.label || '';
              return `${label}: $${number_format(context.parsed.y)}`;
            }
          }
        }
      }
    }
  });
}
