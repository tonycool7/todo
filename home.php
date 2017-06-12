<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/12/17
 * Time: 5:16 AM
 */
    require_once 'class/autoload.php';
    session_start();

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
    <?php if ($_SESSION['logged_in']): ?>
    <main>
        <div class="container col-md-8 col-md-offset-2">
            <div class="row">
                <h2>Welcome!</h2>
            </div>
            <div class="row">
                <h2>My TODO list</h2>
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Description</th>
                            <th>Due date</th>
                            <th>Created On</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php else: header('Location: /'); ?>
    <?php endif;?>
    </body>
</html>
