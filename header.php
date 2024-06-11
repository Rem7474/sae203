<?php
// Démarrer une session PHP
session_start();
require_once 'fonctionsConnexion.php';
require_once 'fonctionsBDD.php';
require_once 'fonctionSys.php';
$conn1 = connexionBDD('./private/parametres.ini');
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id'])) {
    $lien_compte = '<li class="icone_menu account"><a href="myaccount.php"><img src=./upload/images/vendeurs/'.$_SESSION['id'].' alt="myaccount"></a></li>';
    $lien_deconnexion = '<li><a href="logout.php"><i class="bi bi-box-arrow-right"></i></a></li>';
} else {
    $lien_compte = '<li class="icone_menu"><a href="login.php"><i class="bi bi-box-arrow-in-left"></i></a></li>';
    $lien_deconnexion = '';
}
if(isset($_SESSION['prenom'])){
    $nom = $_SESSION['prenom'];
}
else{
$nom = "NON CONNECTE";
}
if (isset($_COOKIE['panier'])) {
    // Récupérer la chaîne JSON du cookie
    $panier = isset($_COOKIE['panier']) ? json_decode($_COOKIE['panier'], true) : [];
    // Compter le nombre d'articles dans le panier
    $nbArticles = count($panier);
} else {
    $nbArticles = 0;
}
//on regarde si l'utilisateur est un vendeur ou un acheteur
if(isset($_SESSION['role'])){
    $role = $_SESSION['role'];
}
else{
    $role = "";
}
//on regarde si l'utilisateur est un vendeur ou un acheteur
if ($role == "vendeur"){
    $lien_ajout_article = '<li class="icone_menu"><a href="formulaireNewArticle.php"><i class="bi bi-plus-circle-fill"></i></a></li>';
    $lien_mes_articles = '<li class="icone_menu"><a href="mesArticles.php"><i class="bi bi-eye-fill"></i></a></li>';
    $lien_vendus = '<li class="icone_menu"><a href="mesArticlesVendu.php"><i class="bi bi-receipt"></i></a></li>';
}
else{
    $lien_ajout_article = '';
    $lien_mes_articles = '';
    $lien_vendus = '';
}
if ($role == "acheteur"){
    if ($nbArticles == 0){
        $lien_panier = '<li class="icone_menu"><a href="panier.php"><i class="bi bi-bag"></i></a></li>';
    }
    else{
        $lien_panier = '<a id="notif" href="panier.php"><span class="notif-article">'.$nbArticles.'</span></a><li class="icone_menu"><a href="panier.php"><i class="bi bi-bag-fill"></i></a></li>';
    }
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array(); // Créer un panier s'il n'existe pas déjà
    }
    $liencommandes = '<li class="icone_menu"><a href="MesCommandes.php"><i class="bi bi-archive-fill"></i></a></li>';
}
else{
    $lien_panier = '';
    $liencommandes = '';
}
$lien_admin = '';
if (isset($_SESSION['id'])){
if ($_SESSION['id'] == 1){
    $lien_admin = '<li><a href="admin.php"><i class="bi bi-person-fill-gear"></i></a></li>';
}
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
    <title>RemEfficiAnt - Boutique en ligne</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script type='text/javascript' src='js/script.js'></script>
    <!--Favicon-->
    <link rel="icon" type="image/png" href="images/favicon.jpg" />
</head>
<body>
    <header>
        <div class="header">
    <img src="images/logo.png" alt="logo" class="logo">
    <nav>
    <ul class="menu">
        <li><a href="index.php"><i class="bi bi-house-fill"></i></a></li>
        <?php echo $lien_panier ?>
        
        <?php echo $lien_ajout_article ?>
        <?php echo $lien_mes_articles ?>
        <?php echo $liencommandes ?>
        <?php echo $lien_vendus ?>
        <?php echo $lien_admin ?>
        <?php echo $lien_deconnexion ?>
        <?php echo $lien_compte ?>
    </ul>
        <div class="burger-menu menu-toggle">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </nav>
        <!--Logo-->
        
        </div>
    </header>
    <div class="page">
