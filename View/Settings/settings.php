<?php
    
    require_once "../../Database/conection.php";
    require_once "../../Model/Settings/settingsAction.php";
    $pdo = Connect::getConnection();
    $clientid = $_SESSION['clientid'];
    //verifica se o botão Adicionar foi clicado
    if (isset($_POST['insert'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $api = $_POST['provedores'];
        //chama a classe e função referente ao adicionar
        Settings::addProviderClient($username,$password,$api,$clientid);
    }

    //verifica se o botão Deletar foi clicado
    if(isset($_POST['delete'])){
        //chama a classe e função referente ao deletar
        $ApiId = $_POST['id'];
        Settings::delProviderClient($ApiId,$clientid);
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Expresso API</title>
    <link rel="shortcut icon" href="../../assets/images/image-logo.png" />

    <!-- Importação de CSS -->
    <link rel="stylesheet" href="../mainStyles.css">
    <link rel="stylesheet" href="../Settings/stylesSettings.css">
</head>

<body>
    <!-- Configurações -->
    <div class="h-100 tab-pane" id="settings" role="tabpanel">

        <header class="header">
            <button type="button" class="btn text-info collapse-sidebar">
                <img src="../../assets/icons/menuIcon.svg">
            </button>
            
            <h1>Configurações</h1>
            
            <a class="exit" href="../../Model/exit.php">
                <img src="../../assets/icons/log-out.svg" alt="Sair">
                <span class="ml-3 config-span">Sair</span>
            </a>
        </header>

        <main class="content">

            <!-- Conteúdo Configurações -->
            <div class="card">
        <div class="card-header">
          Selecione abaixo os provedores
        </div>
        <div class="card-body-a">
            <div class="card-y1">
                <form action="./home.php" method="POST">
                    <select name="provedores" class="form-control-1 col-md-6">
                        <?php
                            try {
                                $sql = $pdo->query("SELECT * FROM API");
                                if ($sql->execute()) {
                                    while ($result = $sql->fetch(PDO::FETCH_OBJ)) {
                                        echo "<option value='$result->ID'>".$result->NAME."</option>";
                                    }
                                }else{
                                    echo "Erro: não foi possivel listar os registros";
                                }
                            } catch (PDOException $e) {
                                echo "Erro: ".$e->getMessage();
                            }
                        ?>
                    </select>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nome">Usuario</label>
                            <input type="text" name="username" class="form-control" placeholder="Usuario" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Senha</label>
                            <input type="password" name="password" class="form-control" placeholder="Senha" required>
                        </div>
                        <div class="card-y2 col-md-6">
                            <button type="submit" name="insert" value="1" class="btn btn-primary">Adicionar</button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
    <br>
    <div class="card card-b">
        <div class="card-header">
          Seus Provedores
        </div>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Provedor</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Senha</th>
                    <th scope="col">Apagar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    try {
                        $sql = "SELECT C.CLIENTID,C.APIID,C.USERNAME,C.PASSWORD,A.NAME
                        FROM CLIENTAPI C,API A
                        WHERE A.ID = C.APIID;";
                        $stmt = $pdo->query($sql);
                        if ($stmt->execute()) {
                            while ($res = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo "<td>".$res->NAME."</td>";
                                echo "<td>".$res->USERNAME."</td>";
                                echo "<td>".$res->PASSWORD."</td>";
                                echo "<td><form method='POST' action=''>
                                <input type='hidden' name='id' value='".$res->APIID."'/>
                                <button type='submit' name='delete' id='buttonDelete'><img src='../../assets/icons/delete.svg'></button>
                            </form></td>";
                                //echo "<td><a href=\"home.php?Id=".$res->APIID."&acao=del\"><img src='../../assets/icons/delete.svg'></a></td>";
                                echo "</tr>";
                            }
                        }else{
                            echo "Erro: não foi possivel listar os registros";
                        }
                    } catch (PDOException $e) {
                        echo "Erro: ".$e->getMessage();
                    }
                ?>
            </tbody>
        </table>
    </div>
        </main>
    </div>
    
    <!--Scripts-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

</body>

</html>