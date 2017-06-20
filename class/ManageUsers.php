<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/10/17
 * Time: 8:05 PM
 */

class ManageUsers
{
    private $con;
    private  $errorMessage;

    function __construct()
    {
        $this->con = dbconnect::dbInstance();
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

    function createTableTodo(){
        try {
            $stmt = $this->con->prepare("SELECT * FROM information_schema.tables WHERE table_schema = 'todo' AND table_name = 'todo' LIMIT 1;");
            $stmt->execute();
            if(empty($stmt->fetchAll())) {
                $query2 = 'CREATE TABLE todo (id INT (11), username VARCHAR (100) NOT NULL, description VARCHAR (500) NOT NULL, due_date VARCHAR (100) NOT NULL, created_on VARCHAR (100) NOT NULL, PRIMARY KEY (id))';
                $this->con->exec($query2);
            }
        }catch (PDOException $e){
            die($e);
        }
    }

    function initialize(){
        $this->createTableUsers();
        $this->createTableTodo();
    }

    function registerUser($values = array()){
        $userExist = $this->con->prepare("select ip from users where email = '{$values[0]}'");
        $userExist->execute();
        if($userExist->rowCount() < 1) {
            $stmt = $this->con->prepare("INSERT INTO users (ip, name, email, password, date, time) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute($values);
            if ($stmt->rowCount() > 0) {
                header('Location: /?log=true & regSuccess=registration successful');
            }
        }else{
            return "user already exists";
        }
        return 'registration unsuccessful!';
    }


    function loginUser($values = array()){
        if(!empty($values)){
            $login = $this->con->prepare("select * from users where email = '{$values[0]}'");
            $login->execute();
            $hash = $login->fetchAll()[0][3];
            $_SESSION['ip'] = $login->fetchAll()[0][0];
            $_SESSION['name'] = $login->fetchAll()[0][1];
            $_SESSION['email'] = $login->fetchAll()[0][2];
            if($login->rowCount() == 1) {
                if(password_verify($values[1], $hash)){
                    $_SESSION['logged_in'] = true;
                    header('Location: home.php');
                }else{
                    return "Incorrect password or username";
                }
            }
        }
        return "Please enter username and password";
    }

    function clean($string){
        strip_tags($string);
        filter_var ( $string, FILTER_SANITIZE_STRING);
        return $string;
    }

}
?>