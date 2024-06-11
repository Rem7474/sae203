<?php
require_once 'fonctionsConnexion.php';
require_once 'fonctionsBDD.php';
$conn1=connexionBDD('paramCon.php');
?>
<html>
	<head>
		<title> Formulaire de saisie de commande </title>
		<meta charset="utf-8"/>
	</head>
	<body>
		<center>
			<h1> Formulaire : Nouvelle commande</h1>
		<form method="GET" action="enregistreCommande.php">
        &nbsp; <!-- &nbsp; est le code "espace" en html -->
        date de la commande : &nbsp; <input type = "text" name="P_date"> &nbsp; Client :&nbsp;
        <?php
        $resultat=listerClients($conn1);
        $resuTab = $resultat->fetchAll(); // on récupère le tout dans un tableau. Dans le tableau résultat, la 1ère ligne est associée à chaque ligne qui suit.

				
				print("<pre>");
				print_r($resuTab);
				print("</pre>");
				
        // fabrication de lliste déroulante (balise SELECT) à partir des clients (infos issues de la bdd)
        print '<select name="P_refClient">'; // envoyé comme paramètre dans le formulaire
        foreach ($resuTab as $ligne) {
                print '<option value="'.$ligne[1].'">'.$ligne[0].'</option>'; // pour créer chaque ligne de choix
        }
        print "</select>";
        ?>
			&nbsp;
			<input type="submit" value="Envoyer"></td>
		</form>
		<center>
		
	</body>
</html>
<?php
deconnexionBDD($conn1); // fermeture de connexion BDD
?>
