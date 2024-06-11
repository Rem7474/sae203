<html>
	<head>
		<title> Traitement </title>
		<meta charset="utf-8"/>
	</head>

	<body>
		<center>
			<h1> Traitement </h1>

				<?php

          $local_info=$_POST["P_info"];
          print "information reçue : ".$local_info;
		  $local_info=pg_escape_string($local_info);
		  $regex  = "@^[0-9A-F]+$@";
		  if (preg_match_all($regex, $local_info, $resultats)) { // il y a une correspondance
			// preg_match_all retourne true s'il y a une correspondance
				print "<p>Motif en correspondance !!!!!!!!!!!!</p>";

		} else {
			header('Location: erreur.html');
			exit();
		}
					
          ?>
        </center>
	</body>
</html>
