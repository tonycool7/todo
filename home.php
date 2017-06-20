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
        <div>
            <div class="brand">TODO MAKER</div>
            <div class="sidebar col-md-3">
                <ul>
                    <li><a>Inbox</a></li>
                    <li><a>Read Later</a></li>
                    <li><a>Important</a></li>
                </ul>
            </div>
            <div class="body-content col-md-9">
                <div class="body-content__header">
                    <span class="title">Manage TODO</span>
                    <span class="btn btn-success add-new">+ Add New</span>
                </div>
                <table class="table table-bordered table-hovered table-responsive">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Snippet</th>
                            <th>Due date</th>
                            <th>Time Left</th>
                            <th>Progress</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $todoList = todoManager::listTodo($_SESSION['email']);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php else: header('Location: /'); ?>
    <?php endif;?>
    </body>
</html>
