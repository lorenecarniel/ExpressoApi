<?php
    //Pegando a variavel que foi guardada no dashboard
    session_start();
    $search = $_SESSION['search'];
    $clientid = $_SESSION['clientid'];
    
    
    //Conexão com o banco de dados
    require_once "../../Database/Conection.php";
    
    //try e catch usado para tratamento de erros
    try{
        $pdo = Connect::getConnection();
        //comando select no banco de dados
        $sqlSpecificInfomationSms =$pdo->query("SELECT COUNT(CR.CLIENTID) AS USED,P.REQUESTSQUANTITY,(P.REQUESTSQUANTITY -COUNT(CR.CLIENTID)) AS DISPONIVEL
        FROM CLIENTPLAN CP, [PLAN] P, CLIENTAPIREQUEST CR
        WHERE P.ID = CP.PLANID AND CR.CLIENTID = CP.CLIENTID AND CP.CLIENTID = $clientid AND CR.URL <>'/api/sms/send' AND CR.DTREQUEST LIKE '%$search%'
        GROUP BY P.REQUESTSQUANTITY;");
        //transforma o resultado do select em array
        while($results = $sqlSpecificInfomationSms->fetch(PDO::FETCH_ASSOC)) {

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