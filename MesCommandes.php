<!-- Page qui affiche les commandes de l'acheteur -->
<?php
include('header.php');
//test si l'utilisateur est un acheteur
include('checklogin.php');
include('checkacheteur.php');
//on récupère l'id de l'acheteur
$idacheteur=$_SESSION['id'];
//on récupère les commandes de l'acheteur
if (($_SERVER['REQUEST_METHOD'] === 'GET') and (!empty($_GET['id']))) {
//on récupère l'id de la commande
$idcommande=$_GET['id'];
[$idcommande,$resultat]=filtre($idcommande, "int", 5);
if ($resultat==false){
    header('Location: erreur.php?error=La commande n\'existe pas&page=mescommandes');
    exit();
}
//on vérifie que l'id de la commande correspond bien à l'acheteur
if (checkCommande($idcommande, $idacheteur, $conn1)==false && $idacheteur!=1){
    header('Location: MesCommandes.php');
}
//on récupère les articles de la commande
$listeArticles=listeArticlesCommande($idcommande, $conn1);
//on affiche les articles de la commande
echo "<div class='resultats'>";
//print_r($listeArticles);
AffichageArticle($listeArticles,4, $conn1);
//$articles=AffichageArticles($listeArticles, 2, $conn1);
echo "<a class='button' id='change' href='MesCommandes.php'>Retour</a>";
echo "</div>";

}
else{
$listeCommandes=ListeCommandesByAcheteur($idacheteur,$conn1);
//on affiche les commandes de l'acheteur
echo "<div class='resultats'>";
//$commandes=AffichageCommandes($listeCommandes, 2, $conn1);

AffichageCommande($listeCommandes,0, $conn1);
echo "</div>";
}
include('footer.php');
?>

