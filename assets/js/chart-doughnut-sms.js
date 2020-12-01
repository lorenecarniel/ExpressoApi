Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Poppins",sans-serif';

//aonde vai ser criado o gráfico
var ctx = document.getElementById("myDoughnutChartSms");

//criação do gráfico
var myDoughnutChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Contratado", "Utilizado", "Extra"],
    datasets: [{
      data: [12, 55, 20],
      backgroundColor: ['#A6D4FA', '#81C784', '#E57373'],
    }],
  },
});
