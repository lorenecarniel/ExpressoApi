<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <title>Expresso API</title>
    <link rel="shortcut icon" href="../../assets/images/image-logo.png" />

    <!-- Importação de CSS -->
    <link rel="stylesheet" href="../Dashboard/stylesDashboard.css">


</head>

<body>
    <!-- Dashboard -->
    <div class="h-100 tab-pane active" id="dashboard" role="tabpanel">

        <header class="header">
            <button type="button" class="btn text-info collapse-sidebar">
                <img src="../../assets/icons/menuIcon.svg">
            </button>
            
            <h1>Dashboard</h1>
            
            <a class="exit" href="../index.html">
                <img src="../../assets/icons/log-out.svg" alt="Sair">
                <span class="ml-3 config-span">Sair</span>
            </a>
        </header>

        <main>
            <!-- Conteúdo Dashboard -->
            <div id="layoutSidenav_content">
                <main>
                    <!--Filtro-->
                    <div class="filter">
                        <label>Mês/Ano:
                            <input id="date" type="date">
                            <img src="../../assets/icons/search.svg" alt="Pesquisar" id="buttonFilter">
                        </label>
                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            <!--Card com gráfico de pizza-->
                            <div class="col-lg-6">
                                <div class="card mb-4 doughnut-card">
                                    <div id="first-card" class="card-header" id="card-header-dashboard">
                                        SMS

                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSms">
                                            Detalhes
                                        </button>
                                    </div>

                                    <!--Gráfico de pizza -->
                                    <div class="card-body" id="card-body-sms">
                                        <canvas id="myDoughnutChartSms" width="100%" height="50"></canvas>
                                    </div>

                                    <!--Grid-->
                                    <section class="grid grid-template-columns-4">
                                        <div class="item top first">10000</div>
                                        <div class="item top second">0</div>
                                        <div class="item top third">0</div>
                                        <div class="item down first">CONTRATADO</div>
                                        <div class="item down second">UTILIZADO</div>
                                        <div class="item down third">EXTRAS</div>
                                    </section>
                                </div>

                                <!--Tabela-->
                                <table name="tableSms">
                                    <tr>
                                        <th colspan="2">Resumo do Plano Pacote SMS</th>
                                    </tr>

                                    <tr>
                                        <td>Nome do plano</td>
                                        <td>APP20</td>
                                    </tr>
                                    <tr>
                                        <td>Valor mensal</td>
                                        <td>R$ 500,00</td>
                                    </tr>
                                    <tr>
                                        <td>Valor por mensagem</td>
                                        <td>R$ 0,10</td>
                                    </tr>
                                </table>

                                <!--Card com gráfico de barras-->
                                <div class="card mb-4">
                                    <div class="card-header" id="card-header-dashboard">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        NÚMERO DIÁRIOS DE SMS

                                        <!--ComboBox -->
                                        <select name="weeksSms" id="weeksSms" class="weeks">
                                            <option value="week1">Semana 1</option>
                                            <option value="week2">Semana 2</option>
                                            <option value="week3">Semana 3</option>
                                            <option value="week4">Semana 4</option>
                                        </select>
                                    </div>

                                    <!--Gráfico em barras -->
                                    <div class="card-body" id="card-body-sms"><canvas id="myBarChartSms" width="100%" height="50"></canvas></div>
                                    <div class="average-use">USO MÉDIO DE SMS: 8</div>
                                </div>
                            </div>

                            <!--Card com gráfico de pizza-->
                            <div class="col-lg-6">
                                <div class="card mb-4 doughnut-card">
                                    <div id="first-card" class="card-header" id="card-header-dashboard">
                                        CHAMADAS EXCEDENTES

                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalChamadas">
                                            Detalhes
                                        </button>
                                    </div>

                                    <!--Gráfico de pizza -->
                                    <div class="card-body">
                                        <canvas id="myDoughnutChartCall" width="100%" height="50"></canvas>
                                    </div>

                                    <!--Grid-->
                                    <section class="grid grid-template-columns-4">
                                        <div class="item top first">10000</div>
                                        <div class="item top second">0</div>
                                        <div class="item top third">0</div>
                                        <div class="item down first">CONTRATADO</div>
                                        <div class="item down second">UTILIZADO</div>
                                        <div class="item down third">EXTRAS</div>
                                    </section>

                                </div>

                                <!--Tabela-->
                                <table name="tableCall">
                                    <tr>
                                        <th colspan="2">Resumo das Chamadas Excedentes</th>
                                    </tr>

                                    <tr>
                                        <td>Nome do plano</td>
                                        <td>APP21</td>
                                    </tr>
                                    <tr>
                                        <td>Valor mensal</td>
                                        <td>R$ 250,00</td>
                                    </tr>
                                    <tr>
                                        <td>Valor por mensagem</td>
                                        <td>R$ 0,10</td>
                                    </tr>
                                </table>

                                <!--Card com gráfico em barras-->
                                <div class="card mb-4">
                                    <div class="card-header" id="card-header-dashboard">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        NÚMERO CHAMADAS DIÁRIAS

                                        <!--ComboBox-->
                                        <select name="weeksSms" id="weeksSms" class="weeks">
                                            <option value="week1">Semana 1</option>
                                            <option value="week2">Semana 2</option>
                                            <option value="week3">Semana 3</option>
                                            <option value="week4">Semana 4</option>
                                        </select>
                                    </div>

                                    <!--Gráfico em barras -->
                                    <div class="card-body"><canvas id="myBarChartCall" width="100%" height="50"></canvas></div>
                                    <div class="average-use">MÉDIA DE CHAMADAS DIÁRIAS DE SMS: 8</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

            <!-- Modal de mais detalhes sms-->
            <div class="modal fade" id="modalSms" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <!-- Cabeçalho do modal -->
                        <div class="modal-header">
                            <label for="date input-sm" class="col-xs-2 col-form-label">Mês/Ano</label>

                            <div class="col-xs-2">
                                <input class="form-control ml-3" type="date" id="date">
                            </div>

                            <img src="../../assets/icons/search.svg" class="align-self-center">
                            <img src="../../assets/icons/exit.svg" class="close" data-dismiss="modal" aria-label="Close">
                        </div>

                        <!-- Conteúdo do modal -->
                        <div class="modal-body">
                            <h5 class="font-weight-bolder">Detalhes do Meu Plano SMS em Setembro/2020</h5>
                            <div class="table-responsive-lg">
                                <table id="table-datas" class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Valor Mensal</th>
                                            <th scope="col">Valor Adicional</th>
                                            <th scope="col">Qtde.Máx Extra</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>APP20</td>
                                            <td>R$ 500,00</td>
                                            <td>R$ 0,10</td>
                                            <td>1000</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h5 class="font-weight-bolder">Meu uso</h5>
                                <table id="table-datas" class="table table-striped table-responsive-lg">
                                    <thead>
                                        <tr>
                                            <th scope="col">Quantidade</th>
                                            <th scope="col">Usados</th>
                                            <th scope="col">Disponíveis</th>
                                            <th scope="col">Extras</th>
                                            <th scope="col">Valor Mensal</th>
                                            <th scope="col">Valor Adicional por Extra</th>
                                            <th scope="col">Valor Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>APP20</td>
                                            <td>R$ 500,00</td>
                                            <td>R$ 0,10</td>
                                            <td>1000</td>
                                            <td>APP20</td>
                                            <td>R$ 500,00</td>
                                            <td>R$ 0,10</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal de mais detalhes das chamadas -->
            <div class="modal fade" id="modalChamadas" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <!-- Cabeçalho do modal -->
                        <div class="modal-header">
                            <label for="date input-sm" class="col-xs-2 col-form-label font-weight-bold">Mês/Ano</label>
                            <div class="col-xs-2">
                                <input class="form-control ml-3" type="date" id="date">
                            </div>
                            <img src="../../assets/icons/search.svg" class="align-self-center">
                            <img src="../../assets/icons/exit.svg" class="close" data-dismiss="modal" aria-label="Close">

                            </button>
                        </div>

                        <!-- Conteúdo do modal -->
                        <div class="modal-body">
                            <h5 class="font-weight-bolder">Detalhes do Meu Plano Chamadas Excedentes em
                                Setembro/2020</h5>
                            <div class="table-responsive-lg">
                                <table class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Valor Mensal</th>
                                            <th scope="col">Valor Adicional</th>
                                            <th scope="col">Qtde.Máx Extra</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>APP20</td>
                                            <td>R$ 500,00</td>
                                            <td>R$ 0,10</td>
                                            <td>1000</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h5 class="font-weight-bolder">Meu uso</h5>
                                <table class="table table-striped table-responsive-lg">
                                    <thead>
                                        <tr>
                                            <th scope="col">Quantidade</th>
                                            <th scope="col">Usados</th>
                                            <th scope="col">Disponíveis</th>
                                            <th scope="col">Extras</th>
                                            <th scope="col">Valor Mensal</th>
                                            <th scope="col">Valor Adicional por Extra</th>
                                            <th scope="col">Valor Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>APP20</td>
                                            <td>R$ 500,00</td>
                                            <td>R$ 0,10</td>
                                            <td>1000</td>
                                            <td>APP20</td>
                                            <td>R$ 500,00</td>
                                            <td>R$ 0,10</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer> <?php require "../Home/footer.php" ?></footer>
    </div>

    <!-- Script para Boostrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>


    <!--Scripts para Dashboard-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>


    <!--Scricpts dos gráficos-->
    <script src="../../assets/js/chart-bar-sms.js"></script>
    <script src="../../assets/js/chart-bar-call.js"></script>
    <script src="../../assets/js/chart-doughnut-sms.js"></script>
    <script src="../../assets/js/chart-doughnut-call.js"></script>
</body>

</html>