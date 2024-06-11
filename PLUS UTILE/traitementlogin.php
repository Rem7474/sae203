<!-- Code php de traitement du formulaire de connexion -->
<?php
include('header.php');
?>
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
// on vérifie l'existance des variables post mail et mdp
if (!isset($_POST['mail']) || !isset($_POST['mdp'])) {
    //redirigé vers la page de connexion en utilisant la page erreur.php
    header('Location: erreur.php?error=Erreur lors de l\'envoi du formulaire&page=login');
    exit();
}
$login = $_POST['mail'];
$mdp = $_POST['mdp'];

//on vérifies que les variables sont au format attendu
if (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
    //redirigé vers la page de connexion en utilisant la page erreur.php
    header('Location: erreur.php?error=Le mail n\'est pas valide&page=login');
    exit();
}
[$mdp, $resultat]=filtre($mdp, "password", 20);
if ($resultat == false) {
    //redirigé vers la page de connexion en utilisant la page erreur.php
    header('Location: erreur.php?error=Le mot de passe n\'est pas valide&page=login');
    exit(); 
}
//on vérifie que l'utilisateur existe, la variable $check contient le résultat de la requête sous la forme d'une array
$check = CheckUser($login, $conn1);
//comptage du nombre de lignes de l'array
$resultat = $check[0];
//affichage de l'array en html
//echo "<pre>";
//print_r($resultat);
//echo "</pre>";
$row = count($resultat);
// Si l'utilisateur existe
if ($row > 0) {
    // Si le mot de passe est le bon
    if (password_verify($mdp, $resultat['motdepasse'])) {
        // On créer la session et on redirige
        echo("<p class='succes'>Vous êtes connecté</p>");
        $_SESSION['id'] = $resultat['idutilisateur'];
        //Récupère l'information si l'utilisateur est vendeur ou acheteur
        $acheteur=CheckAcheteur($resultat['idutilisateur'], $conn1);
        $vendeur=CheckVendeur($resultat['idutilisateur'], $conn1);
        //On vérifie si l'utilisateur est un acheteur ou un vendeur en testant si l'array est vide ou non
        if (!empty($acheteur)) {
            $_SESSION['role'] = "acheteur";
        } else if (!empty($vendeur)) {
            $_SESSION['role'] = "vendeur";
        }
        //si l'utilisateur est ni acheteur ni vendeur, on affiche un message d'erreur
        else {
            //redirigé vers la page de connexion en utilisant la page erreur.php
            header('Location: erreur.php?error=Vous n\'avez pas de rôle&page=login');
            exit();
        }
        $_SESSION['nom'] = $resultat['nomutilisateur'];
        $_SESSION['prenom'] = $resultat['prenom'];
        $_SESSION['adresse'] = $resultat['adresse'];
        $_SESSION['ville'] = $resultat['ville'];
        $_SESSION['cp'] = $resultat['codepostal'];
        $_SESSION['pays'] = $resultat['pays'];
        $_SESSION['tel'] = $resultat['telephone'];
        $_SESSION['email'] = $resultat['email'];
        $_SESSION['dateNaissance'] = $resultat['datenaissance'];
        $_SESSION['dateInscription'] = $resultat['dateinscription'];
        //redirigé vers la page d'accueil en utilisant la page succes.php
        header('Location: succes.php?success=Vous êtes connecté&page=index');
    } else {
        // Si le mot de passe est incorrect on le redirige vers la page de connexion avec un message d'erreur avec la page erreur.php
        header('Location: erreur.php?error=Le mot de passe est incorrect&page=login');
        exit();
    }
} else {
    // Si l'utilisateur n'existe pas on le redirige vers la page de connexion avec un message d'erreur avec la page erreur.php
    header('Location: erreur.php?error=cet utilisateur n\'existe pas&page=login');
    exit();
}
?>
