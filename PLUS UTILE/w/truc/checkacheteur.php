<!-- Code pour vérifier si l'utilisateur est un acheteur -->
<?php
if (isset($_SESSION['role'])) {
    if ($role != "acheteur"){
        //redirigé vers la page de connexion en utilisant la page erreur.php
        header('Location: erreur.php?error=Vous devez être un acheteur pour accéder à cette page&page=index');
        exit();
    }
}
?>