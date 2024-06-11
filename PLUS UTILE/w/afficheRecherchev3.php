<?php
require_once 'fonctionsConnexion.php'; // déclaration du fichier contenant des fonctions pouvant être appelées
$conn1=connexionBDD('paramCon.php'); // appel de la fonction connexionBDD. Le résultat retourné sera dans la variable $conn1
// a partir d'ici, on est connecté à la BDD acec le connecteur $conn1

require_once 'fonctionsBDD.php'; // déclaration du fichier contenant des fonctions liées à l'utilisation de la BDD pouvant être appelées
require_once 'fonctionSys.php'; // déclaration du fichier contenant des fonctions orientées système (filtrage)

?>
<html>
	<head>
		<title> Liste des articles</title>
		<meta charset="utf-8"/>
	</head>

	<body>
		<center>
			<h1> Liste des articles de prix supérieur </h1>
			<Table Border=2 bgcolor=grey>
				<tr>
					<td bgcolor=white> Liste des articles </td>
				</tr>
				<?php
					if (!isset($_GET["prix"])) {
						header("Location:./erreur.html");
						exit;
						}
					$local_prix=$_GET["prix"]; // récupération et filtrage du prix
					$regex  = "@^[0-9]{1,10}+$@";
                    if (!preg_match($regex,$local_prix)) {
                        header("Location:./erreur.html");
						exit;
                    }
					$resultat=rechercheArticlev3($conn1,$local_prix);
					$resu = $resultat->fetchAll(); // on récupère le tout dans un tableau. Dans le tableau résultat, la 1ère ligne est associée à chaque ligne qui suit.

					// Debut code pour affichage du resultat :
					//====================================================================
					afficheTableau($resu);  // utilisation d'une fonction permettant d'afficher un résutlat de requête après un fetchall. Cette fonction est définie dans fonctionSys.php

					//print "<tr><td>designation</td><td>info suppl</td><td>Prix</td></tr>";
					/*foreach ($resu as $ligne) { // pour chaque ligne du tableau globale 2D (une ligne est vue comme un tableau 1D)
							echo "<tr><td> ".$ligne["designation"]."</td><td>".$ligne["infosuppl"]."</td><td>".$ligne["prixvente"]."</td></tr>";       		// affichage (commande echo) sous forme d'un tableau html (tr, td).
					}*/

					// fin code affichage du résultat
					//====================================================================
					deconnexionBDD($conn1); // fermeture de la connexion $conn1
				?>
			</table>
		</center>
	</body>
</html>
