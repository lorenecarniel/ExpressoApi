Chart.defaults.global.defaultFontFamily =
  '-apple-system,system-ui,BlinkMacSystemFont,"Poppins",sans-serif';

$.ajax({
  //Enviar requisição e obter
  type: "POST", //Tipo de requisição
  url: "../../Controller/Dashboard/ChartDoughnutCall.php", //Aonde vai estar a ligação com o banco de dados
  dataType: "json", //Qual objeto que irei querer receber
  success: function (data) {
    //Informações que irei receber

    //varrer o data no for
    //for (var i in data) {
    //  console.log(data[i].DISPONIVEL);
    // console.log(data[i].USED);
    //console.log(data[i].REQUESTSQUANTITY);
    //}
    var disponivel = []; //
    var used = []; //
    var extra = [];

    for (var i = 0; i < data.length; i++) {
      //pegando os dados do data

      disponivel.push(data[i].DISPONIVEL); //pega os novos elementos e vai inserindo no array no final
      used.push(data[i].USED); //pega os novos elementos e vai inserindo no array no final
    }
    if (disponivel < 0) {
      extra = -disponivel;
      disponivel = 0;
    } else {
      extra = 0;
    }

    grafic(disponivel, used, extra); //montado o chart com as informações passadas
  },
});

function grafic(disponivel, used, extra) {
  //aonde vai ser criado o gráfico
  var ctx = document.getElementById("myDoughnutChartCall");

  //criação do gráfico
  var myDoughnutChart = new Chart(ctx, {
    type: "doughnut",
    data: {
      labels: ["Disponivel", "Utilizado", "Extra"],
      datasets: [
        {
          data: [disponivel, used, extra],
          backgroundColor: ["#437FDB", "#5FBC63", "#EC6A61"],
        },
      ],
    },
  });
}
