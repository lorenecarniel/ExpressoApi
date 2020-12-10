<?php

require_once "Connection.php";

if(isset($_POST['enviar'])){

    if(empty($_POST["email"])){
    echo "Coloque seu E-mail.";
    }
    else{
            try{
                $statment = $connection ->prepare("SELECT  FROM Client WHERE email = $email ");
                $statment->execute();
                $result = $statment->fetch();

                if($statment->rowCount()==1){
                $from = $email;
                $to = "";
                $message.= "Email: $email<br>";
                $message .= "Assunto: Alteração de senha. <br>";
                $message .= "Mensagem: Solicitação de alteração de senha.<br>";
                $headers = 'From: '.$email."\r\n". 'Reply-To: '.$email."\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                mail($from, $to, $message, $headers);

                echo "E-mail enviado com sucesso";
                }
                else{
                    echo "E-mail não encontrado.";
                }
               }
               catch(PDOException $e){
                   echo "Erro ao enviar email".$e->getMessage();

               }

            }
        }
?>