<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/10/17
 * Time: 8:05 PM
 */
class dbconnect{
    protected $db_conn;
    private $db_pass = "dlords";
    private $db_user = "todo";
    private $db_name = "todo";
    private $db_host = "todo.com";

    function __construct(){
        try{
            $this->db_conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
            $this->db_conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            die($e);
        }
    }

    function createTableUsers(){
        try {
            $stmt = $this->db_conn->prepare("SELECT * FROM information_schema.tables WHERE table_schema = 'todo' AND table_name = 'users' LIMIT 1;");
            $stmt->execute();
            if(empty($stmt->fetchAll())) {
                $query2 = 'CREATE TABLE users (ip varchar (50) NOT NULL, name VARCHAR (255) NOT NULL, email VARCHAR (255) NOT NULL, password VARCHAR (500) NOT NULL, date VARCHAR (100) NOT NULL, time VARCHAR (100) NOT NULL, PRIMARY KEY (ip))';
                $this->db_conn->exec($query2);
            }
        }catch (PDOException $e){
            die($e);
        }
    }

    function initialize(){
        $this->createTableUsers();
    }
}

?>