<?php

require_once "connection.php";

if(isset($_POST['enviar'])){

    if(empty($_POST["email"])){
    echo "Coloque seu E-mail.";
    }
    else{
            try{//checar se o email existe
                $email = $_POST['email'];
                $connection = Connect::getConnection();
                $statment = $connection ->prepare("SELECT * FROM CLIENT WHERE EMAIL = '$email'");
                $statment->execute();
                
                // se o email existir enviar o email solicitando troca de senha
                if($statment->rowCount()==1){
                        $from = $email;
                        $to = ">>>email da empresa<<<";
                        $message.= "Email: $email<br>";
                        $message .= "Assunto: Alteração de senha. <br>";
                        $message .= "Mensagem: Solicitação de alteração de senha.<br>";
                        $headers = 'From: '.$email."\r\n". 'Reply-To: '.$email."\r\n";
                        $headers .= "MIME-Version: 1.0\r\n";
                        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                        mail($from, $to, $message, $headers);

                        echo "E-mail enviado com sucesso";
                        }   
                        else{//se o email não existir
                            echo "E-mail não encontrado.";
                            }

                         }
                          catch(PDOException $e){
                            echo "erro ao enviar email".$e->getMessage();
                          }

                }
        }
?>