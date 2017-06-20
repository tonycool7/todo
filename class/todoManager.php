<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/12/17
 * Time: 7:57 PM
 */

require_once 'autoload.php';

class todoManager
{
    function __construct()
    {

    }

    function createTodo($values = array()){
        $link = dbconnect::dbInstance();
        $query = $link->prepare("insert into todo (id, username, description, due_date, created_on) values (?,?,?,?,?)");
        return $query->execute($values) ? 1 : 0;
    }

    static function listTodo($username){
        $link = dbconnect::dbInstance();
        $query = $link->prepare('select * from todo where username = "$username"');
        $query->execute();
        if($query->rowCount() < 1){
            return 0;
        }
        return $query->fetchALL();
    }
}