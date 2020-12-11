<?php

    require_once "../../Database/Conection.php";

    session_start();

    $email = $_POST['email'];
    $password = $_POST['password'];
    /*$mdpass = md5($password);
    echo $mdpass;*/

    //procurar dados no banco
    $connection = Connect::getConnection();
    $statment = $connection ->prepare("SELECT * FROM CLIENT WHERE EMAIL = '$email' AND PASSWORD = '$password';");
    $statment->execute();

    while($clientPlanLine = $statment->fetch(PDO::FETCH_ASSOC)) {
        $_SESSION['clientid'] = $clientPlanLine['ID'];//salva na sesão o id do usuário logado
        //echo $_SESSION['clientid'];
    }
    if($statment->rowCount()==1){//se foi diferente de null direciona para ontra página
        header("location:../../View/Home/home.php");
    }else{
        echo "<script type='text/javascript'>
            window.location.href = '../../View/Login/loginPage.php';
              alert('Dados Inválidos!');
          </script>";
    }

?>