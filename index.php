<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" type="image/png" href="images/favicon.png">
		<title>Todo List</title>
	</head>
	<body>
    <?php
        print "fuck mehn";
        $r = (object)array(
                "name" => array("tony", "Angelina", "Yulia", "nastya"),
            "games" => array("fifa", "bachata", "emotions", "positive")
        );
        foreach($r as $l){
            foreach ($l as $m){
                echo $m;
            }
        }
    ?>
	<script src="js/script.js"></script>
	</body>
</html>