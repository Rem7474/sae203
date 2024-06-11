<<<<<<< HEAD
<?php
    //test si l'utilisateur est connecté
if(isset($_SESSION['id'])){
        //test si l'id de l'utilisateur connecté est 1 (administrateur)
        if($_SESSION['id'] == 1){
            $nom = $_SESSION['prenom'];
        }
        else{
            //redirigé vers la page de connexion en utilisant la page erreur.php
            header('Location: erreur.php?error=Vous devez être un administrateur pour accéder à cette page&page=index');
            exit();
        }
    }
    else{
        //redirigé vers la page de connexion en utilisant la page erreur.php
        header('Location: erreur.php?error=Vous devez être connecté pour accéder à cette page&page=login');
        exit();
    }
=======
<?php
    //test si l'utilisateur est connecté
if(isset($_SESSION['id'])){
        //test si l'id de l'utilisateur connecté est 1 (administrateur)
        if($_SESSION['id'] == 1){
            $nom = $_SESSION['prenom'];
        }
        else{
            //redirigé vers la page de connexion en utilisant la page erreur.php
            header('Location: erreur.php?error=Vous devez être un administrateur pour accéder à cette page&page=index');
            exit();
        }
    }
    else{
        //redirigé vers la page de connexion en utilisant la page erreur.php
        header('Location: erreur.php?error=Vous devez être connecté pour accéder à cette page&page=login');
        exit();
    }
>>>>>>> 521457ac98f141eec458e34e9992cda7c61fff25
?>