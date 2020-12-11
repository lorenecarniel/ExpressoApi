<?php
    require_once "../../Database/Conection.php";
    class MoreCallsInformation{

        public static function showTableInformation($date,$user){
            
            try {
                $conectClientPlan = Connect::getConnection();
                $restYear = substr($date, 0,4);
                $restMonth = substr($date, 5,2);
                try{
                    //Excutando a função que já está criada
                    $sqlTableInfomationCall =$conectClientPlan->query("SELECT * FROM GetMoreInformationTableInformation ('$restYear','$restMonth',$user,'$date')");
                    $clientPlan = $sqlTableInfomationCall->fetchAll()[0];
                    return $clientPlan;
                }catch (Exception $e){
                    //caso não exita criar a função
                    $sqlCreateFunctionCall = $conectClientPlan->prepare("CREATE FUNCTION GetMoreInformationTableInformation(@Year nvarchar(4),@Month nvarchar(2),@User int,@full nvarchar(7))
                    RETURNS TABLE 
                    AS
                    RETURN 
                    (
                        SELECT @Month AS MONTH,@Year AS YEAR,ISNULL(COUNT(CR.CLIENTID),0) AS USED,
                        IIF(COUNT(CR.CLIENTID)=0,'0',P.NAME) AS NAME,IIF(COUNT(CR.CLIENTID)=0,0,P.PRICE) AS PRICE,
                        IIF(COUNT(CR.CLIENTID)=0,0,P.REQUESTSQUANTITY) AS REQUESTSQUANTITY,(P.REQUESTSQUANTITY - IIF(COUNT(CR.CLIENTID)=0,P.REQUESTSQUANTITY,COUNT(CR.CLIENTID))) AS AVAILABLE,
                        IIF(COUNT(CR.CLIENTID)=0,0,CONVERT(DECIMAL(10,2),(P.PRICE /P.REQUESTSQUANTITY))) AS VALUECALL
                        FROM CLIENTPLAN CP
                        LEFT OUTER JOIN [PLAN] P ON P.ID = CP.PLANID
                        LEFT OUTER JOIN CLIENTAPIREQUEST CR ON CR.CLIENTID = CP.CLIENTID AND CP.CLIENTID = @User AND CR.URL <> '/api/sms/send' AND CR.DTREQUEST LIKE '%' + @full + '%'
                        GROUP BY P.NAME,P.PRICE,P.REQUESTSQUANTITY,MONTH(CR.DTREQUEST),YEAR(CR.DTREQUEST)
                    )");
                    $sqlCreateFunctionCall->execute();
                    //Excutando a função que foi criada
                    $sqlTableInfomation = $conectClientPlan->query("SELECT * FROM GetMoreInformationTableInformation ('$restYear','$restMonth',$user,'$date')");
                    $result = $sqlTableInfomation->fetchAll()[0];
                    return $result;
                }
             } catch (Exception $e) {
                //qual é a mensagem de erro
                $message = "\nErro: " . $e->getMessage();
                throw new Exception($message);
             }
             
        }

        //Calcular valor extra
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

        //calcular valor total
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