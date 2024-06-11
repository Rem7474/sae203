<!-- Formulaire d'inscription -->
<?php
require_once 'fonctionsConnexion.php';
require_once 'fonctionsBDD.php';
require_once 'fonctionSys.php';
$conn1 = connexionBDD('parametres.ini');
include('header.php');
?>
<head>
    <meta charset="UTF-8">
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
// on vérifie l'existence des variables du formulaire
if (!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['dateNaissance']) || !isset($_POST['adresse']) || !isset($_POST['codePostal']) || !isset($_POST['ville']) || !isset($_POST['pays']) || !isset($_POST['telephone']) || !isset($_POST['mail']) || !isset($_POST['mdp']) || !isset($_POST['mdp2']) || !isset($_POST['type'])) {
    //redirige vers la page d'accueil avec un message d'erreur
    header('Location: erreur.php?error=Les données du formulaire sont incomplètes&page=index');
    exit();
}
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$dateNaissance = $_POST['dateNaissance'];
$adresse = $_POST['adresse'];
$codePostal = $_POST['codePostal'];
$ville = $_POST['ville'];
$pays = $_POST['pays'];
$telephone = $_POST['telephone'];
$mail = $_POST['mail'];
$type = $_POST['type'];
$mdp = $_POST['mdp'];
$mdp2 = $_POST['mdp2'];

// on vérifie que les deux mots de passe sont identiques
if ($mdp != $mdp2) {
    //redirige vers la page de création de compte avec un message d'erreur
    header('Location: erreur.php?error=Les mots de passe ne sont pas identiques&page=register');
    exit();
}
// on vérifie que le mail n'est pas déjà utilisé
$check = CheckUser($mail, $conn1);
if (!empty($check)) {
    //redirige vers la page de création de compte avec un message d'erreur
    header('Location: erreur.php?error=Le mail est déjà utilisé&page=register');
    exit();
}
//on vérifie que les données réspectenet le format attendu grace a la fonction filtre qui est dans fonctionSys.php
/* ------------------------------------------------
Fonction qui traiter une variable en fonction du type attendu et de la longueur maximale, on utilise la 
Paramètres d'entrée :
 - $texte : chaîne de caractères à filtrer
 - $type : type de la variable (int, float, string, date, password)
 - $longueurMax : longueur maximale de la variable
 ------------------------------------------------*/
 //on récupère l'array retourné par la fonction filtre
[$nom, $resultat]=filtre($nom, "string", 20);
if ($resultat == false) {
    //on affiche un message d'erreur et on redirige vers la page de création de compte
    header('Location: erreur.php?error=Le nom n\'est pas valide&page=register');
    exit();
}
[$prenom, $resultat]=filtre($prenom, "string", 20);
if ($resultat == false) {
    header('Location: erreur.php?error=Le prénom n\'est pas valide&page=register');
    exit();
}
[$dateNaissance, $resultat]=filtre($dateNaissance, "date", 10);
if ($resultat == false) {
    header('Location: erreur.php?error=La date de naissance n\'est pas valide&page=register');
    exit();
}
[$adresse, $resultat]=filtre($adresse, "adresse", 50);
if ($resultat == false) {
    //on affiche un message d'erreur et on redirige vers la page de création de compte
    header('Location: erreur.php?error=L\'adresse n\'est pas valide&page=register');
    exit();
}
[$codePostal, $resultat]=filtre($codePostal, "cp", 5);
if ($resultat == false) {
    header('Location: erreur.php?error=Le code postal n\'est pas valide&page=register');
    exit();
}
[$ville, $resultat]=filtre($ville, "string", 50);
if ($resultat == false) {
    //on affiche un message d'erreur et on redirige vers la page de création de compte
    header('Location: erreur.php?error=La ville n\'est pas valide&page=register');
    exit();
}
[$pays, $resultat]=filtre($pays, "string", 50);
if ($resultat == false) {
    //on affiche un message d'erreur et on redirige vers la page de création de compte
    header('Location: erreur.php?error=Le pays n\'est pas valide&page=register');
    exit();
}
[$telephone, $resultat]=filtre($telephone, "tel", 10);
if ($resultat == false) {
    //on affiche un message d'erreur et on redirige vers la page de création de compte
    header('Location: erreur.php?error=Le téléphone n\'est pas valide&page=register');
    exit(); 
}
[$mail, $resultat]=filtre($mail, "mail", 50);
if ($resultat == false) {
    //on affiche un message d'erreur et on redirige vers la page de création de compte
    header('Location: erreur.php?error=Le mail n\'est pas valide&page=register');
    exit(); 
}
[$mdp, $resultat]=filtre($mdp, "password", 20);
if ($resultat == false) {
    //on affiche un message d'erreur et on redirige vers la page de création de compte
    header('Location: erreur.php?error=Le mot de passe n\'est pas valide&page=register');
    exit(); 
}
[$type, $resultat]=filtre($type, "int", 1);
if ($resultat == false) {
    //on affiche un message d'erreur et on redirige vers la page de création de compte
    header('Location: erreur.php?error=Le type de compte n\'est pas valide&page=register');
    exit(); 
}
// on crypte le mot de passe
$mdp = password_hash($mdp, PASSWORD_DEFAULT);
// on insère les données dans la table client
$test=CreationUtilisateur($nom,$prenom,$adresse,$ville,$codePostal,$pays,$telephone,$mail,$mdp,$dateNaissance,$type,$conn1);
// on ferme la connexion
deconnexionBDD($conn1);
if ($test > 0) {
    // on redirige vers la page de connexion avec un message de succès avec la page success.php
    header('Location: success.php?success=Votre compte a bien été créé, merci de votre confiance&page=login');
    exit();
}
else {
    // on redirige vers la page de création de compte avec un message d'erreur
    header('Location: erreur.php?error=Une erreur est survenue lors de la création de votre compte&page=register');
    exit();
}
include('footer.php'); 
?>