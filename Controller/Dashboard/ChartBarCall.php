<?php
    //Pegando a variavel que foi guardada no dashboard
    session_start();
    $search = $_SESSION['search'];
    $clientid = $_SESSION['clientid'];
    $rest = substr($search, 0,4);

    //Conexão com o banco de dados
    require_once "../../Database/Conection.php";
    //try e catch usado para tratamento de erros
    try{
        $pdo = Connect::getConnection();
        //comando select no banco de dados
        $sqlSpecificInfomationCall =$pdo->query("SELECT MONTH(CR.DTREQUEST) AS MONTH, COUNT(CR.CLIENTID) AS USED
        FROM CLIENTPLAN CP, CLIENTAPIREQUEST CR
        WHERE CR.CLIENTID = CP.CLIENTID AND CP.CLIENTID = $clientid AND CR.URL <> '/api/sms/send' AND CR.DTREQUEST LIKE '%$rest%'
        GROUP BY MONTH(CR.DTREQUEST);");
        //transforma o resultado do select em array
        while($results = $sqlSpecificInfomationCall->fetch(PDO::FETCH_ASSOC)) {

            $result[] = $results;
        }
        //mostra na tela o resulta, porém é mostrado no chart
        echo json_encode($result);
    }catch (Exception $e) {
        //qual é a mensagem de erro
        $message = "\nErro: " . $e->getMessage();
        throw new Exception($message);
     }

?>