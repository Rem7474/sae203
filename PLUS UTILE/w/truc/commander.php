<?php
session_start();
if (isset($_POST['panier'])) {
    $panier = $_POST['panier'];
}
require_once 'fonctionsConnexion.php';
require_once 'fonctionsBDD.php';
require_once 'fonctionSys.php';
$conn1 = connexionBDD('parametres.ini');
//include('checkacheteur.php');
$idacheteur = $_SESSION['id'];
$panierdecode = json_decode($panier, true);
$resultatCommande=Commande($idacheteur,$panierdecode,$conn1);
//suprimmer le cookie panier
setcookie('panier', '', time() - 3600, '/');
//test si le résultat est un tableau
if (is_array($resultatCommande)) {
    //si oui, on affiche les deux éléments du tableau, le premier est le numéro de commande, le deuxième est le message de confirmation
    //redirection vers confirmationCommande.php (ou mes commandes)
    echo "<p>Numéro de commande : ".$resultatCommande[0]."</p>";
    echo "<p>".$resultatCommande[1]."</p>";
} else {
    //sinon on affiche le résultat
    echo "<p>".$resultatCommande."</p>";
}
?>