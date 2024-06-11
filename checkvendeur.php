<<<<<<< HEAD
<!-- Code pour vérifier si l'utilisateur est un vendeur -->
<?php
if (isset($_SESSION['role'])) {
    if ($role != "vendeur"){
        //redirigé vers la page de connexion en utilisant la page erreur.php
        header('Location: erreur.php?error=Vous devez être un vendeur pour accéder à cette page&page=index');
        exit();
    }
}
else{
    //redirigé vers la page de connexion en utilisant la page erreur.php
    header('Location: erreur.php?error=Vous devez être connecté pour accéder à cette page&page=index');
    exit();
}
=======
<!-- Code pour vérifier si l'utilisateur est un vendeur -->
<?php
if (isset($_SESSION['role'])) {
    if ($role != "vendeur"){
        //redirigé vers la page de connexion en utilisant la page erreur.php
        header('Location: erreur.php?error=Vous devez être un vendeur pour accéder à cette page&page=index');
        exit();
    }
}
else{
    //redirigé vers la page de connexion en utilisant la page erreur.php
    header('Location: erreur.php?error=Vous devez être connecté pour accéder à cette page&page=index');
    exit();
}
>>>>>>> 521457ac98f141eec458e34e9992cda7c61fff25
?>