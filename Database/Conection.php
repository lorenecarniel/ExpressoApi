<?php

define('DB_HOST'        , "localhost");
define('DB_USER'        , "sa");
define('DB_PASSWORD'    , "123456");
define('DB_NAME'        , "EXPRESSOAPI");
define('DB_DRIVER'      , "sqlsrv");

class Connect
{
    private static $connection;

    private function __construct(){}

    public static function getConnection() {

        $pdoConfig  = DB_DRIVER . ":". "Server=" . DB_HOST . ";";
        $pdoConfig .= "Database=".DB_NAME.";";

        try {
            if(!isset($connection)){
                $connection =  new PDO($pdoConfig, DB_USER, DB_PASSWORD);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return $connection;
         } catch (PDOException $e) {
            $message = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
            $message .= "\nErro: " . $e->getMessage();
            throw new Exception($message);
         }
     }
}

?>
