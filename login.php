<!-- Forumulaire de connexion -->
<?php 
include('header.php'); 
//vérifie si un la page est appelée par un formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //affichage de la pge de validation du formulaire
    // Vérifier si toutes les données du formulaire ont été envoyées
    // on vérifie l'existance des variables post mail et mdp
if ((!isset($_POST['mail']) || !isset($_POST['mdp'])) &&  (!empty($_POST['mail']) || !empty($_POST['mdp']))){
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
        exit();
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
}
//si la page est appelée sans formulaire, on affiche le formulaire
else {
//on vérifie si l'utilisateur est déjà connecté
if (isset($_SESSION['id'])) {
    //redirigé vers la page d'accueil en utilisant la page succes.php
    header('Location: succes.php?success=Vous êtes déjà connecté&page=index');
    exit();
}
?>
<head>
    <meta charset="UTF-8">
    <title>Formulaire de connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Formulaire de connexion</h1>
    <form action="login.php" method="post" class="scaleup">
        <p>
            <label for="mail">E-mail</label>
            <input type="email" name="mail" id="mail" placeholder="Entrer votre email" required>
        </p>
        <p>
            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp" id="mdp" placeholder="Entrer votre Mot de passe" required>
        </p>
        <p>
            <input type="submit" value="Se connecter">
        </p>
        <p class="sous-texte">Pas encore de compte ? <a href="register.php">Créer un compte</a></p>
    </form>
    <!-- lien pour créer un compte -->
    
</body>
<?php }
include('footer.php'); ?>
