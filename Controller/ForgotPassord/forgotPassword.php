<?php

require_once "../../Database/conection.php";

if(isset($_POST['enviar'])){

    if(empty($_POST["email"])){
        echo "<script type='text/javascript'>
        window.location.href = '../../View/ForgotPassword/forgotPassword.html';
        alert('Preencha o E-mail corretamente.');
        </script>";
          }
          else{
                try{//checar se o email existe
                        $email = $_POST['email'];

                        $connection = Connect::getConnection();
                        $statment = $connection ->prepare("SELECT EMAIL FROM CLIENT WHERE EMAIL = '$email'");
                        $statment->execute();
                        
                        // se o email existir enviar o email solicitando troca de senha
                        if($statment->rowCount()==1){
                                $from = $email;
                                $to = ">>>email da empresa<<<";
                                $text.= "Email: $email<br>";
                                $text .= "Assunto: Alteração de senha. <br>";
                                $text .= "Mensagem: Solicitação de alteração de senha.<br>";
                                $headers = 'From: '.$email."\r\n". 'Reply-To: '.$email."\r\n";
                                $headers .= "MIME-Version: 1.0\r\n";
                                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                                mail($from, $to, $text, $headers);

                                echo "E-mail enviado com sucesso";
                                }   
                                else{//se o email não existir
                                echo "<script type='text/javascript'>
                                window.location.href = '../../View/ForgotPassword/forgotPassword.html';
                                alert('E-mail não encontrado.');
                                </script>";
                                }

                                }
                                catch(PDOException $e){
                                        $message = "Erro: " . $e->getMessage();
                                        throw new Exception($message);
                                }

                }
        }
