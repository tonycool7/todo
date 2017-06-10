<?php

    function __autoload($class){
        require_once 'class/'.$class.'.php';
    }

    $users = new ManageUsers();
    $users->initialize();
    if(!empty($_POST)){
        $name = $users->clean($_POST['name']);
        $password = password_hash($users->clean($_POST['name']), PASSWORD_BCRYPT);
        $email = $users->clean($_POST['email']);
        if($users->registerUser(array($_SERVER['REMOTE_ADDR'], $name, $email, $password, date('d-m-Y'), date('h:i:sa')))){
            echo "User successfully registered!";
        }
    }

    $users->loginUser(array($_SERVER['REMOTE_ADDR'], "dlords"));
?>
<html>
	<head>
        <meta charset="UTF-8">
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/less" href="css/style.less">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.1/less.min.js"></script>
		<title>Todo List</title>
	</head>
	<body>

    <header>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">TODO LIST</a>
                </div>
            </div>
        </nav>
    </header>

    <section id="content">
        <div class="container col-md-6 col-md-offset-3">
            <div class="alert alert-success"></div>
            <div class="alert alert-danger"></div>
        </div>
        <div class="container col-md-6 col-md-offset-3">
            <h3>Register Here</h3>
            <form role="form" action="/" method="post">
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" name="name" type="text" placeholder="enter your name"/>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" name="email" type="email" placeholder="enter your name"/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" name="password" type="password" placeholder="enter your name"/>
                </div>
                <div class="form-group">
                    <label>Re-password</label>
                    <input class="form-control" name="repassword" type="password" placeholder="enter your name"/>
                </div>

                <input type="submit" value="Register" class="btn btn-success">
            </form>
        </div>
    </section>

	<script src="js/script.js"></script>
	</body>
</html>