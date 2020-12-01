<?php

define('DB_HOST'        , "localhost");
define('DB_USER'        , "USUARIO");
define('DB_PASSWORD'    , "CLIENTE");
define('DB_NAME'        , "EXPRESSOAPI");
define('DB_DRIVER'      , "sqlsrv");

class Connect
{
    private static $connection;

    private function __construct(){}

    public static function getConnection() {

        //string de conexão
        $Config  = DB_DRIVER . ":". "Server=" . DB_HOST . ";Database=".DB_NAME.";";

        //tratamento de erros
        try {
            if(!isset($connection)){
                //instancia o PDO e retorna a conexão
                $connection =  new PDO($Config, DB_USER, DB_PASSWORD);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return $connection;
         } catch (PDOException $e) {
            //mostra se o driver está disponivel e qual é a mensagem de erro
            $message = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
            $message .= "\nErro: " . $e->getMessage();
            throw new Exception($message);
         }
     }
}

?>
