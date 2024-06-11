<?php
require_once '../fonctionConnexion.php'; 	// déclaration du fichier contenant des fonctions pouvant être appelées
require_once '../fonctionBDD.php'; // délaration du fichier contenant des fonctions liées à l'utilisation de la BDD pouvant  êre appelées
require_once '../fonctionSys.php';


$conn1=connexionBDD('paramcon.php'); 	// appel de la fonction connexionBDD. Le résultat retourné (un connecteur à la bdd) sera dans la variable $conn1
// à partir d'ici, on est connecté à  la BDD acec le connecteur $conn1
?>

		<?php

		// on récupère les paramètres GET ou POST (elles sont dans le tableau sur le serveur) et on crée une nouvelle variable pour les appeler ultérieurement
		//(cette opération n'est pas obligatoire - on peut accéder par la suite à la variable par le tableau
		// on préfère pour des raisons de clareté de code copier la variable du tableau dans une variable (php)
if(isset($_POST)){
		$local_nom= $_POST['P_nom'] ; // création et affectation de la variable php avec l'info issue du formulaire de saisie
		$local_prenom= $_POST['P_prenom'] ; // création et affectation de la variable php avec l'info issue du formulaire de saisie
		$local_tel= $_POST['P_tel'] ; // création et affectation de la variable php avec l'info issue du formulaire de saisie
		$local_mdp= $_POST['P_mdp'] ; // création et affectation de la variable php avec l'info issue du formulaire de saisie
		$local_email= $_POST['P_email'] ; // création et affectation de la variable php avec l'info issue du formulaire de saisie
		
		
		if(!empty($local_email)) // Si il existe les champs email, password et qu'il sont pas vident
        {
            
            $pseudoGestio = htmlspecialchars($local_email);

    // chifrement du mot de passe
            // On regarde si l'utilisateur est inscrit dans la table utilisateurs
            $check = checkclient($pseudoGestio,$conn1);
            $data = $check->fetch();
            $row = $check->rowCount();
		}
            // Si > à 0 alors l'utilisateur existe
            if($row > 0)
            {
                echo"<p class='erreur'>Ce mail est deja utilisé<p>";}
			else{
					$local_nom=pg_escape_string($local_nom);
					$local_prenom=pg_escape_string($local_prenom);
					$local_tel=pg_escape_string($local_tel);
					$local_mdp=pg_escape_string($local_mdp);
					$local_email=pg_escape_string($local_email);

					$regex_mdp  = "@^\w{1,20}$@";
					$regex_tel  = "@^\w{1,20}$@";

				if (preg_match_all($regex_tel, $local_tel, $resultats)) {
					if (preg_match_all($regex_mdp,$local_mdp,$resultats)) {

					$local_mdp = hash('sha256', $local_mdp);

					$index=enregistreClient($local_nom, $local_prenom, $local_email, $local_mdp, $local_tel, $conn1);// appel de la fonction enregistreClient ; on passe en paramètre le nom du client (ici dans une variable)
					echo"<p class='erreur'>Compte créé<p><p>vous etes redirigé vers la page de connexion dans 2 sec</P>";
					header("Refresh:2 ;URL=./clientconnexion.php");
				}else {
				print "pas de correspondance du motif";
				}
			}else{
				print "pas de correspondance du motif";
			}
				
				}
			  
}		
			
			
		


		

		 // appel de la fonction enregistreClient ; on passe en paramètre le nom du client (ici dans une variable)

		// fermeture de la connexion a la base de donnees.
		deconnexionBDD($conn1);

		?>

