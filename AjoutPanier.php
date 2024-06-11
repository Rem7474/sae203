<<<<<<< HEAD
<!-- Ajout d'un article dans le panier en fonction de leur ID passer en GET -->
<?php
include 'header.php';
include 'checklogin.php';
include 'checkacheteur.php';
//on regarde si l'id est passer dans le get et si il existe dans la bdd
if (!isset($_GET['id']) || !isset($_GET['quantite']) || empty($_GET['id']) || empty($_GET['quantite'])) {
    //affichage de l'erreur et redirection vers la page d'accueil avec la page erreur.php en précisant qu'il y a une erreur
    header('Location: erreur.php?error=Il manque des informations pour ajouter l\'article au panier&page=index');
}
else{
    $id = $_GET['id'];
    //on  verifie que l'id est un entier
    [$id, $resultat]=filtre($id, "int", 5);
    if($resultat == false){
        //affichage de l'erreur et redirection vers la page d'accueil avec la page erreur.php en précisant qu'il y a une erreur
        header('Location: erreur.php?error=L\'id de l\'article n\'est pas valide&page=index');
    }
    $article = RechercheArticleById($id, $conn1);
    $article=$article[0];
    if($article){
        //vérfication de la quantité de l'article
        $quantite_disponible = QuantiteArticle($id, $conn1);
        if($_GET['quantite'] > $quantite_disponible){
            //affichage de l'erreur et redirection vers la page d'accueil avec la page erreur.php en précisant qu'il y a une erreur
            header('Location: erreur.php?error=La quantité demandée n\'est pas disponible&page=index');
        }
        //ajout de l'article dans le panier de l'utilisateur (array)
        //$panier = $_SESSION['panier'];
        //$panier[$id] = $article;
        //$panier[$id]['quantite'] = $_GET['quantite'];
        //$_SESSION['panier'] = $panier;
        //ajout de l'article dans le panier de l'utilisateur (stockage dans un cookie)
        $panier = isset($_COOKIE['panier']) ? json_decode($_COOKIE['panier'], true) : [];
        //$panier[$id] = $article;
        $panier[$id] = $_GET['quantite'];
        $panierJson = json_encode($panier);
        setcookie('panier', $panierJson, time() + (3 * 30 * 24 * 60 * 60), '/');
        //affichage du panier avec le message de confirmation avec la page succes.php
        header('Location: succes.php?success=Article ajouté au panier&page=index');
        exit();
    }
    else{
        //affichage de l'erreur et redirection vers la page d'accueil avec la page erreur.php en précisant que l'article n'existe pas
        header('Location: erreur.php?error=L\'article n\'existe pas&page=index');
        exit();
    }
}
include 'footer.php';
=======
<!-- Ajout d'un article dans le panier en fonction de leur ID passer en GET -->
<?php
include 'header.php';
include 'checklogin.php';
include 'checkacheteur.php';
//on regarde si l'id est passer dans le get et si il existe dans la bdd
if (!isset($_GET['id']) || !isset($_GET['quantite']) || empty($_GET['id']) || empty($_GET['quantite'])) {
    //affichage de l'erreur et redirection vers la page d'accueil avec la page erreur.php en précisant qu'il y a une erreur
    header('Location: erreur.php?error=Il manque des informations pour ajouter l\'article au panier&page=index');
}
else{
    $id = $_GET['id'];
    //on  verifie que l'id est un entier
    [$id, $resultat]=filtre($id, "int", 5);
    if($resultat == false){
        //affichage de l'erreur et redirection vers la page d'accueil avec la page erreur.php en précisant qu'il y a une erreur
        header('Location: erreur.php?error=L\'id de l\'article n\'est pas valide&page=index');
    }
    $article = RechercheArticleById($id, $conn1);
    $article=$article[0];
    if($article){
        //vérfication de la quantité de l'article
        $quantite_disponible = QuantiteArticle($id, $conn1);
        if($_GET['quantite'] > $quantite_disponible){
            //affichage de l'erreur et redirection vers la page d'accueil avec la page erreur.php en précisant qu'il y a une erreur
            header('Location: erreur.php?error=La quantité demandée n\'est pas disponible&page=index');
        }
        //ajout de l'article dans le panier de l'utilisateur (array)
        //$panier = $_SESSION['panier'];
        //$panier[$id] = $article;
        //$panier[$id]['quantite'] = $_GET['quantite'];
        //$_SESSION['panier'] = $panier;
        //ajout de l'article dans le panier de l'utilisateur (stockage dans un cookie)
        $panier = isset($_COOKIE['panier']) ? json_decode($_COOKIE['panier'], true) : [];
        //$panier[$id] = $article;
        $panier[$id] = $_GET['quantite'];
        $panierJson = json_encode($panier);
        setcookie('panier', $panierJson, time() + (3 * 30 * 24 * 60 * 60), '/');
        //affichage du panier avec le message de confirmation avec la page succes.php
        header('Location: succes.php?success=Article ajouté au panier&page=index');
        exit();
    }
    else{
        //affichage de l'erreur et redirection vers la page d'accueil avec la page erreur.php en précisant que l'article n'existe pas
        header('Location: erreur.php?error=L\'article n\'existe pas&page=index');
        exit();
    }
}
include 'footer.php';
>>>>>>> 521457ac98f141eec458e34e9992cda7c61fff25
?>