<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <title>Expresso API</title>
    <link rel="shortcut icon" href="../assets/images/image-logo.png" />

    <!-- Importação de CSS -->
    <link rel="stylesheet" href="./styles/stylesSettings.css">

</head>

<body>
    <!-- Confidurações -->
    <div class="h-100 tab-pane" id="settings" role="tabpanel">

        <!-- Cabeçalho configurações -->
        <header class="header">
            <button type="button" class="btn text-info collapse-sidebar">
                <img src="../assets/icons/menuIcon.svg">
            </button>

            <h1>Settings</h1>

            <div class="contrast">
                <span>Alto contraste</span>
                <label class="switch">
                    <input type="checkbox" src="contrast.png" id="toggleTheme">
                    <span class="slider round"></span>
                </label>
            </div>
        </header>

        <main class="content">
            <!-- Conteúdo Configurações -->
            <div class="card">
                <div id="card-settings" class="card-header">
                    Selecione abaixo os provedores
                </div>
                <div class="card-body-a">
                    <div class="card-y1">
                        <select class="form-control-1">
                            <option>JAMEF</option>
                        </select>
                    </div>
                    <div class="card-z"></div>
                    <div class="card-y2">
                        <a href="#" class="btn btn-primary addProvider" data-toggle="modal" data-target="#modalConfirm">Adicionar</a>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div id="card-settings" class="card-header">
                    Seus Provedores
                </div>
                <div class="card-x">
                    <div class="card-body" id="card-body-settings">
                        <div class="card-text">
                            E-mail
                        </div>
                        <div id="card-provedor" class="card">
                            <div class="card-body-b">
                                JAMEF
                            </div>
                        </div>
                        <a href="#" class="btn" data-toggle="modal" data-target="#modalConfirm"><img src="../assets/icons/delete.svg" alt="Excluir"></a>
                    </div>
                    <div class="card-body" id="card-body-settings">
                        <div class="card-text">
                            E-mail
                        </div>
                        <div id="card-provedor" class="card">
                            <div class="card-body-b">
                                RTE
                            </div>
                        </div>
                        <a href="#" class="btn" data-toggle="modal" data-target="#modalConfirm"><img src="../assets/icons/delete.svg" alt="Excluir"></a>
                    </div>
                </div>

                <div class="card-x">
                    <div class="card-body" id="card-body-settings">
                        <div class="card-text">
                            E-mail
                        </div>
                        <div id="card-provedor" class="card">
                            <div class="card-body-b">
                                GBC
                            </div>
                        </div>
                        <a href="#" class="btn" data-toggle="modal" data-target="#modalConfirm"><img src="../assets/icons/delete.svg" alt="Excluir"></a>
                    </div>
                    <div class="card-body" id="card-body-settings">
                        <div class="card-text">
                            E-mail
                        </div>
                        <div id="card-provedor" class="card">
                            <div class="card-body-b">
                                ABC
                            </div>
                        </div>
                        <a href="#" class="btn" data-toggle="modal" data-target="#modalConfirm"><img src="../assets/icons/delete.svg" alt="Excluir"></a>
                    </div>
                </div>
            </div>

            <!-- Modal de Confimação de conta -->
            <div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="modalConfirmLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div id="modalCorfirm-header" class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Confirmação de Usuário</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true"><img src="../assets/icons/exit.svg" alt=""></span>
                            </button>
                        </div>
                        <div id="padding-modalCorfirm" class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-mail</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="meuemail@teste.com">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Senha</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="buttonConfirm" class="btn btn-primary bot-a">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!--Script para Configuração-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>

</html>