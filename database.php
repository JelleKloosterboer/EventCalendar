<?php
class Database
{
    private static $dbName = '' ; //Insert name of the database
    private static $dbHost = '' ; //Insert host of the database
    private static $dbUsername = ''; //Insert username of the database software
    private static $dbUserPassword = ''; //Insert password of the database software
     
    private static $cont  = null;
     
    public function __construct() {
        die('Init function is not allowed');
    }
     
    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$cont;
    }
     
    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>