<html>
	<head>
		<title>rebouclage</title>
		<meta charset="utf-8"/>
	</head>
	<body>
		<h1>Rebouclage simple.</h1>
        <?php
        if (!isset($_GET["numero"])) {
			$value="1";
			}
        else{
            $value=$_GET["numero"]+1;
        }
        ?>
        <form method="GET" action="rebouclage_simple.php">
        
        <input type="text" value="<?php echo $value ?>" size=15 name="numero">
        
	    <input type="submit" value="incrementer"></td>
		</form>
	</body>
</html>