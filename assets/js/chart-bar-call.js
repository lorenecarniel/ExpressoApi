Chart.defaults.global.defaultFontFamily =
  '-apple-system,system-ui,BlinkMacSystemFont,"Poppins",sans-serif';

$.ajax({
  /*Enviar requisição e obter */ type: "POST" /*Tipo de requisição */,
  url:
    "../../Controller/Dashboard/ChartBarCall.php" /*Aonde vai estar a ligação com o banco de dados */,
  dataType: "json" /*Qual objeto que irei querer receber */,
  success: function (data) {
    /*Informações que irei receber */

    //varrer o data no for
    //for (var i in data) {
    //console.log(data[i].MONTH);
    //console.log(data[i].USED);
    // }
    var months = [];
    var used = [];
    var fullMonths = [
      "Jan",
      "Fev",
      "Mar",
      "Abr",
      "Mai",
      "Jun",
      "Jul",
      "Ago",
      "Set",
      "Out",
      "Nov",
      "Dez",
    ]; //criando array para colocar os meses por extenso porém abreviado
    for (var i = 0; i < data.length; i++) {
      //pegando os dados do data

      months.push(data[i].MONTH); //pega os novos elementos e vai inserindo no array no final
      used.push(data[i].USED); //pega os novos elementos e vai inserindo no array no final
    }

    //alterando o número do mês para o mês por extenso porém abreviado
    for (var i = 0; i < months.length; i++) {
      if (months[i] == 1) {
        months[i] = fullMonths[0];
      } else if (months[i] == 2) {
        months[i] = fullMonths[1];
      } else if (months[i] == 3) {
        months[i] = fullMonths[2];
      } else if (months[i] == 4) {
        months[i] = fullMonths[3];
      } else if (months[i] == 5) {
        months[i] = fullMonths[4];
      } else if (months[i] == 6) {
        months[i] = fullMonths[5];
      } else if (months[i] == 7) {
        months[i] = fullMonths[6];
      } else if (months[i] == 8) {
        months[i] = fullMonths[7];
      } else if (months[i] == 9) {
        months[i] = fullMonths[8];
      } else if (months[i] == 10) {
        months[i] = fullMonths[9];
      } else if (months[i] == 11) {
        months[i] = fullMonths[10];
      } else if (months[i] == 12) {
        months[i] = fullMonths[11];
      }
    }
    graficBarCall(months, used); //montado o chart com as informações passadas
  },
});

function graficBarCall(months, used) {
  //aonde vai ser criado o gráfico
  var ctx = document.getElementById("myBarChartCall");
  //criação do gráfico
  var myLineChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: months,
      datasets: [
        {
          label: "Chamadas",
          backgroundColor: "#5FBC63",
          data: used,
        },
      ],
    },
    options: {
      scales: {
        xAxes: [
          {
            time: {
              unit: "week",
            },
            gridLines: {
              display: false,
            },
            ticks: {
              maxTicksLimit: 12,
            },
          },
        ],
        yAxes: [
          {
            ticks: {
              min: 0,
              max: 100,
              maxTicksLimit: 6,
            },
            gridLines: {
              display: true,
            },
          },
        ],
      },
      legend: {
        display: false,
      },
    },
  });
}
