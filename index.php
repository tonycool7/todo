<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/12/17
 * Time: 5:16 AM
 */
    require_once 'class/autoload.php';
    session_start();
    $registeration = '';$login = '';$error = '';$name = '';$email = '';$pass = '';$repass = '';
    $users = new ManageUsers();
    $users->initialize();
    if(!empty($_POST['register'])){
        $name = $users->clean($_POST['name']);
        $pass = $users->clean($_POST['password']);
        $repass = $users->clean($_POST['repassword']);
        $password = password_hash($users->clean($_POST['password']), PASSWORD_DEFAULT);
        $email = $users->clean($_POST['email']);
        $error = "";
        if(!empty($name) && !empty($email) && !empty($pass) && !empty($repass)){
            $registeration = $users->registerUser(array($_SERVER['HTTP_USER_AGENT'], $name, $email, $password, date('d-m-Y'), date('h:i:sa')));
        }else{
            $error = "*compulsory";
        }
    }

    if(!empty($_POST['login'])){
        $login_pass = $users->clean($_POST['login_password']);
        $login_email = $users->clean($_POST['login_email']);
        echo $users->loginUser(array($login_email, $login_pass));
    }

    if(isset($_GET['logout'])){
        session_unset($_SESSION['logged_in']);
        header('Location: /');
    }
?>
<html>
    <?php
        $headObj = new head();
        echo $headObj;
    ?>
	<body>
    <?php
        $headerObj = new header();
        echo $headerObj;
    ?>
    <section id="content">
        <div class="container col-md-6 col-md-offset-3">
            <?php if (!empty($registeration)): ?>
                <div class="alert alert-success"><?php echo $registeration; ?></div>
            <?php endif; ?>
            <?php if (!empty($login)): ?>
                <div class="alert alert-danger"></div>
            <?php endif; ?>
        </div>
        <?php if (empty($_GET['log'])): ?>
        <div class="container col-md-6 col-md-offset-3 register-title"><h3>Register Here</h3></div>
        <div class="container col-md-6 col-md-offset-3 register-form">
            <form role="form" action="/" method="post">
                <div class="form-group">
                    <label>Name</label> <span class="text-danger"><?php echo empty($name) ? $error : ''; ?></span>
                    <input class="form-control" value="<?php echo $name;?>" name="name" type="text" placeholder="enter your name"/>
                </div>
                <div class="form-group">
                    <label>Email</label> <span class="text-danger"><?php echo empty($email) ? $error : ''; ?></span>
                    <input class="form-control" value="<?php echo $email;?>" name="email" type="email" placeholder="enter your name"/>
                </div>
                <div class="form-group">
                    <label>Password</label> <span class="text-danger"><?php echo empty($pass) ? $error : ''; ?></span>
                    <input class="form-control" value="<?php echo $pass;?>" name="password" type="password" placeholder="enter your name"/>
                </div>
                <div class="form-group">
                    <label>Re-password</label> <span class="text-danger"><?php echo empty($repass) ? $error : ''; ?></span>
                    <input class="form-control" value="<?php echo $repass;?>"  name="repassword" type="password" placeholder="enter your name"/>
                </div>
                <input type="hidden" name="register" value="register"/>
                <input type="submit" value="Register" class="btn btn-success">
                <a href="/?log=true">Already have an account?</a>
            </form>
        </div>
        <?php endif;?>
        <?php if (!empty($_GET['log'])): ?>
            <?php if (!empty($_GET['regSuccess'])): ?>
                <div class="alert alert-success container col-md-6 col-md-offset-3"><?php echo $_GET['regSuccess']; ?></div>
            <?php endif; ?>
            <div class="container col-md-6 col-md-offset-3 login-title"><h3>Login Here</h3></div>
            <div class="container col-md-6 col-md-offset-3 login-form">
            <form role="form" action="/?log=true" method="post">
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" name="login_email" type="email" placeholder="enter email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" name="login_password" type="password" placeholder="enter your password"/>
                </div>
                <input type="hidden" name="login" value="login"/>
                <input type="submit" value="Login" class="btn btn-success">
                <a href="/">Don't have an account?</a>
            </form>
        </div>
        <?php endif; ?>
    </section>

	<script src="js/script.js"></script>
	</body>
</html>