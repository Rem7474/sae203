<?php
require_once 'fonctionsConnexion.php'; 	// déclaration du fichier contenant des fonctions pouvant être appelées
require_once 'fonctionsBDD.php'; // délaration du fichier contenant des fonctions liées à l'utilisation de la BDD pouvant  êre appelées

$conn1=connexionBDD('paramCon.php'); 	// appel de la fonction connexionBDD. Le résultat retourné (un connecteur à la bdd) sera dans la variable $conn1
// à partir d'ici, on est connecté à  la BDD acec le connecteur $conn1
?>
<html>
	<head>
		<title>Titre : Enregistrement du client</title>
		<meta charset="utf-8"/>
	</head>
	<body>
		<h1>Enregistrement dans la bdd</h1>

		<!-- ceci est un commentaire en HTML -->
		<h2>La variable reçue est normalement présente dans l'url.</h2>
		<strong>Vérifiez sa présence</strong>
		<br /> <!-- saut de ligne en html -->

		Variable(s) reçue(s) (pour verification) :
		<?php
		// on récupère les paramètres GET ou POST (elles sont dans le tableau sur le serveur) et on crée une nouvelle variable pour les appeler ultérieurement
		//(cette opération n'est pas obligatoire - on peut accéder par la suite à la variable par le tableau
		// on préfère pour des raisons de clareté de code copier la variable du tableau dans une variable (php)

		$local_nomClient= $_GET['P_nomClient']; // création et affectation de la variable php avec l'info issue du formulaire de saisie
		$local_prenomClient= $_GET['P_prenomClient'];
		echo $local_nomClient."<br />"; // affichage pour contrôle avec un retour à la ligne (balise <br />).
		echo $local_prenomClient."<br />";
		$index=enregistreClient($local_nomClient,$local_prenomClient, $conn1); // appel de la fonction enregistreClient ; on passe en paramètre le nom du client (ici dans une variable)
		print "l'identifiant de ce client est ".$index."<br/>";

		// fermeture de la connexion a la base de donnees.
		deconnexionBDD($conn1);

		?>
		Fin code enregistrement du client <?php echo $local_nomClient ?>
		<br />
		<h2>Verifier que l'enregistrement est effectif dans la base de données (avec phpPgAdmin par exemple)<h2>
	</body>
</html>
