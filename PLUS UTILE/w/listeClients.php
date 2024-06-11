<?php
require_once 'fonctionsConnexion.php'; // déclaration du fichier contenant des fonctions pouvant être appelées
require_once("fonctionsBDD.php"); // déclaration du fichier contenant des fonctions liées à l'utilisation de la BDD pouvant être appelées

$conn1=connexionBDD('paramCon.php'); // appel de la fonction connexionBDD. Le résultat retourné sera dans la variable $conn1
// a partir d'ici, on est connecté à la BDD acec le connecteur $conn1
?>
<html>
	<head>
		<title>Clients : liste</title>
		<meta charset="utf-8"/>
	</head>
	
	<body>
		<center>
			<h1>Liste des clients</h1>
			<Table Border=2 bgcolor=grey>
				<tr>
					<td bgcolor=white> Liste des clients</td>
				</tr>
				<?php
		      $res=listerClients($conn1);				// appel de la fonction listerClients avec le connecteur $conn1
		      $resu = $res->fetchAll(); // on récupère le tout dans un tableau. Dans le tableau résultat, la 1ère ligne est associée à chaque ligne qui suit.

					// Debut code pour affichage du resultat :
					//====================================================================
					foreach ($resu as $ligne) { // pour chaque ligne du tableau globale 2D (une ligne est vue comme un tableau 1D)
						$leNom=$ligne["nomclient"]; // on récupère la variable de la ligne en cours avec le nom de son champ. Ici le champ s'appelle "nomclient" qui est le nom de l'attribut de la table.
						echo "<tr><td> ".$leNom."</td></tr>";       		// affichage (commande echo) sous forme d'un tableau html (tr, td).
					}
					// fin code affichage du résultat
					//====================================================================
					deconnexionBDD($conn1); // fermeture de la connexion $conn1
        ?>
			</table>
		</center>
	</body>
</html>
