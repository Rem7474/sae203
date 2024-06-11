<?php
// Démarrer une session PHP
session_start();
require_once 'fonctionsConnexion.php';
require_once 'fonctionsBDD.php';
require_once 'fonctionSys.php';
$conn1 = connexionBDD('parametres.ini');
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id'])) {
    $lien_compte = '<li><a href="myaccount.php">Mon compte</a></li>';
    $lien_deconnexion = '<li><a href="logout.php">Déconnexion</a></li>';
} else {
    $lien_compte = '<li><a href="login.php">Connexion</a></li>';
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
    $lien_ajout_article = '<li><a href="formulaireNewArticle.php">Ajouter un article</a></li>';
    $lien_mes_articles = '<li><a href="mesArticles.php">Mes articles</a></li>';
    $lien_vendus = '<li><a href="mesArticlesVendu.php">Mes ventes</a></li>';
}
else{
    $lien_ajout_article = '';
    $lien_mes_articles = '';
    $lien_vendus = '';
}
if ($role == "acheteur"){
    $lien_panier = '<li><a href="panier.php">Panier<span class="notif-article">'.$nbArticles.'</span></a></li>';
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array(); // Créer un panier s'il n'existe pas déjà
    }
    $liencommandes = '<li><a href="MesCommandes.php">Mes Commandes</a></li>';
}
else{
    $lien_panier = '';
    $liencommandes = '';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
    <title>RemEfficiAnt - Boutique en ligne</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type='text/javascript' src='script.js'></script>
    <!--Favicon-->
    <link rel="icon" type="image/png" href="images/favicon.jpg" />
</head>
<body>
    <header>
        <div class="header">
    <img src="images/logo.png" alt="logo" class="logo">
    <!--
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <?php //echo $lien_panier ?>
                <?php //echo $lien_ajout_article ?>
                <?php //echo $lien_mes_articles ?>
                <?php //echo $liencommandes ?>
                <?php //echo $lien_compte ?>
                <?php //echo $lien_deconnexion ?>
            </ul>
        </nav>
    -->
    <nav>
    <ul class="menu">
        <li><a href="index.php">Accueil</a></li>
        <?php echo $lien_panier ?>
        
        <?php echo $lien_ajout_article ?>
        <?php echo $lien_mes_articles ?>
        <?php echo $liencommandes ?>
        <?php echo $lien_vendus ?>
        <?php echo $lien_compte ?>
        <?php echo $lien_deconnexion ?>
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
