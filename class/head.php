<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/12/17
 * Time: 5:17 AM
 */
class head
{
    function __construct()
    {
    }

    function __toString()
    {
       return '	<head>
                    <meta charset="UTF-8">
                    <meta name="format-detection" content="telephone=no">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
                    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
                    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
                    <link rel="stylesheet" type="text/less" href="css/style.less">
                    <link rel="icon" type="image/png" href="images/favicon.png">
                    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script&amp;subset=latin-ext" rel="stylesheet"> 
                    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
                    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.1/less.min.js"></script>
                    <title>Todo List</title>
                </head>';
    }
}