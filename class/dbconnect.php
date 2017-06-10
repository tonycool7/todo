<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/10/17
 * Time: 8:05 PM
 */
class dbconnect{
    private $db_pass = "dlords";
    private $db_user = "todo";
    private $db_name = "todo";
    private $db_host = "todo.com";
    public static $db_conn = NULL;

    function __construct(){

    }

    public function dbInstance(){
        try{
            if(self::$db_conn == NULL) {
                self::$db_conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
                self::$db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$db_conn;
        }catch (PDOException $e){
            die($e);
        }
    }

}

?>