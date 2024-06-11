<<<<<<< HEAD
<!-- Page de supression de l'article contenue dans le cookie du panier -->
<?php
include('header.php');
include('checkacheteur.php');
//on récupère l'id de l'article
$idarticle=$_GET['idarticle'];
//on récupère le panier dans le cookie
$panier = isset($_COOKIE['panier']) ? json_decode($_COOKIE['panier'], true) : [];
//on modifie le le cookie en supprimant le couple clé valeur dans l'array
unset($panier[$idarticle]);
//on modifie le cookie si il reste des articles dans le panier
if (count($panier) > 0) {
    $panierJson = json_encode($panier);
    setcookie("panier",$panierJson,time()+3600, '/');
} else {
    //sinon on supprime le cookie
    setcookie('panier', '', time() - 3600, '/');
}
//on redirige vers la page panier
//header("Location: panier.php");
=======
<!-- Page de supression de l'article contenue dans le cookie du panier -->
<?php
include('header.php');
include('checkacheteur.php');
//on récupère l'id de l'article
$idarticle=$_GET['idarticle'];
//on récupère le panier dans le cookie
$panier = isset($_COOKIE['panier']) ? json_decode($_COOKIE['panier'], true) : [];
//on modifie le le cookie en supprimant le couple clé valeur dans l'array
unset($panier[$idarticle]);
//on modifie le cookie si il reste des articles dans le panier
if (count($panier) > 0) {
    $panierJson = json_encode($panier);
    setcookie("panier",$panierJson,time()+3600, '/');
} else {
    //sinon on supprime le cookie
    setcookie('panier', '', time() - 3600, '/');
}
//on redirige vers la page panier
//header("Location: panier.php");
>>>>>>> 521457ac98f141eec458e34e9992cda7c61fff25
?>