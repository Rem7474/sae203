<!-- Code pour vérifier si l'utilisateur est connecté -->
<?php
if (!isset($_SESSION['id'])) {
    //redirigé vers la page de connexion en utilisant la page erreur.php
    header('Location: erreur.php?error=Vous devez être connecté pour accéder à cette page&page=login');
    exit();
}
?>