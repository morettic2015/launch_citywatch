<?php
class Database
{
    private static $dbName = 'citywatch01';
    private static $dbHost = 'mysql.citywatch.com.br';
    private static $dbUsername = 'citywatch01';
    private static $dbUserPassword = 'm0r3tt02013';

    private static $cont = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect() {
        if (null === self::$cont) {
            try {
                self::$cont =  new PDO('mysql:host='.self::$dbHost.'; dbname='.self::$dbName, self::$dbUsername, self::$dbUserPassword);
            } catch(PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect() {
        self::$cont = null;
    }
}