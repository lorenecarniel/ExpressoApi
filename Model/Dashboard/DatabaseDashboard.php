<?php
    require_once "../../Database/Conection.php";

    class Sms{
        //Calcular uso médio de consumo mensal
        public static function calcAverage($dateSms){
            try{
                $rest = substr($dateSms, 0,4);
                $user = 1;
                $conectClientPlan = Connect::getConnection();
                $sqlCalcSMS = $conectClientPlan->query("SELECT COUNT(DISTINCT CR.DTREQUEST) AS TOTALDATES, COUNT(DISTINCT MONTH(CR.DTREQUEST)) AS TOTALMONTH , 
                MONTH(CR.DTREQUEST) AS MONTH,YEAR(CR.DTREQUEST) AS YEAR,COUNT(CR.CLIENTID) AS USED
                    FROM CLIENTPLAN CP, CLIENTAPIREQUEST CR
                    WHERE CR.CLIENTID = CP.CLIENTID AND CP.CLIENTID = $user AND CR.URL = '/api/sms/send' AND CR.DTREQUEST LIKE '%$rest%'
                    GROUP BY MONTH(CR.DTREQUEST),YEAR(CR.DTREQUEST);");
                    $averageMonthsSMS = 0;
                    $countMonthsSMS = 0;
                while($clientPlanLine = $sqlCalcSMS->fetch(PDO::FETCH_ASSOC)) {
                    $countMonthsSMS +=$clientPlanLine['TOTALMONTH'];//somando a quatidade de meses
                    $averageMonthsSMS += $clientPlanLine['USED']/$clientPlanLine['TOTALDATES'];//calculando a media do uso de cada mês e somando o resultado
                }
                $averageSMS = $averageMonthsSMS/$countMonthsSMS;//calculando a média mensal
                $averageFormat = number_format($averageSMS, 2, '.', '');//formatando o resultado para mostrar duas casas
                return $averageFormat;
            }catch(Exception $e){
                //qual é a mensagem de erro
                $message = "\nErro: " . $e->getMessage();
                throw new Exception($message);
            }
        }
    
        //Mostrar informações na tabela
        public static function showTableInformation($date){
            try{
                $user = 1;
                $conectClientPlan = Connect::getConnection();
                $sqlTableInfomationSms =$conectClientPlan->query("SELECT MONTH(CR.DTREQUEST) AS MONTH,YEAR(CR.DTREQUEST) AS YEAR,CP.SMSCREDITS, COUNT(CR.CLIENTID) AS USED,(CP.SMSCREDITS -COUNT(CR.CLIENTID)) AS AVAILABLE
                FROM CLIENTPLAN CP, CLIENTAPIREQUEST CR
                WHERE CR.CLIENTID = CP.CLIENTID AND CP.CLIENTID = $user AND CR.URL ='/api/sms/send' AND CR.DTREQUEST LIKE '%$date%'
                GROUP BY CP.SMSCREDITS,MONTH(CR.DTREQUEST),YEAR(CR.DTREQUEST);");
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
        public static function calcAverage($dateCall){
            try{
                $rest = substr($dateCall, 0,4);
                $user = 1;
                $conectClientPlan = Connect::getConnection();
                $sqlCalcCalls = $conectClientPlan->query("SELECT COUNT(DISTINCT CR.DTREQUEST) AS TOTALDATES, COUNT(DISTINCT MONTH(CR.DTREQUEST)) AS TOTALMONTH , 
                MONTH(CR.DTREQUEST) AS MONTH,YEAR(CR.DTREQUEST) AS YEAR,COUNT(CR.CLIENTID) AS USED
                    FROM CLIENTPLAN CP, CLIENTAPIREQUEST CR
                    WHERE CR.CLIENTID = CP.CLIENTID AND CP.CLIENTID = $user AND CR.URL <>'/api/sms/send' AND CR.DTREQUEST LIKE '%$rest%'
                    GROUP BY MONTH(CR.DTREQUEST),YEAR(CR.DTREQUEST);");
                    $averageMonths = 0;
                    $countMonths = 0;
                while($clientPlanLine = $sqlCalcCalls->fetch(PDO::FETCH_ASSOC)) {
                    $countMonths +=$clientPlanLine['TOTALMONTH'];//somando a quatidade de meses
                    $averageMonths += $clientPlanLine['USED']/$clientPlanLine['TOTALDATES'];//calculando a media do uso de cada mês e somando o resultado
                }
                $average = $averageMonths/$countMonths;//calculando a média mensal
                $averageFormat = number_format($average, 2, '.', '');//formatando o resultado para mostrar duas casas
                return $averageFormat;
            }catch(Exception $e){
                //qual é a mensagem de erro
                $message = "\nErro: " . $e->getMessage();
                throw new Exception($message);
            }
        }

        //Mostrar informações na tabela
        public static function showTableInformation($datecall){
            try{
                $user = 1;
                $conectClientPlan = Connect::getConnection();
                $sqlTableInfomationCall =$conectClientPlan->query("SELECT MONTH(CR.DTREQUEST) AS MONTH,YEAR(CR.DTREQUEST) AS YEAR,COUNT(CR.CLIENTID) AS USED,P.NAME,P.PRICE,P.REQUESTSQUANTITY,(P.REQUESTSQUANTITY -COUNT(CR.CLIENTID)) AS AVAILABLE,
                CONVERT(DECIMAL(10,2),(P.PRICE/P.REQUESTSQUANTITY)) AS VALUECALL
                FROM CLIENTPLAN CP, [PLAN] P, CLIENTAPIREQUEST CR
                WHERE P.ID = CP.PLANID AND CR.CLIENTID = CP.CLIENTID AND CP.CLIENTID = $user AND CR.URL <> '/api/sms/send' AND CR.DTREQUEST LIKE '%$datecall%'
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