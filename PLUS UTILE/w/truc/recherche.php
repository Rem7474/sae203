<?php
session_start();
require_once 'fonctionsConnexion.php';
require_once 'fonctionsBDD.php';
require_once 'fonctionSys.php';
$conn1 = connexionBDD('parametres.ini');
//récupérer les données venant de formulaire s'il elles existent avec isset
if (isset($_POST["recherche"])) {
    [$recherche, $resultat] = filtre($_POST["recherche"], "str", 20);
  } else {
    $recherche = null;
  }
if ($resultat == false) {
    //redirige vers la page d'accueil avec un message d'erreur
    header('Location: erreur.php?error=La recherche n\'est pas correcte&page=index');
    exit();
}
if (isset($_POST["categorie"]) && !empty($_POST["categorie"])) {
    [$categorie, $resultat] = filtre($_POST["categorie"], "int", 5);
  } else {
    $categorie = null;
  }
if ($resultat == false) {
    //redirige vers la page d'accueil avec un message d'erreur
    header('Location: erreur.php?error=La catégorie n\'est pas correcte&page=index');
    exit();
}
if (isset($_POST["prix_min"])) {
    [$prix_min, $resultat] = filtre($_POST["prix_min"], "float", 5);
  } else {
    $prix_min = null;
  }
if ($resultat == false) {
    //redirige vers la page d'accueil avec un message d'erreur
    header('Location: erreur.php?error=Le prix minimum n\'est pas correcte&page=index');
    exit();
}
if (isset($_POST["prix_max"])) {
    [$prix_max, $resultat] = filtre($_POST["prix_max"], "float", 5);
  } else {
    $prix_max = null;
  }
if ($resultat == false) {
    //redirige vers la page d'accueil avec un message d'erreur
    header('Location: erreur.php?error=Le prix maximum n\'est pas correcte&page=index');
    exit();
}
//
  //récupération des articles correspondant à la recherche
    $resultats=RechercheArticle($categorie, $recherche, $prix_min, $prix_max, $conn1);
    // Affichage des résultats s'il y en a
    if($resultats){
      //Retourne les articles disponibles
        $resultats=ArticlesDisponible($resultats);
        //test si il ya un résultat avec une quantité d'articles supérieure à 0
        if(!empty($resultats)){
        AffichageArticle($resultats, 0, $conn1);
      }
      else{
        //affiche qu'aucun article n'a été trouvé
        echo "<p>Aucun article n'a été trouvé</p>";
      }
    }
    else{
        //affiche qu'aucun article n'a été trouvé
        echo "<p>Aucun article n'a été trouvé</p>";
    }
    ?>