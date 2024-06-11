<!-- Traitement de l'ajout d'un article -->
<?php
include('header.php');
// Vérifier si l'utilisateur est connecté
include('checklogin.php');
//on regarde si l'utilisateur est un vendeur 
include('checkVendeur.php');
// Vérifier si toutes les données du formulaire ont été envoyées
if (!isset($_POST['nom']) || !isset($_POST['description']) || !isset($_POST['prix']) || !isset($_POST['categorie']) || !isset($_FILES['image']) || !isset($_POST['quantite'])) {
    //redirige vers la page d'ajout d'article en utilisant la page erreur.php
    header('Location: erreur.php?error=Erreur lors de l\'envoi du formulaire&page=formulaireNewArticle');
    exit();
}
// Récupérer les données du formulaire
$nom = $_POST['nom'];
$description = $_POST['description'];
$prix = $_POST['prix'];
$quantite = $_POST['quantite'];
$categorie = $_POST['categorie'];
$image = $_FILES['image'];
$idvendeur=$_SESSION['id'];
// Vérifier si les données sont vides
if (empty($nom) || empty($description) || empty($prix) || empty($categorie) || empty($image) || empty($quantite)) {
    //redirige vers la page d'ajout d'article en utilisant la page erreur.php
    header('Location: erreur.php?error=Veuillez remplir tous les champs&page=formulaireNewArticle');
    exit();
}
//vérification des données avec la fonction filtre
[$nom, $resultat]=filtre($nom, "string", 20);
if($resultat == false){
    //redirige vers la page d'ajout d'article en utilisant la page erreur.php
    header('Location: erreur.php?error=Le nom de l\'article est invalide&page=formulaireNewArticle');
    exit();
}
[$description, $resultat]=filtre($description, "string", 1000);
if($resultat == false){
    //redirige vers la page d'ajout d'article en utilisant la page erreur.php
    header('Location: erreur.php?error=La description de l\'article est invalide&page=formulaireNewArticle');
    exit();
}
[$prix, $resultat]=filtre($prix, "float",1000000);
if($resultat == false){
    //redirige vers la page d'ajout d'article en utilisant la page erreur.php
    header('Location: erreur.php?error=Le prix de l\'article est invalide&page=formulaireNewArticle');
    exit();
}
[$categorie, $resultat]=filtre($categorie, "int", 1000);
if($resultat == false){
    //redirige vers la page d'ajout d'article en utilisant la page erreur.php
    header('Location: erreur.php?error=La catégorie de l\'article est invalide&page=formulaireNewArticle');
    exit();
}
[$quantite, $resultat]=filtre($quantite, "int", 1000);
if($resultat == false){
    //redirige vers la page d'ajout d'article en utilisant la page erreur.php
    header('Location: erreur.php?error=La quantité de l\'article est invalide&page=formulaireNewArticle');
    exit();
}
//enregistrement de l'article dans la base de données avec la fonction AjouterArticle
$idarticle=NewArticle($nom,$prix,$quantite,$description,$categorie,$idvendeur,$conn1);
//enregistrer l'image dans le dossier images avec le nom correspondant à l'id de l'article
$nomImage = $idarticle . "." . pathinfo($image['name'], PATHINFO_EXTENSION);
move_uploaded_file($image['tmp_name'], "/var/www/RT/B13/upload/images/$nomImage");
//redirection vers la page de l'article
header("Location: article.php?id=$idarticle");
exit();
?>

