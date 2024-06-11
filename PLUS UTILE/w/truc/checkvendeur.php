<!-- Code pour vérifier si l'utilisateur est un vendeur -->
<?php
if (isset($_SESSION['role'])) {
    if ($role != "vendeur"){
        //redirigé vers la page de connexion en utilisant la page erreur.php
        header('Location: erreur.php?error=Vous devez être un vendeur pour accéder à cette page&page=index');
        exit();
    }
}
?>