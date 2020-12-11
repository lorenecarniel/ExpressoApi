<?php

    try{
        require_once "../../Database/Conection.php";

        session_start();

        //Pegando o valor dos campos que vieram da página loginPage
        $email = $_POST['email'];
        $password = $_POST['password'];

        //procurar dados no banco
        $connection = Connect::getConnection();
        $statment = $connection ->prepare("SELECT * FROM CLIENT WHERE EMAIL = '$email' AND PASSWORD = '$password';");
        $statment->execute();

        while($clientPlanLine = $statment->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['clientid'] = $clientPlanLine['ID'];//salva na sesão o id do usuário logado
        }
        if($statment->rowCount()==1){//se foi diferente de null direciona para ontra página
            header("location:../../View/Home/home.php");
        }else{
            echo "<script type='text/javascript'>
                window.location.href = '../../View/Login/loginPage.php';
                alert('Dados Inválidos!');
            </script>";
        }
    }catch(Exception $e){
        $message = "\nErro: " . $e->getMessage();
        throw new Exception($message);
    }

?>