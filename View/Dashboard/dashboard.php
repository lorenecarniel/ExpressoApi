<!DOCTYPE html>
<html>

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
                        <form action="" method="POST" class="formFilter">
                            <div class="filter">
                                <label>Mês/Ano:
                                    <input id="dateDash" name="dateDash" type="month" value="<?php echo $search;?>">
                                    <button name="submit" id="submit"><img src="../../assets/icons/search.svg" alt="Pesquisar" id="buttonFilter"></button>
                                </label>
                            </div>
                        </form>

                        <div class="container-fluid">
                            <div class="row">
                                <!--Card-->
                                <div class="col-lg-6">
                                    <div class="card mb-4 doughnut-card">
                                        <div id="first-card" class="card-header" id="card-header-dashboard">
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
                                                    <td class="right"><?php 
                                                        if(isset($smsTableInformation['SMSCREDITS'])){
                                                            echo $smsTableInformation['SMSCREDITS'];
                                                        }else{
                                                            echo 0; 
                                                        }
                                                    ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Disponivel</td>
                                                    <td class="item top first right"><?php 
                                                        if(isset($smsTableInformation['AVAILABLE'])){
                                                            echo $smsTableInformation['AVAILABLE'];
                                                        }else{
                                                            echo 0; 
                                                        }
                                                    ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Utilizado</td>
                                                    <td class="item top second right"><?php 
                                                    if(isset($smsTableInformation['USED'])){
                                                        echo $smsTableInformation['USED'];
                                                    }else{
                                                        echo 0; 
                                                    }
                                                    ?></td>
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
                                        <div class="card-body" id="card-body-sms"><canvas id="myBarChartSms" width="100%" height="50"></canvas></div>
                                        <div class="average-use">USO MÉDIO DE SMS: <?php 
                                            if(isset($smsAverage)){
                                                echo $smsAverage;
                                            }else{
                                                echo 0; 
                                            }
                                        ?></div>
                                    </div>
                                </div>

                                <!--Card com gráfico de pizza-->
                                <div class="col-lg-6">
                                    <div class="card mb-4 doughnut-card">
                                        <div id="first-card" class="card-header" id="card-header-dashboard">
                                            MEU USO DE CHAMADAS EXCEDENTES

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
                                            <div class="item top first"><?php 
                                                if(isset($callTableInformation['REQUESTSQUANTITY'])){
                                                    echo $callTableInformation['REQUESTSQUANTITY'];
                                                }else{
                                                    echo 0; 
                                                }
                                            ?></div>
                                            <div class="item top first"><?php 
                                                if(isset($callTableInformation['AVAILABLE'])){
                                                    if($callTableInformation['AVAILABLE']<0){
                                                        echo 0;
                                                    }else{
                                                        echo $callTableInformation['AVAILABLE'];
                                                    }
                                                }else{
                                                    echo 0; 
                                                }
                                            ?></div>
                                            <div class="item top second"><?php 
                                                if(isset($callTableInformation['USED'])){
                                                    echo $callTableInformation['USED'];
                                                }else{
                                                    echo 0; 
                                                }
                                            ?></div>
                                            <div class="item top third"><?php 
                                                if(isset($callTableInformation['AVAILABLE'])){
                                                    if($callTableInformation['AVAILABLE']<0){
                                                        $plusCall = -$callTableInformation['AVAILABLE'];
                                                        echo $plusCall;
                                                    }else{
                                                        $plusCall = 0;
                                                        echo $plusCall;
                                                    }
                                                }else{
                                                    echo 0; 
                                                }
                                            ?></div>
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
                                            <td><?php 
                                                if(isset($callTableInformation['NAME'])){
                                                    echo $callTableInformation['NAME'];
                                                }else{
                                                    echo 0; 
                                                }
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td>Valor mensal</td>
                                            <td>R$ <?php 
                                                if(isset($callTableInformation['PRICE'])){
                                                    echo $callTableInformation['PRICE'];
                                                }else{
                                                    echo 0; 
                                                }
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td>Valor por chamada</td>
                                            <td>R$ <?php 
                                                if(isset($callTableInformation['VALUECALL'])){
                                                    echo $callTableInformation['VALUECALL'];
                                                }else{
                                                    echo 0; 
                                                }
                                            ?></td>
                                        </tr>
                                    </table>

                                    <!--Card com gráfico em barras-->
                                    <div class="card mb-4">
                                        <div class="card-header" id="card-header-dashboard">
                                            <i class="fas fa-chart-bar mr-1"></i>
                                            NÚMERO CHAMADAS MENSAIS
                                        </div>

                                        <!--Gráfico em barras -->
                                        <div class="card-body"><canvas id="myBarChartCall" width="100%" height="50"></canvas></div>
                                        <div class="average-use">MÉDIA DE CHAMADAS MENSAIS: <?php 
                                            if(isset($callAverage)){
                                                echo $callAverage;
                                            }else{
                                                echo 0; 
                                            }
                                        ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>

                <?php
                    require_once "../../Model/Dashboard/MoreInformations.php";
                    $moreCallTableInformation = MoreCallsInformation::showTableInformation($search);
                ?>


                <!-- Modal de mais detalhes das chamadas -->
                <div class="modal fade" id="modalChamadas" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <img src="../../assets/icons/exit.svg" class="close" data-dismiss="modal" aria-label="Close">
                            </div>

                            <!-- Conteúdo do modal -->
                            <div class="modal-body">
                                <h5 class="font-weight-bolder">Detalhes do Meu Plano Chamadas Excedentes em <?php echo strftime("%B/%Y", strtotime($search));?></h5>
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
                                                <td><?php 
                                                    if(isset($moreCallTableInformation['NAME'])){
                                                        echo $moreCallTableInformation['NAME'];
                                                    }else{
                                                        echo 0; 
                                                    }
                                                ?></td>
                                                <td>R$ <?php 
                                                    if(isset($moreCallTableInformation['PRICE'])){
                                                        echo $moreCallTableInformation['PRICE'];
                                                    }else{
                                                        echo 0; 
                                                    }
                                                ?></td>
                                                <td>R$ <?php 
                                                    if(isset($moreCallTableInformation['VALUECALL'])){
                                                        echo $moreCallTableInformation['VALUECALL'];
                                                    }else{
                                                        echo 0; 
                                                    }
                                                ?></td>
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
                                                <td><?php 
                                                    if(isset($moreCallTableInformation['REQUESTSQUANTITY'])){
                                                        echo $moreCallTableInformation['REQUESTSQUANTITY'];
                                                    }else{
                                                        echo 0; 
                                                    }
                                                ?></td>
                                                <td><?php 
                                                    if(isset($moreCallTableInformation['USED'])){
                                                        echo $moreCallTableInformation['USED'];
                                                    }else{
                                                        echo 0; 
                                                    }
                                                ?></td>
                                                <td><?php 
                                                    if(isset($moreCallTableInformation['AVAILABLE'])){
                                                        if($moreCallTableInformation['AVAILABLE']<0){
                                                            echo 0; 
                                                        }else{
                                                            echo $moreCallTableInformation['AVAILABLE'];
                                                        }
                                                    }else{
                                                        echo 0; 
                                                    }
                                                ?></td>
                                                <td><?php 
                                                    if(isset($moreCallTableInformation['AVAILABLE'])){
                                                        if($moreCallTableInformation['AVAILABLE']<0){
                                                            $moreCallPlus = -$moreCallTableInformation['AVAILABLE'];
                                                            echo $moreCallPlus;
                                                        }else{
                                                            $moreCallPlus = 0;
                                                            echo $moreCallPlus;
                                                        }
                                                    }else{
                                                        echo 0; 
                                                    }
                                                        
                                                    ?></td>
                                                <td>R$ <?php 
                                                    if(isset($moreCallTableInformation['PRICE'])){
                                                        echo $moreCallTableInformation['PRICE'];
                                                    }else{
                                                        echo 0; 
                                                    }
                                                ?></td>
                                                <td>R$ <?php 
                                                    if(isset($moreCallTableInformation['VALUECALL'])){
                                                        $plusValueCall = $moreCallTableInformation['VALUECALL'];
                                                        $moreCallPlusValue = MoreCallsInformation::calcValuePlus($moreCallPlus,$plusValueCall);
                                                        echo $moreCallPlusValue;
                                                    }else{
                                                        echo 0; 
                                                    }
                                                ?></td>
                                                <td>R$ <?php 
                                                    if(isset($moreCallTableInformation['PRICE'])){
                                                        $priceCalls = $moreCallTableInformation['PRICE'];
                                                        $moreCallTotalValue = MoreCallsInformation::calcTotal($priceCalls,$moreCallPlusValue); 
                                                        echo $moreCallTotalValue;
                                                    }else{
                                                        echo 0; 
                                                    }
                                                ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Chamada do footer - contato -->
        <footer> <?php require "../Home/footer.php" ?></footer>
    </div>

    
    <!--Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

    <!--Scricpts dos gráficos-->
    <script src="../../assets/js/chart-bar-sms.js"></script>
    <script src="../../assets/js/chart-bar-call.js"></script>
    <script src="../../assets/js/chart-doughnut-sms.js"></script>
    <script src="../../assets/js/chart-doughnut-call.js"></script>
</body>

</html>