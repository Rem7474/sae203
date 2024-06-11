<!-- Page pour afficher un succès en prenant en parametre d'entrée la description du succès et la page sur laquel redirigé l'utilisateur !-->
<?php
include('header.php');
//verification de la présence des paramètres d'entrée
if (isset($_GET['success']) && isset($_GET['page'])) {
    $description = $_GET['success'];
    $page = $_GET['page'];
    echo "<div class='success'>";
    echo "<main>";
    echo "<p>$description</p>";
    echo "<p>Vous allez être redirigé dans 3 secondes...</p>";
    echo "</main>";
    echo "<script>";
    echo "setTimeout(function(){window.location.href='$page.php';},3000);";
    echo "</script>";
    echo "</div>";
} else {
    //redirection vers la page d'accueil en utilisant la page erreur.php
    header('Location: erreur.php?error=Une erreur est survenue&page=index');
    exit();
}