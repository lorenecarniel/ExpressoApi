<?php

    require_once "Conection.php";
    
    $pdo = Connect::getConnection();
    $sqlSpecificInfomationSms =$pdo->query("SELECT DISTINCT DAY(CLIENTAPIREQUEST.DTREQUEST) AS DAY,MONTH(CLIENTAPIREQUEST.DTREQUEST) AS MONTH, YEAR(CLIENTAPIREQUEST.DTREQUEST) AS YEAR, CLIENTAPIREQUEST.DTREQUEST,
    COUNT(CLIENTAPIREQUEST.CLIENTID) AS SMSCREDITS FROM CLIENTPLAN JOIN CLIENTAPIREQUEST ON CLIENTAPIREQUEST.CLIENTID = CLIENTPLAN.CLIENTID WHERE CLIENTPLAN.CLIENTID=1 GROUP BY DTREQUEST;");
    
    while($results = $sqlSpecificInfomationSms->fetch(PDO::FETCH_ASSOC)) {

        $result[] = $results;
    }

    echo json_encode($result);

?>