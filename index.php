<?php

    function __autoload($class){
        require_once 'class/'.$class.'.php';
    }
    $db = new dbconnect();
    $db->initialize();
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" type="image/png" href="images/favicon.png">
		<title>Todo List</title>
	</head>
	<body>
    <?php

    ?>
	<script src="js/script.js"></script>
	</body>
</html>