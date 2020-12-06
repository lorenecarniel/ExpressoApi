<?php

session_start();  
require_once "connection.php";


//se já estiver logado
if(isset($_SESSION["email"])){
    header("location:index.html");
    exit();
}

if(isset($_POST["entrar"])){//checar os dados quando clicar no botão de entrar
    //se os campos estiverem vazios
    if(empty($_POST["email"] OR $_POST["password"])){
        echo "Preencha todos os campos.";
        
    }//se os campos estiverem preenchidos corretamente
    else{
        $email = ($_POST['email']);
        $password = ($_POST['password']);
        $mdpass = md5($password);
    }
}
//procurar dados no banco
$statment = $connection ->prepare("SELECT * FROM Client WHERE email = $email AND password = $mdpass");
$statment->execute();
$result = $statment->fetch();

//se número de resultado for =1 salvar email na session e direcionar para a main page
if($statment->rowCount() == 1 ){
    $_SESSION['email'] = $email;
    header("location:index.html");
}//se não, mensagem de erro
else{
    echo "Email ou Senha inválidos.";
}
