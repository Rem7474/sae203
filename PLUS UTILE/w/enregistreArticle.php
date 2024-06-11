<?php
require_once 'fonctionsConnexion.php';
require_once 'fonctionsBDD.php';
require_once 'fonctionSys.php';
$conn1=connexionBDD('paramCon.php');
?>
<html>
	<head>
		<title>Titre : Enregistrement de l'article</title>
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
		if (!isset($_GET["P_nomArticle"]) || !isset($_GET["P_prix"])) {
			header("Location:./erreur.html");
			exit;
			}
		$local_nomArticle= pg_escape_string($_GET['P_nomArticle']) ;
		$local_prixArticle= pg_escape_string($_GET['P_prix']) ;
		$regexnom  = "@^[A-Za-z0-9 ]{1,15}$@";
		$regexprix  = "@^[0-9]{1,6}$@";
		if (!preg_match($regexnom,$local_nomArticle)) {
			header("Location:./erreur.html");
			exit;
		}
		if (!preg_match($regexprix,$local_prixArticle)) {
			header("Location:./erreur.html");
			exit;
		}
        echo $local_nomArticle."<br />";
        echo $local_prixArticle."<br />";
		$index=EnregistreNouvelArticlev2($local_nomArticle, $local_prixArticle, $conn1);
		print "les infos sur l'article sont : ".$local_nomArticle." de prix ".$local_prixArticle."<br/>";

		// fermeture de la connexion a la base de donnees.
		deconnexionBDD($conn1);

		?>
		Fin code enregistrement de l'article <?php echo $local_nomArticle ?>
		<br />
		<h2>Verifier que l'enregistrement est effectif dans la base de données (avec phpPgAdmin par exemple)<h2>
	</body>
</html>
