<?php
session_start();
require_once '../fonctionConnexion.php'; 	// déclaration du fichier contenant des fonctions pouvant être appelées
require_once '../fonctionBDD.php'; // délaration du fichier contenant des fonctions liées à l'utilisation de la BDD pouvant  êre appelées
require_once '../fonctionSys.php';


$conn1=connexionBDD('paramcon.php'); 	// appel de la fonction connexionBDD. Le résultat retourné (un connecteur à la bdd) sera dans la variable $conn1
// à partir d'ici, on est connecté à  la BDD acec le connecteur $conn1

if(isset($_POST['send'])){
    $pseudoG = $_POST["pseudoG"];
    $mdpG = $_POST["mdpG"];
    if(!empty($pseudoG) && !empty($mdpG)) // Si il existe les champs email, password et qu'il sont pas vident
        {
            
            $pseudoGestio = htmlspecialchars($pseudoG);
            $mdpGestio = htmlspecialchars($mdpG);
			$mdpGestio = hash('sha256', $mdpGestio);

    // chifrement du mot de passe
            // On regarde si l'utilisateur est inscrit dans la table utilisateurs
            $check = checkclient($pseudoGestio,$conn1);
            $data = $check->fetch();
            $row = $check->rowCount();

            // Si > à 0 alors l'utilisateur existe
            if($row > 0)
            {
                   $hash = $data['mdpclient'];
                    // Si le mot de passe est le bon
                    if($mdpGestio==$hash)
                    {
                        // On créer la session et on redirige
                        $_SESSION['nomclient'] = $data['nomclient'];
						$_SESSION['idclient'] = $data['idclient'];
						$_SESSION['prenomclient'] = $data['prenomclient'];
						$_SESSION['mailclient'] = $data['mailclient'];
						$_SESSION['telclient'] = $data['telclient'];
						$_SESSION['mdpclient'] = $data['mdpclient'];
                        header('Location: PageAcceuilReserv.html');
                        die();
                    }else{ echo "<p class='erreur'>Le mot de passe est incorrecte <p>"; 
                        die(); }
            }else{ echo"<p class='erreur'>L'utilisateur n'existe pas<p>";}
        }
}   



?>