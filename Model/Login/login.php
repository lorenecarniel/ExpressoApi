<?php

    try{
        require_once "../../Database/Conection.php";

        session_start();

        //Pegando o valor dos campos que vieram da página loginPage
        $email = $_POST['email'];
        $password = $_POST['password'];
        $mdpass = md5($password);

        //procurar dados no banco
        $connection = Connect::getConnection();
        $statment = $connection ->prepare("SELECT * FROM CLIENT WHERE EMAIL = '$email' AND PASSWORD = '$mdpass';");
        $statment->execute();

        while($clientPlanLine = $statment->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['clientid'] = $clientPlanLine['ID'];//salva na sesão o id do usuário logado
        }
        if($statment->rowCount()==1){//se for igual a 1 manda para home
            //header("location:../../View/Home/home.php");
        }else{
            //se for diferente verifica a senha sem ser MD5
            $statmentMD5 = $connection ->prepare("SELECT * FROM CLIENT WHERE EMAIL = '$email' AND PASSWORD = '$password';");
            $statmentMD5->execute();
            while($clientPlanLine = $statmentMD5->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION['clientid'] = $clientPlanLine['ID'];//salva na sesão o id do usuário logado
            }
            if($statmentMD5->rowCount()==1){//se for igual a 1 manda para home
                header("location:../../View/Home/home.php");
            }else{//dados inválidos
                echo "<script type='text/javascript'>
                        window.location.href = '../../View/Login/loginPage.php';
                        alert('Dados Inválidos!');
                    </script>";
            }
        }
    }catch(Exception $e){
        $message = "\nErro: " . $e->getMessage();
        throw new Exception($message);
    }

?>