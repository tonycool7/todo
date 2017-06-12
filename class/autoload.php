<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/12/17
 * Time: 5:32 AM
 */
function __autoload($class){
    require_once 'class/'.$class.'.php';
}

?>