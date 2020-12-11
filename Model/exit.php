<?php
    //Quando usuário clicar em sair a sessão fiacará zerada
    session_start();
    $_SESSION['clientid'] = 0;
    header("location:../View/index.html");
?>