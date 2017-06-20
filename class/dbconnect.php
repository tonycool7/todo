<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/10/17
 * Time: 8:05 PM
 */

class dbconnect{
    static private $db_pass = "dlords";
    static private $db_user = "todo";
    static private $db_name = "todo";
    static private $db_host = "todo.com";
    static private $db_conn = NULL;

    function __construct(){

    }

    public static function dbInstance(){
        try{
            if(self::$db_conn == NULL) {
                self::$db_conn = new PDO("mysql:host=".self::$db_host.";dbname=".self::$db_name, self::$db_user, self::$db_pass);
                self::$db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$db_conn;
        }catch (PDOException $e){
            die($e);
        }
    }

}

?>