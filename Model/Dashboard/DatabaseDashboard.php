<?php
    require_once "../../Database/Conection.php";

    class Sms{
        //Calcular uso médio de consumo mensal
        public static function calcAverage($dateSms,$user){
            try{
                $restYear = substr($dateSms, 0,4);
                $restMonth = substr($dateSms, 5,2);
                $rest = substr($dateSms, 0,4);
                $conectClientPlan = Connect::getConnection();
                $sqlCalcSMS = $conectClientPlan->query("SELECT ISNULL(COUNT(DISTINCT CR.DTREQUEST),0) AS TOTALDATES, ISNULL(COUNT(DISTINCT MONTH(CR.DTREQUEST)),0) AS TOTALMONTH, 
                    $restMonth AS MONTH,$restYear AS YEAR,ISNULL(COUNT(CR.CLIENTID),0) AS USED
                    FROM CLIENTPLAN CP
                    LEFT OUTER JOIN CLIENTAPIREQUEST CR ON CR.CLIENTID = CP.CLIENTID AND CP.CLIENTID = $user AND CR.URL = '/api/sms/send' AND CR.DTREQUEST LIKE '%$rest%'
                    GROUP BY MONTH(CR.DTREQUEST),YEAR(CR.DTREQUEST);");
                    $averageMonthsSMS = 0;
                    $countMonthsSMS = 0;
                while($clientPlanLine = $sqlCalcSMS->fetch(PDO::FETCH_ASSOC)) {
                    $countMonthsSMS +=$clientPlanLine['TOTALMONTH'];//somando a quatidade de meses
                    if($clientPlanLine['USED']!=0 ||$clientPlanLine['TOTALDATES']!=0){
                        $averageMonthsSMS += $clientPlanLine['USED']/$clientPlanLine['TOTALDATES'];//calculando a media do uso de cada mês e somando o resultado
                    }
                }
                if($averageMonthsSMS==0 && $countMonthsSMS==0){
                    $averageSMS=0;
                }else{
                    $averageSMS = $averageMonthsSMS/$countMonthsSMS;//calculando a média mensal
                }
                $averageFormat = number_format($averageSMS, 2, '.', '');//formatando o resultado para mostrar duas casas
                return $averageFormat;
            }catch(Exception $e){
                //qual é a mensagem de erro
                $message = "\nErro: " . $e->getMessage();
                throw new Exception($message);
            }
        }
    
        //Mostrar informações na tabela
        public static function showTableInformation($date,$user){
            try{
                $restYear = substr($date, 0,4);
                $restMonth = substr($date, 5,2);
                $conectClientPlan = Connect::getConnection();
                $sqlTableInfomationSms =$conectClientPlan->query("SELECT $restMonth AS MONTH,$restYear AS YEAR,IIF(COUNT(CR.CLIENTID)=0,0,CP.SMSCREDITS) AS SMSCREDITS, 
                ISNULL(COUNT(CR.CLIENTID),0) AS USED,(CP.SMSCREDITS - IIF(COUNT(CR.CLIENTID)=0,CP.SMSCREDITS,COUNT(CR.CLIENTID))) AS AVAILABLE
                FROM CLIENTPLAN CP 
                LEFT OUTER JOIN CLIENTAPIREQUEST CR ON CR.CLIENTID = CP.CLIENTID AND CP.CLIENTID = $user AND CR.URL ='/api/sms/send' AND CR.DTREQUEST LIKE '%$date%'
                GROUP BY CP.SMSCREDITS,MONTH(CR.DTREQUEST),YEAR(CR.DTREQUEST)
                ");
                $clientPlan = $sqlTableInfomationSms->fetchAll()[0];
                return $clientPlan;
            }catch (Exception $e) {
                //qual é a mensagem de erro
                $message = "\nErro: " . $e->getMessage();
                throw new Exception($message);
             }
        }
    }


    class Calls{
        //Calcular uso médio de consumo mensal
        public static function calcAverage($dateCall,$user){
            try{
                $restYear = substr($dateCall, 0,4);
                $restMonth = substr($dateCall, 5,2);
                $conectClientPlan = Connect::getConnection();
                $sqlCalcCalls = $conectClientPlan->query("SELECT ISNULL(COUNT(DISTINCT CR.DTREQUEST),0) AS TOTALDATES, ISNULL(COUNT(DISTINCT MONTH(CR.DTREQUEST)),0) AS TOTALMONTH, 
                    $restMonth AS MONTH,$restYear AS YEAR,ISNULL(COUNT(CR.CLIENTID),0) AS USED
                    FROM CLIENTPLAN CP
                    LEFT OUTER JOIN CLIENTAPIREQUEST CR ON CR.CLIENTID = CP.CLIENTID AND CP.CLIENTID = $user AND CR.URL <>'/api/sms/send' AND CR.DTREQUEST LIKE '%$restYear%'
                    GROUP BY MONTH(CR.DTREQUEST),YEAR(CR.DTREQUEST);");
                    $averageMonths = 0;
                    $countMonths = 0;
                while($clientPlanLine = $sqlCalcCalls->fetch(PDO::FETCH_ASSOC)) {
                    $countMonths +=$clientPlanLine['TOTALMONTH'];//somando a quatidade de meses
                    if($clientPlanLine['USED']!=0 ||$clientPlanLine['TOTALDATES']!=0){
                        $averageMonths += $clientPlanLine['USED']/$clientPlanLine['TOTALDATES'];//calculando a media do uso de cada mês e somando o resultado
                    }
                }
                if($averageMonths==0 && $countMonths==0){
                    $average=0;
                }else{
                    $average = $averageMonths/$countMonths;//calculando a média mensal
                }
                $averageFormat = number_format($average, 2, '.', '');//formatando o resultado para mostrar duas casas
                return $averageFormat;
            }catch(Exception $e){
                //qual é a mensagem de erro
                $message = "\nErro: " . $e->getMessage();
                throw new Exception($message);
            }
        }

        //Mostrar informações na tabela
        public static function showTableInformation($datecall,$user){
            try{
                $restYear = substr($datecall, 0,4);
                $restMonth = substr($datecall, 5,2);
                $conectClientPlan = Connect::getConnection();

                $sqlTableInfomationCall =$conectClientPlan->query("SELECT $restMonth AS MONTH,$restYear AS YEAR,ISNULL(COUNT(CR.CLIENTID),0) AS USED,
                IIF(COUNT(CR.CLIENTID)=0,'0',P.NAME) AS NAME,IIF(COUNT(CR.CLIENTID)=0,0,P.PRICE) AS PRICE,
                IIF(COUNT(CR.CLIENTID)=0,0,P.REQUESTSQUANTITY) AS REQUESTSQUANTITY,(P.REQUESTSQUANTITY - IIF(COUNT(CR.CLIENTID)=0,P.REQUESTSQUANTITY,COUNT(CR.CLIENTID))) AS AVAILABLE,
                IIF(COUNT(CR.CLIENTID)=0,0,CONVERT(DECIMAL(10,2),(P.PRICE /P.REQUESTSQUANTITY))) AS VALUECALL
                FROM CLIENTPLAN CP
                LEFT OUTER JOIN [PLAN] P ON P.ID = CP.PLANID
                LEFT OUTER JOIN CLIENTAPIREQUEST CR ON CR.CLIENTID = CP.CLIENTID AND CP.CLIENTID = $user AND CR.URL <> '/api/sms/send' AND CR.DTREQUEST LIKE '%$datecall%'
                GROUP BY P.NAME,P.PRICE,P.REQUESTSQUANTITY,MONTH(CR.DTREQUEST),YEAR(CR.DTREQUEST);");

                $clientPlan = $sqlTableInfomationCall->fetchAll()[0];
                return $clientPlan;
            }catch (Exception $e) {
                //qual é a mensagem de erro
                $message = "\nErro: " . $e->getMessage();
            throw new Exception($message);
             }
        }
    }

    //Ver mês e ano atual
    function thisMonthYear(){
        try{
            $conect = Connect::getConnection();
            $sqlInfomation =$conect->query("SELECT CONCAT(YEAR ( GETDATE() ),'-',MONTH ( GETDATE() )) AS 'CURRENTMONTHYEAR'; "); 
            $clientPlan = $sqlInfomation->fetchAll()[0];
            return $clientPlan;
        }catch (PDOException $e) {
            //mostra se o driver está disponivel e qual é a mensagem de erro
            $message = "\nErro: " . $e->getMessage();
            throw new Exception($message);
         }
    }
?>