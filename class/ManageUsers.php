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
        $userExist = $this->con->prepare("select ip from users where email = '{$values[0]}'");
        $userExist->execute();
        if($userExist->rowCount() < 1) {
            $stmt = $this->con->prepare("INSERT INTO users (ip, name, email, password, date, time) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute($values);
            if ($stmt->rowCount() > 0) {
                $regSuccess =  'registration successful!';
                header('Location: /?log=true');

            }
        }else{
            return "user already exists";
        }
        return 'registration unsuccessful!';
    }


    function loginUser($values = array()){
        if(!empty($values)){
            $login = $this->con->prepare("select password from users where email = '{$values[0]}'");
            $login->execute();
            $hash = $login->fetchAll()[0][0];
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