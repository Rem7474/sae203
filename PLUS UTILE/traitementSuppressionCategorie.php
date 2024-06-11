<!-- Traitement de la suppression d'une catégorie en base de données a partir de son id -->
<?php
include('header.php');
include('checkAdmin.php');

//vérfication de la présence de l'id
if(isset($_POST['id'])){
    $id = $_POST['id'];
    //vérification que la catégorie existe
    //récupération de la liste des catégories dans une array
    $categorie = ListeCategories($conn1);
    //vérification que l'id existe
    $idExiste = false;
    foreach($categorie as $cat){
        if($cat['idcategorie'] == $id){
            $idExiste = true;
        }
    }
    if($idExiste){
        //suppression de la catégorie et récupération du résultat
        $resultat = SupprimerCatégorie($id ,$conn1);
        if (!$resultat) {
            //redirection vers la page de catégories en utilisant la page erreur.php en affichant que la catégorie n'a pas pu être supprimée
            header('Location: erreur.php?error=La catégorie n\'a pas pu être supprimée car elle est utilisée&page=adminCategories');
            exit();
        }
        //redirection vers la page de catégories en utilisant la page succes.php en affichant que la catégorie a bien été supprimée
        header('Location: succes.php?success=La catégorie a bien été supprimée&page=adminCategories');
        exit();
    }
    else{
        //redirection vers la page de catégories en utilisant la page erreur.php en affichant que la catégorie n'existe pas
        header('Location: erreur.php?error=La catégorie n\'existe pas&page=adminCategories');
        exit();
    }
}
else{
    //redirection vers la page de catégories en utilisant la page erreur.php en affichant que la catégorie n'a pas été précisée
    header('Location: erreur.php?error=L\'id de la catégorie n\'a pas été précisé&page=adminCategories');
    exit();
}