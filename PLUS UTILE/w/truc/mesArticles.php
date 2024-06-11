<!-- Page qui affiche les articles du vendeur -->
<?php
include('header.php');
//test si l'utilisateur est un vendeur
if(isset($_SESSION['role'])){
    $role = $_SESSION['role'];
}
else{
    $role = "";
}
//on regarde si l'utilisateur est un vendeur ou un acheteur
if ($role != "vendeur"){
    header("Location: index.php");
    exit();
}
//on récupère l'id du vendeur
$idvendeur=$_SESSION['id'];
//on récupère les articles du vendeur
$listeArticles=ListeArticlesByVendeur($idvendeur,$conn1);

//on affiche les articles du vendeur
echo "<div class='resultats fade'>";
AffichageArticle($listeArticles, 2, $conn1);
echo "</div>";

include('footer.php');
?>
