<?php
    require_once "../../Database/Conection.php";
    class MoreCallsInformation{

        public static function showTableInformation($date){
            
            try {
                $conectClientPlan = Connect::getConnection();
                $sqlTableInfomationCall =$conectClientPlan->query("SELECT MONTH(CR.DTREQUEST) AS MONTH,YEAR(CR.DTREQUEST) AS YEAR,COUNT(CR.CLIENTID) AS USED,P.NAME,P.PRICE,P.REQUESTSQUANTITY,(P.REQUESTSQUANTITY -COUNT(CR.CLIENTID)) AS AVAILABLE,
                CONVERT(DECIMAL(10,2),(P.PRICE/P.REQUESTSQUANTITY)) AS VALUECALL
                FROM CLIENTPLAN CP, [PLAN] P, CLIENTAPIREQUEST CR
                WHERE P.ID = CP.PLANID AND CR.CLIENTID = CP.CLIENTID AND CP.CLIENTID = 1 AND CR.URL <>'/api/sms/send' AND CR.DTREQUEST LIKE '%$date%'
                GROUP BY P.NAME,P.PRICE,P.REQUESTSQUANTITY,MONTH(CR.DTREQUEST),YEAR(CR.DTREQUEST);");
                $clientPlan = $sqlTableInfomationCall->fetchAll()[0];
                    
                return $clientPlan;
             } catch (Exception $e) {
                //qual é a mensagem de erro
                $message = "\nErro: " . $e->getMessage();
                throw new Exception($message);
             }
             
        }

        public static function calcValuePlus($plusCall,$plusValue){
            try{
                $result = $plusCall*$plusValue;
                $resultFormat = number_format($result, 2, '.', '');
                return $resultFormat;
            }catch(Exception $e){
                //qual é a mensagem de erro
                $message = "\nErro: " . $e->getMessage();
                throw new Exception($message);
            }
        }

        public static function calcTotal($priceCalls,$plusValue){
            try{
                $total = $priceCalls + $plusValue;
                $totalFormat = number_format($total, 2, '.', '');
                return $totalFormat;
            }catch (Exception $e) {
                //qual é a mensagem de erro
                $message = "\nErro: " . $e->getMessage();
            throw new Exception($message);
             }
        }
    }
?>