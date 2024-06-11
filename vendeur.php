<<<<<<< HEAD
<!-- Page de visualisation des articles d'un vendeur -->
<?php
include('header.php');
//vérification que l'id du vendeur est bien passé en paramètre
if(!isset($_GET['id']) || empty($_GET['id'])){
    //utilise la page d'erreur
    header("Location: erreur.php?error=vous n'avez pas selectionné de vendeur&page=index");
    exit();
}
echo "<script src='js/map2.js'></script>";
//récupération de l'id du vendeur
$idvendeur=$_GET['id'];
//récupération des informations du vendeur
$vendeur = RechercheVendeurById($idvendeur, $conn1);
echo '<script>var adresse="' . $vendeur['adresse'] .' '.  $vendeur['codepostal'] .' '.  $vendeur['ville'] . '";</script>';
echo '<script>console.log(adresse);</script>';
//récupération des articles du vendeur
$listeArticles=ListeArticlesByVendeur($idvendeur,$conn1);
//affichage des articles du vendeur
//affichage du nom et prénom du vendeur
echo "<h1>Articles de : ".$vendeur['prenom']." ".$vendeur['nomutilisateur']."</h1>";
//afichage des informations du vendeur
echo "<div class='vendeur' id='vendeur'>";
echo "<div class='vendeurInfo'>";
//affichage de l'image du vendeur
echo "<div class='vendeurImage'>";
echo "<img src='./upload/images/vendeurs/".$idvendeur."' alt='image du vendeur' class='photo_vendeur'>";
echo "</div>";
echo "<div class='vendeurcontact'>";
echo "<p>".$vendeur['prenom']." ".$vendeur['nomutilisateur']."</p>";
echo "<p><a href='https://www.google.com/maps/search/?api=1&query=".$vendeur['adresse']." ".$vendeur['codepostal']." ".$vendeur['ville']."' target='_blank'>".$vendeur['adresse'].", ".$vendeur['codepostal']." ".$vendeur['ville']."</a></p>";
echo "<p><a href='mailto:".$vendeur['email']."'>".$vendeur['email']."</a></p>";
echo "<p><a href='tel:+33".$vendeur['telephone']."'>+33".$vendeur['telephone']."</a></p>";
echo "</div>";
echo "</div>";
echo "<div id='map'></div>";
echo "<button id='btnItineraire'><i class='bi bi-sign-turn-right-fill'></i></button>";
echo "</div>";
echo "<div class='resultats'>";
AffichageArticle($listeArticles, 0, $conn1);
echo "</div>";
include('footer.php');
?>
=======
<!-- Page de visualisation des articles d'un vendeur -->
<?php
include('header.php');
//vérification que l'id du vendeur est bien passé en paramètre
if(!isset($_GET['id']) || empty($_GET['id'])){
    //utilise la page d'erreur
    header("Location: erreur.php?error=vous n'avez pas selectionné de vendeur&page=index");
    exit();
}
echo "<script src='js/map2.js'></script>";
//récupération de l'id du vendeur
$idvendeur=$_GET['id'];
//récupération des informations du vendeur
$vendeur = RechercheVendeurById($idvendeur, $conn1);
echo '<script>var adresse="' . $vendeur['adresse'] .' '.  $vendeur['codepostal'] .' '.  $vendeur['ville'] . '";</script>';
echo '<script>console.log(adresse);</script>';
//récupération des articles du vendeur
$listeArticles=ListeArticlesByVendeur($idvendeur,$conn1);
//affichage des articles du vendeur
//affichage du nom et prénom du vendeur
echo "<h1>Articles de : ".$vendeur['prenom']." ".$vendeur['nomutilisateur']."</h1>";
//afichage des informations du vendeur
echo "<div class='vendeur' id='vendeur'>";
echo "<div class='vendeurInfo'>";
//affichage de l'image du vendeur
echo "<div class='vendeurImage'>";
echo "<img src='./upload/images/vendeurs/".$idvendeur."' alt='image du vendeur' class='photo_vendeur'>";
echo "</div>";
echo "<div class='vendeurcontact'>";
echo "<p>".$vendeur['prenom']." ".$vendeur['nomutilisateur']."</p>";
echo "<p><a href='https://www.google.com/maps/search/?api=1&query=".$vendeur['adresse']." ".$vendeur['codepostal']." ".$vendeur['ville']."' target='_blank'>".$vendeur['adresse'].", ".$vendeur['codepostal']." ".$vendeur['ville']."</a></p>";
echo "<p><a href='mailto:".$vendeur['email']."'>".$vendeur['email']."</a></p>";
echo "<p><a href='tel:+33".$vendeur['telephone']."'>+33".$vendeur['telephone']."</a></p>";
echo "</div>";
echo "</div>";
echo "<div id='map'></div>";
echo "<button id='btnItineraire'><i class='bi bi-sign-turn-right-fill'></i></button>";
echo "</div>";
echo "<div class='resultats'>";
AffichageArticle($listeArticles, 0, $conn1);
echo "</div>";
include('footer.php');
?>
>>>>>>> 521457ac98f141eec458e34e9992cda7c61fff25
