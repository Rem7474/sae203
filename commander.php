<?php
session_start();
if (isset($_POST['panier'])) {
    $panier = $_POST['panier'];
}
require_once 'fonctionsConnexion.php';
require_once 'fonctionsBDD.php';
require_once 'fonctionSys.php';
$conn1 = connexionBDD('./private/parametres.ini');
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
    $mail=$_SESSION['email'];
    $subject="RemEfficiAnt : Confirmation de commande";
    $message="Bonjour, votre commande a bien été prise en compte. Votre numéro de commande est le ".$resultatCommande[0].". Vous pouvez consulter le détail de votre commande dans la rubrique \"Mes commandes\" de votre espace personnel. Merci de votre confiance.";
    sendMail($mail,$subject,$message);
    echo "<p>Numéro de commande : ".$resultatCommande[0]."</p>";
    echo "<p>".$resultatCommande[1]."</p>";
} else {
    //sinon on affiche le résultat
    echo "<p>".$resultatCommande."</p>";
}
?>