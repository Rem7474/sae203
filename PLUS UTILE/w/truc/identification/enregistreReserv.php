<?php
session_start(); // on initialise les sessions
require_once '../fonctionConnexion.php'; 	// déclaration du fichier contenant des fonctions pouvant être appelées
require_once '../fonctionBDD.php'; // délaration du fichier contenant des fonctions liées à l'utilisation de la BDD pouvant  êre appelées
require_once '../fonctionSys.php';
$conn1=connexionBDD('paramcon.php'); 	// appel de la fonction connexionBDD. Le résultat retourné (un connecteur à la bdd) sera dans la variable $conn1

if(isset($_SESSION['nomclient'])){
		$nom = $_SESSION['idclient']
		
?>
<html>
	<head>
		<title>Titre : Enregistrement du gestionnaire</title>
		<meta charset="utf-8"/>
	</head>
	<body>

		<br /> <!-- saut de ligne en html -->

			</html>
		<?php

		// on récupère les paramètres GET ou POST (elles sont dans le tableau sur le serveur) et on crée une nouvelle variable pour les appeler ultérieurement
		//(cette opération n'est pas obligatoire - on peut accéder par la suite à la variable par le tableau
		// on préfère pour des raisons de clareté de code copier la variable du tableau dans une variable (php)

		$local_name= $nom ; // création et affectation de la variable php avec l'info issue du formulaire de saisie
		
		$local_date= $_GET['P_date'] ; // création et affectation de la variable php avec l'info issue du formulaire de saisie
		
		$local_etat= "2" ;
		
		$local_parcour= $_GET['P_parcour'] ;
		
		$local_nb= $_GET['P_nb'] ;

		$index=enregistreReserv($local_name, $local_date, $local_etat, $local_parcour, $local_nb, $conn1); // appel de la fonction enregistreClient ; on passe en paramètre le nom du client (ici dans une variable)
		
		
		// fermeture de la connexion a la base de donnees.
		deconnexionBDD($conn1);

		?>
		<?php
		      $res=ListerIdreserv($conn1);				// appel de la fonction listerClients avec le connecteur $conn1
		      $resu = $res->fetchAll(); // on récupère le tout dans un tableau. Dans le tableau résultat, la 1ère ligne est associée à chaque ligne qui suit.
					foreach ($resu as $ligne) { // pour chaque ligne du tableau globale 2D (une ligne est vue comme un tableau 1D)
						$leNom=$ligne["idreservation"]; // on récupère la variable de la ligne en cours avec le nom de son champ. Ici le champ s'appelle "nomclient" qui est le nom de l'attribut de la table.
						
					}
					deconnexionBDD($conn1); // fermeture de la connexion $conn1
					echo "<p>Votre reservation a été envoyé : elle est en attente de validation</p><p>vous etes redirigé vers la page d'acceuil des reservations dans 4 secondes</p>";
					header("Refresh:4 ;URL=./PageAcceuilReserv.html");
        ?>

<?php  
	}
	else{ // si l'utilisateur n'est pas connecté on affiche le bouton connexion
?>
	<div id="connexion">
		<p>Vous n'êtes pas connecté</p> 
		<a href="clientconnexion.php">Cliquez ici pour vous connecter</a>
	</div>
<?php 
	}
?>