<<<<<<< HEAD
<?php
//page qui permet à l'administrateur de gérer les commandes
include('header.php');
include('checkAdmin.php');
?>
<main>
    <h2>Gestion des commandes</h2>
    <p><a href="admin.php">Retour à la page d'administration</a></p>
    <h3>Commandes en cours</h3>
    <?php
    //récupération des commandes en cours
    $commandesEnCours = ListeCommandes($conn1);
    //affichage des commandes en cours
    AffichageCommande($commandesEnCours,1, $conn1);
=======
<?php
//page qui permet à l'administrateur de gérer les commandes
include('header.php');
include('checkAdmin.php');
?>
<main>
    <h2>Gestion des commandes</h2>
    <p><a href="admin.php">Retour à la page d'administration</a></p>
    <h3>Commandes en cours</h3>
    <?php
    //récupération des commandes en cours
    $commandesEnCours = ListeCommandes($conn1);
    //affichage des commandes en cours
    AffichageCommande($commandesEnCours,1, $conn1);
>>>>>>> 521457ac98f141eec458e34e9992cda7c61fff25
    ?>