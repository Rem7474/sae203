<!-- Pages pour afficher les articles vendus par un vendeur -->
<?php
include('header.php');
include("checklogin.php");
include("checkvendeur.php");
//réupération de l'id du vendeur
$idvendeur = $_SESSION['id'];
//récupération des articles vendus par le vendeur
$listeArticles = ListeArticlesVendus($idvendeur, $conn1);
?>
<main>
    <h2>Mes articles vendus</h2>
    <?php
    //affichage des articles vendus par le vendeur
    echo "<div class='resultats fade'>";
AffichageArticle($listeArticles, 3, $conn1);
echo "</div>";
    ?>
</main>
<?php include('footer.php'); ?>