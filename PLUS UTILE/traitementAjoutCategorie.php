<!-- Permet d'ajouter une catégorie à la bdd -->
<?php
include('header.php');
include('checkAdmin.php');
require_once 'fonctionsConnexion.php';
require_once 'fonctionsBDD.php';
require_once 'fonctionSys.php';
$conn1 = connexionBDD('parametres.ini');
// vérification de la présence des variables
if(isset($_POST['nom'])){
    $nom = $_POST['nom'];
    //vérification que la catégorie n'existe pas déjà
    $categorie = RechercheCategorieByNom($nom, $conn1);
    if($categorie){
        //si la catégorie existe déjà redirection vers la page d'ajout de catégorie avec un message d'erreur avec la page erreur.php
        header('Location: erreur.php?error=La catégorie existe déjà&page=adminCategories');
        exit();
    }
    else{
        //ajout de la catégorie
        NewCategorie($nom, $conn1);
        //redirection vers la page d'ajout de catégorie avec un message de succès avec la page succes.php
        header('Location: succes.php?success=La catégorie a bien été ajoutée&page=adminCategories');
        exit();
    }
}
else{
    //redirection vers la page d'ajout de catégorie avec un message d'erreur avec la page erreur.php
    header('Location: erreur.php?error=Erreur lors de l\'envoi du formulaire&page=adminCategories');
    exit();
}
