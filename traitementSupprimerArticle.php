<<<<<<< HEAD
<!-- Page pour supprimer un article créé par le vendeur, l'admin peut aussi supprimer un article -->
<?php
include('header.php');
include('checklogin.php');
include('checkvendeur.php');
//récupérer l'id de l'article à supprimer
if (!isset($_GET['idarticle'])) {
    //redirige vers la page d'accueil en utilisant la page erreur.php
    header('Location: erreur.php?error=Vous devez spécifier l\'article à supprimer&page=index');
    exit();
}
$idarticle = $_GET['idarticle'];
//vérification du format de l'id de l'article en utilisant la fonction filtre
[$idarticle, $resultat]=filtre($idarticle, "int", 10);
if (!$resultat) {
    //redirige vers la page d'accueil en utilisant la page erreur.php en affichant que l'id de l'article n'est pas valide
    header('Location: erreur.php?error=L\'id de l\'article n\'est pas valide&page=index');
    exit();
}
//récuperer l'id du vendeur
$idvendeur=$_SESSION['id'];
//vérifier si l'utilisateur est bien celui qui a créé l'article
$article=RechercheArticleById($idarticle,$conn1);
$article=$article[0];
if($article['refvendeur']!=$idvendeur && $_SESSION['id'] != 1){
    //redirige vers la page d'accueil en utilisant la page erreur.php en affichant que l'utilisateur n'est pas le créateur de l'article
    header('Location: erreur.php?error=Vous n\'êtes pas le créateur de cet article&page=index');
    exit();
}
//supprimer l'article
$suppr=supprimerArticle($idarticle,$conn1);
if(!$suppr){
    //redirige vers la page d'accueil en utilisant la page erreur.php en affichant que l'article n'a pas pu être supprimé
    header('Location: erreur.php?error=L\'article n\'a pas pu être supprimé car il est dans une commande&page=index');
    exit();
}
//on supprime l'image de l'article dans le dossier upload/images qui s'appelle l'id de l'article
//on vérifie si le fichier existe
if (file_exists("upload/images/$idarticle.jpg")) {
    //on supprime le fichier
    unlink("upload/images/$idarticle.jpg");
}
if (file_exists("upload/images/$idarticle.png")) {
    //on supprime le fichier
    unlink("upload/images/$idarticle.png");
}
//rediriger vers la page mesArticles.php
header("Location: mesArticles.php");
exit();
include('footer.php');
?>
=======
<!-- Page pour supprimer un article créé par le vendeur, l'admin peut aussi supprimer un article -->
<?php
include('header.php');
include('checklogin.php');
include('checkvendeur.php');
//récupérer l'id de l'article à supprimer
if (!isset($_GET['idarticle'])) {
    //redirige vers la page d'accueil en utilisant la page erreur.php
    header('Location: erreur.php?error=Vous devez spécifier l\'article à supprimer&page=index');
    exit();
}
$idarticle = $_GET['idarticle'];
//vérification du format de l'id de l'article en utilisant la fonction filtre
[$idarticle, $resultat]=filtre($idarticle, "int", 10);
if (!$resultat) {
    //redirige vers la page d'accueil en utilisant la page erreur.php en affichant que l'id de l'article n'est pas valide
    header('Location: erreur.php?error=L\'id de l\'article n\'est pas valide&page=index');
    exit();
}
//récuperer l'id du vendeur
$idvendeur=$_SESSION['id'];
//vérifier si l'utilisateur est bien celui qui a créé l'article
$article=RechercheArticleById($idarticle,$conn1);
$article=$article[0];
if($article['refvendeur']!=$idvendeur && $_SESSION['id'] != 1){
    //redirige vers la page d'accueil en utilisant la page erreur.php en affichant que l'utilisateur n'est pas le créateur de l'article
    header('Location: erreur.php?error=Vous n\'êtes pas le créateur de cet article&page=index');
    exit();
}
//supprimer l'article
$suppr=supprimerArticle($idarticle,$conn1);
if(!$suppr){
    //redirige vers la page d'accueil en utilisant la page erreur.php en affichant que l'article n'a pas pu être supprimé
    header('Location: erreur.php?error=L\'article n\'a pas pu être supprimé car il est dans une commande&page=index');
    exit();
}
//on supprime l'image de l'article dans le dossier upload/images qui s'appelle l'id de l'article
//on vérifie si le fichier existe
if (file_exists("upload/images/$idarticle.jpg")) {
    //on supprime le fichier
    unlink("upload/images/$idarticle.jpg");
}
if (file_exists("upload/images/$idarticle.png")) {
    //on supprime le fichier
    unlink("upload/images/$idarticle.png");
}
//rediriger vers la page mesArticles.php
header("Location: mesArticles.php");
exit();
include('footer.php');
?>
>>>>>>> 521457ac98f141eec458e34e9992cda7c61fff25
