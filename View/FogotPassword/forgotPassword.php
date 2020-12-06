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
                $message.= "Email: $email<br>";
                $message .= "Assunto: Alteração de senha. <br>";
                $message .= "Mensagem: Solicitação de alteração de senha.<br>";
                $headers = 'From: '.$email."\r\n". 'Reply-To: '.$email."\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                mail($from, $to, $message, $headers);
               }
               catch(PDOException $e){
                   echo "erro ao enviar email".$e->getMessage();

               }

            }
        }
?>