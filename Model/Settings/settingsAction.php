<?php

    require_once "../../Database/Conection.php";
    require_once "../../View/Settings/settings.php";
    class Settings{
        //Adicionar provedor ao usuario Logado
        public static function addProviderClient($username,$password,$provider,$user){
            try {
                $pdo = Connect::getConnection();

                //verifica se há cadastrado no usuário logado a api
                $res = $pdo->query("SELECT COUNT(*) FROM CLIENTAPI WHERE CLIENTID=$user AND APIID = '$provider'");
                $count = $res->fetchColumn();

                //Resultado se há cadastro, se houver aparecer o alert.
                if ($count > 0) {
                    echo "<script type='text/javascript'>
                            window.location.href = '../../View/Login/loginPage.php';
                            alert('Api já cadastrada!');
                        </script>";
                }else{
                    //se não houver cadastro com a api deseja fazer o insert
                    $insert = $pdo->prepare("INSERT INTO CLIENTAPI(CLIENTID,APIID,USERNAME, PASSWORD) VALUES ($user,$provider,'$username','$password')");
                    $insert->execute();
                }
            } catch (PDOException $e) {
                echo "Erro ao iserir: ".$e->getMessage();
            }
        }

        //Deletar provedor do usuário logado
        public static function delProviderClient($api,$user){
            try {
                $pdo = Connect::getConnection();
                //Deletando os dados da tabela clientapi do usuario logado da api especifica
                $stmt = $pdo->prepare("DELETE FROM CLIENTAPI WHERE CLIENTID=$user AND APIID = '$api'");
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Erro: ".$e->getMessage();
            }
        }        

        public static function showTableInformationProviderClient($user){
            try {
                $pdo = Connect::getConnection();
                $sql = "SELECT CLIENTID,APIID,USERNAME,PASSWORD,NAME
                FROM CLIENTAPI ,API 
                WHERE API.ID = CLIENTAPI.APIID AND CLIENTID = $user;";
                $stmt = $pdo->query($sql);
                $stmt->execute();
                $res = $stmt->fetchAll();
                return $res;
            } catch (PDOException $e) {
                echo "Erro: ".$e->getMessage();
            }
        }
    }

?>