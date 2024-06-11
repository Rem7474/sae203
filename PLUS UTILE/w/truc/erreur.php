<!-- Page pour afficher une erreur en prenant en parametre d'entrée la description du problème et la page sur laquel redirigé l'utilisateur !-->
<?php
include('header.php');
//verification de la présence des paramètres d'entrée
if (isset($_GET['error']) && isset($_GET['page'])) {
    $description = $_GET['error'];
    $page = $_GET['page'];
    echo "<div class='error'>";
    echo "<main>";
    echo "<p>Une erreur est survenue : $description</p>";
    echo "<p>Vous allez être redirigé dans 3 secondes...</p>";
    echo "</main>";
    echo "<script>";
    echo "setTimeout(function(){window.location.href='$page.php';},3000);";
    echo "</script>";
    echo "</div>";
} else {
    echo "<div class='error'>";
    echo "<main>";
    echo "<p>Une erreur est survenue</p>";
    echo "<p>Vous allez être redirigé vers la page d'accueil</p>";
    echo "</main>";
    echo "<script>";
    echo "setTimeout(function(){window.location.href='index.php';},3000);";
    echo "</script>";
    echo "</div>";
}
include('footer.php');
?>