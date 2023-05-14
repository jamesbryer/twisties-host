<?php
include_once "../../config/conf.php";
class Dbh
{
    protected function connect()
    {
        // Connect to the MySQL database using PDO
        $host = DB_SERVER;
        $port = DB_PORT;
        $dbname = DB_NAME;
        $username = DB_USERNAME;
        $password = DB_PASSWORD;

        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $dbh = new PDO($dsn, $username, $password, $options);
            return $dbh;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}