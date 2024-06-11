<!-- Code pour vérifier si l'utilisateur est un acheteur -->
<?php
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    if ($role != "acheteur" && $id != 1){
        //redirigé vers la page de connexion en utilisant la page erreur.php
        header('Location: erreur.php?error=Vous devez être un acheteur pour accéder à cette page&page=index');
        exit();
    }
}
else{
    //redirigé vers la page de connexion en utilisant la page erreur.php
    header('Location: erreur.php?error=Vous devez être connecté pour accéder à cette page&page=index');
    exit();
}
?>