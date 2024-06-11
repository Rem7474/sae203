<?php
// information sur les parametres de connexion a la base de données
//----------------------------------------------------
  // Mettre ci-dessous votre login bdd:
$user="cuvelire";
 // Mettre ci-dessous votre mot de passe bdd
$pass="2iuP3u";
// Mettre ci-dessous le nom de votre base
$dbname="cuvelire_VENTE";
// Mettre ci-dessous le nom du host (depend du serveur). Si le serveur web se trouve sur la même machine que le serveur bdd, la valeur sera "localhost".
$lehost="srv-peda-new";
// Mettre ci-dessous le nom du port (depend de la config du serveur). Généralement 5432.
$leport="5432";

$dsn='pgsql:host='.$lehost.';dbname='.$dbname.';port='.$leport;
//echo $dsn."<br/>";  // pour vérif. Permet l'affichage du dsn à l'écran (avec un retour à la ligne).

// connexion à la bdd (connexion non persistante) avec le connecteur nommé $conn1
try { // essai de connexion
    $conn1 = new PDO($dsn, $user, $pass); // tentative de connexion
    print "Connecté :)<br />"; // message de debug

} catch (PDOException $e) { // si erreur
    print "Erreur de connexion à la base de données ! : " . $e->getMessage(); // pour exception
    die(); // Arrêt du script - sortie.
}
//si pas erreur, on continue !
// $conn1 est le connecteur de notre base de données.
?>
<html>
	<head>
		<!-- Affichage du parametre dans le titre dela page -->
		<title>Titre : Enregistrement du client <?php echo $_GET['P_nomClient'] ?></title>
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

    $local_nomClient= $_GET['P_nomClient'] ; // création et affectation de la variable php avec l'info issue du formulaire de saisie
    echo $local_nomClient."<br />"; // affichage pour contrôle avec un retour à la ligne (balise <br />).


		$sql="INSERT INTO CLIENTS (NomClient) VALUES ('".$local_nomClient."') RETURNING idclient;"; // initialisation de la variable $sql qui contient la commande à éxécuter
        // à noter la présence de RETURNING idcleint qui permettra de récuperer l'id affecté par le système via SERIAL (voir ci-après)
		//on peut également écrire sous forme moins stricte cette affectation en n'utilisant pas la concaténation (.). Le php tolère ce type d'écriture :
		//$sql="INSERT INTO CLIENTS (NomClient) VALUES ('$local_nomClient') RETURNING idclient;";
    $resu=$conn1->query($sql);				// demande d'execution de la requête sur la base via le connecteur $conn1. Le resultat est dans la variable $resu.

    //Pour récupére l'id affecté automatiquement (à cause du SERIAL)
    $index = $resu->fetchColumn(); // retourne l'élément RETURNING
    print "l'identifiant de ce client est ".$index."<br/>";

		// fermeture de la connexion a la base de donnees.
		$conn1 = null; // fermeture de connexion

		?>
		Fin code enregistrement du client <?php echo $local_nomClient ?>
		<br />
	<h2>Verifier que l'enregistrement est effectif dans la base de données (avec phpPgAdmin par exemple)<h2>
	</body>
</html>
