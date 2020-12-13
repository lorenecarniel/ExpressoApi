<?php
    /*Chamando as funções do banco de dados do dashboard */
    require_once "../../Controller/Dashboard/DatabaseDashboard.php";
    $filter = thisMonthYear();
    /*Filtro para aparecer mês e ano */
    if(isset($_POST['submit'])){
        $search = $_POST['dateDash'];
    }else{
        $search = $filter['CURRENTMONTHYEAR'];
    }

    //Utilizado para guardar a várivel e passar para outra página
    session_start();
    $_SESSION['search']=$search;//Data que foi filtrada
    $clientid = $_SESSION['clientid'];//Coloca o Usuário logado dentro da Variavel

    //Chamando as funções e classes para mostrar as informações
    $smsTableInformation = Sms::showTableInformation($search,$clientid);
    $smsAverage = Sms::calcAverage($search,$clientid);
    $callTableInformation = Calls::showTableInformation($search,$clientid);
    $callAverage = Calls::calcAverage($search,$clientid);
    
    //Colocando a data em português
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <title>Expresso API</title>
    <link rel="shortcut icon" href="../../assets/images/image-logo.png" />

    <!-- Importação de CSS -->
    <link rel="stylesheet" href="../styles/mainStyles.css" />
    <link rel="stylesheet" href="../styles/stylesContrast.css" />
    <link rel="stylesheet" href="../Dashboard/stylesDashboard.css" />
    
  </head>

  <body>
    <!-- Dashboard -->
    <div class="h-100 tab-pane active" id="dashboard" role="tabpanel">
      <header class="header">
        <button type="button" class="btn text-info collapse-sidebar">
          <img src="../../assets/icons/menuIcon.svg" />
        </button>

        <h1>Dashboard</h1>

        <a class="exit" href="../../Controller/exit.php">
          <img src="../../assets/icons/log-out.svg" alt="Sair" />
          <span class="ml-3 config-span">Sair</span>
        </a>
      </header>

      <main>
        <!-- Conteúdo Dashboard -->
        <div id="layoutSidenav_content">
          <main>
            <!--Filtro-->
            <form action="" method="POST" class="formFilter">
              <div class="filter">
                <label
                  >Mês/Ano:
                  <input
                    id="dateDash"
                    name="dateDash"
                    type="month"
                    value="<?php echo $search;?>"
                  />
                  <button name="submit" id="submit">
                    <img
                      src="../../assets/icons/search.svg"
                      alt="Pesquisar"
                      id="buttonFilter"
                    />
                  </button>
                </label>
              </div>
            </form>

            <div class="container-fluid">
              <div class="row">
                <!--Card-->
                <div class="col-lg-6">
                  <div class="card mb-4 doughnut-card">
                    <div
                      id="first-card"
                      class="card-header"
                      id="card-header-dashboard"
                    >
                      MEU USO DE SMS
                    </div>

                    <!--Tabela-->
                    <div class="card-body SMS">
                      <table name="tableSms" id="tableSMS">
                        <tr>
                          <th colspan="2">Resumo uso do SMS</th>
                        </tr>

                        <tr>
                          <td>Quantidade</td>
                          <td class="right">
                            <?php echo $smsTableInformation['SMSCREDITS']; ?>
                          </td>
                        </tr>
                        <tr>
                          <td>Disponivel</td>
                          <td class="item top first right">
                            <?php echo $smsTableInformation['AVAILABLE'];?>
                          </td>
                        </tr>
                        <tr>
                          <td>Utilizado</td>
                          <td class="item top second right">
                            <?php echo $smsTableInformation['USED'];?>
                          </td>
                        </tr>
                        <tr>
                          <td>Valor por mensagem</td>
                          <td class="right">R$ 0,10</td>
                        </tr>
                      </table>
                    </div>
                  </div>

                  <!--Card com gráfico de barras-->
                  <div class="card mb-4">
                    <div class="card-header" id="card-header-dashboard">
                      <i class="fas fa-chart-bar mr-1"></i>
                      NÚMERO DIÁRIOS DE SMS
                    </div>

                    <!--Gráfico em barras -->
                    <div class="card-body" id="card-body-sms">
                      <canvas
                        id="myBarChartSms"
                        width="100%"
                        height="50"
                      ></canvas>
                    </div>
                    <div class="average-use">
                      USO MÉDIO DE SMS:
                      <?php echo $smsAverage;?>
                    </div>
                  </div>
                </div>

                <!--Card com gráfico de pizza-->
                <div class="col-lg-6">
                  <div class="card mb-4 doughnut-card">
                    <div
                      id="first-card"
                      class="card-header"
                      id="card-header-dashboard"
                    >
                      MEU USO DE CHAMADAS EXCEDENTES

                      <button
                        type="button"
                        class="btn btn-primary"
                        data-toggle="modal"
                        data-target="#modalChamadas"
                      >
                        Detalhes
                      </button>
                    </div>

                    <!--Gráfico de pizza -->
                    <div class="card-body">
                      <canvas
                        id="myDoughnutChartCall"
                        width="100%"
                        height="50"
                      ></canvas>
                    </div>

                    <!--Grid-->
                    <section class="grid grid-template-columns-4">
                      <div class="item top first">
                        <?php echo $callTableInformation['REQUESTSQUANTITY'];?>
                      </div>
                      <div class="item top first">
                        <?php 
                                            if($callTableInformation['AVAILABLE']<0){
                                                echo 0;
                                            }else{
                                                echo $callTableInformation['AVAILABLE'];
                                            }
                                        ?>
                      </div>
                      <div class="item top second">
                        <?php echo $callTableInformation['USED'];?>
                      </div>
                      <div class="item top third">
                        <?php 
                                            if($callTableInformation['AVAILABLE']<0){
                                                $plusCall = -$callTableInformation['AVAILABLE'];
                                                echo $plusCall;
                                            }else{
                                                $plusCall = 0;
                                                echo $plusCall;
                                            }
                                        ?>
                      </div>
                      <div class="item down first">CONTRATADO</div>
                      <div class="item down first">DISPONÍVEL</div>
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
                      <td><?php echo $callTableInformation['NAME'];?></td>
                    </tr>
                    <tr>
                      <td>Valor mensal</td>
                      <td>
                        R$
                        <?php echo $callTableInformation['PRICE']; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Valor por chamada</td>
                      <td>
                        R$
                        <?php echo $callTableInformation['VALUECALL'];?>
                      </td>
                    </tr>
                  </table>

                  <!--Card com gráfico em barras-->
                  <div class="card mb-4">
                    <div class="card-header" id="card-header-dashboard">
                      <i class="fas fa-chart-bar mr-1"></i>
                      NÚMERO CHAMADAS MENSAIS
                    </div>

                    <!--Gráfico em barras -->
                    <div class="card-body">
                      <canvas
                        id="myBarChartCall"
                        width="100%"
                        height="50"
                      ></canvas>
                    </div>
                    <div class="average-use">
                      MÉDIA DE CHAMADAS MENSAIS:
                      <?php echo $callAverage;?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </main>
        </div>

        <?php
                require_once "../../Controller/Dashboard/MoreInformations.php";
                $moreCallTableInformation = MoreCallsInformation::showTableInformation($search,$clientid);
            ?>

        <!-- Modal de mais detalhes das chamadas -->
        <div
          class="modal fade"
          id="modalChamadas"
          data-backdrop="static"
          data-keyboard="false"
          tabindex="-1"
          aria-labelledby="staticBackdropLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <img
                  src="../../assets/icons/exit.svg"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                />
              </div>

              <!-- Conteúdo do modal -->
              <div class="modal-body">
                <h5 class="font-weight-bolder">
                  Detalhes do Meu Plano Chamadas Excedentes em
                  <?php echo strftime("%B/%Y", strtotime($search));?>
                </h5>
                <div class="table-responsive-lg">
                  <table class="table table-striped">
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
                        <td><?php echo $moreCallTableInformation['NAME'];?></td>
                        <td>
                          R$
                          <?php echo $moreCallTableInformation['PRICE'];?>
                        </td>
                        <td>
                          R$
                          <?php echo $moreCallTableInformation['VALUECALL'];?>
                        </td>
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
                        <td>
                          <?php echo $moreCallTableInformation['REQUESTSQUANTITY'];?>
                        </td>
                        <td><?php echo $moreCallTableInformation['USED'];?></td>
                        <td>
                          <?php 
                                                if($moreCallTableInformation['AVAILABLE']<0){
                                                    echo 0; 
                                                }else{
                                                    echo $moreCallTableInformation['AVAILABLE'];
                                                }
                                            ?>
                        </td>
                        <td>
                          <?php 
                                                if($moreCallTableInformation['AVAILABLE']<0){
                                                    $moreCallPlus = -$moreCallTableInformation['AVAILABLE'];
                                                    echo $moreCallPlus;
                                                }else{
                                                    $moreCallPlus = 0;
                                                    echo $moreCallPlus;
                                                }                                               
                                                ?>
                        </td>
                        <td>
                          R$
                          <?php echo $moreCallTableInformation['PRICE'];?>
                        </td>
                        <td>
                          R$
                          <?php 
                                                    $plusValueCall = $moreCallTableInformation['VALUECALL'];
                                                    $moreCallPlusValue = MoreCallsInformation::calcValuePlus($moreCallPlus,$plusValueCall);
                                                    echo $moreCallPlusValue;
                                            ?>
                        </td>
                        <td>
                          R$
                          <?php 
                                                    $priceCalls = $moreCallTableInformation['PRICE'];
                                                    $moreCallTotalValue = MoreCallsInformation::calcTotal($priceCalls,$moreCallPlusValue); 
                                                    echo $moreCallTotalValue;
                                            ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

      <footer><?php require "../Footer/footer.html" ?></footer>
    </div>

    <!-- Script para Boostrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

    <!--Scripts para Dashboard-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"
    ></script>

    <!--Scricpts dos gráficos-->
    <script src="../../assets/js/chart-bar-sms.js"></script>
    <script src="../../assets/js/chart-bar-call.js"></script>
    <script src="../../assets/js/chart-doughnut-call.js"></script>
  </body>
</html>
