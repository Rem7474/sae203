<?php
//page pour supprimer une commande
include('header.php');
include('checkAdmin.php');
//on récupère l'id de la commande
$idcommande=$_GET['idcommande'];
//on supprime la commande
supprimerCommande($idcommande, $conn1);
//on redirige vers la page adminCommandes.php
header('Location: adminCommandes.php');
include('footer.php');
?>