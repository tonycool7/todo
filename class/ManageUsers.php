<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/10/17
 * Time: 8:05 PM
 */

class ManageUsers
{
    private $db;
    private $con;
    private  $errorMessage;

    function __construct()
    {
        $this->db = new dbconnect();
        $this->con = $this->db->dbInstance();
    }

    function createTableUsers(){
        try {
            $stmt = $this->con->prepare("SELECT * FROM information_schema.tables WHERE table_schema = 'todo' AND table_name = 'users' LIMIT 1;");
            $stmt->execute();
            if(empty($stmt->fetchAll())) {
                $query2 = 'CREATE TABLE users (ip varchar (50) NOT NULL, name VARCHAR (255) NOT NULL, email VARCHAR (255) NOT NULL, password VARCHAR (500) NOT NULL, date VARCHAR (100) NOT NULL, time VARCHAR (100) NOT NULL, PRIMARY KEY (ip))';
                $this->con->exec($query2);
            }
        }catch (PDOException $e){
            die($e);
        }
    }

    function initialize(){
        $this->createTableUsers();
    }

    function registerUser($values = array()){
        $userExist = $this->con->prepare("select ip from users where ip = '{$values[0]}'");
        $userExist->execute();
        if($userExist->rowCount() < 1) {
            $stmt = $this->con->prepare("INSERT INTO users (ip, name, email, password, date, time) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute($values);
            if ($stmt->rowCount() > 0) {
                return true;
            }
        }else{
            echo "user already exists<br>";
        }
        return false;
    }


    function loginUser($values = array()){
        $pass=password_hash($values[1], PASSWORD_BCRYPT);
        $login = $this->con->prepare("select * from users where ip = '{$values[0]}' AND password = '{$pass}'");
        $login->execute();
        if($login->rowCount() == 1) {
            echo "Welcome {$login->fetchAll()[0][1]}";
        }else{
            echo "Incorrect login or password";
        }
    }

    function clean($string){
        strip_tags($string);
        filter_var ( $string, FILTER_SANITIZE_STRING);
        return $string;
    }

}


?>