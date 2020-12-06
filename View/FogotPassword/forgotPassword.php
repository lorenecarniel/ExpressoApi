<?php

require_once "Connection.php";

if(isset($_POST['enviar'])){

    if(empty($_POST["email"])){
    echo "Coloque seu E-mail.";
    }
    else{
            try{
                $from = $email;
                $to = "";
                $mensagem .= "Email: $email<br>";
                $mensagem .= "Assunto: Alteração de senha. <br>";
                $mensagem .= "Mensagem: Solicitação de alteração de senha.<br>";
                $headers = 'From: '.$email."\r\n". 'Reply-To: '.$email."\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
               }
               catch(PDOException $e){
                   echo "erro ao enviar email".$e->getMessage();

               }

            }
        }
?>