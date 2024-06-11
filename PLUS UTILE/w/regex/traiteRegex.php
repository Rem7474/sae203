<html>
	<head>
		<title> Traitement </title>
		<meta charset="utf-8"/>
	</head>
	<body>
			<h1> Traitement regex </h1>
		<?php
			$chaine = "FFFAAFEG";
			print "<h2>Chaine à tester : </h2>";
			print "<p>".$chaine."</p><br/>";

			$regex  = "@^[0-9A-F]{1,5}$@";
			print "<h2>Motif (expression régulière) : </h2>";
			print "<p>".$regex."</p><br/>";

			print "<h2>Résultat de la recherche par expression régulière : </h2>";
			if (preg_match_all($regex, $chaine, $resultats)) { // il y a une correspondance
				// preg_match_all retourne true s'il y a une correspondance
					print "<p>Motif en correspondance !!!!!!!!!!!!</p>";

					print "<p>Détail du résultat : </p>";
					echo "<pre>" ;
					print_r($resultats) ;
					echo "</pre>" ;

			} else {
					print "pas de correspondance du motif";
			}
		?>
	</body>
</html>
