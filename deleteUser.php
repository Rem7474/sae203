<?php
//page pour supprimer un utilisateur
include('header.php');
//on verifie que l'utilisateur connecté est celui qui veut supprimer son compte
include('checklogin.php');
//on recupere l'id de l'utilisateur connecté
$idUtilisateur = $_SESSION['id'];
//on recupere l'id de l'utilisateur à supprimer
$idUtilisateurASupprimer = $_GET['id'];
//on passe l'id dans le filte
[$id,$resultat]=filtre($idUtilisateurASupprimer, "int", 5);
if ($resultat==false){
    header('Location: erreur.php?error=La commande n\'existe pas&page=mescommandes');
    exit();
}
//on verifie que l'utilisateur connecté est bien celui qui veut supprimer son compte
if (($idUtilisateur == $idUtilisateurASupprimer) || ($idUtilisateur==1)){
    supprimerUtilisateur($idUtilisateurASupprimer, $conn1);
    if ($idUtilisateur==1){
        header('Location: succes.php?success=Le compte a bien été supprimé&page=adminUtilisateurs');
        exit();
    }
    else{
        header('Location: succes.php?success=Votre compte a bien été supprimé&page=logout');
        exit();
    }
}
else{
    header('Location: erreur.php?error=Vous n\'avez pas le droit de supprimer ce compte&page=mescommandes');
    exit();
}
include('footer.php');
?>