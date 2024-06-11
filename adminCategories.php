<!-- Page qui permet de gérer les catégories -->
<?php
include('header.php');
include('checkAdmin.php');
//test si la page a été appelée en post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
else if(isset($_POST['id'])){
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
    //redirection vers la page d'ajout de catégorie avec un message d'erreur avec la page erreur.php
    header('Location: erreur.php?error=Erreur lors de l\'envoi du formulaire&page=adminCategories');
    exit();

}
}
//sinon affichage de la page
else{
?>
<!-- Affichage des catégories -->
<main>
    <p>Bienvenue <?php echo ($nom);?> sur RemEfficiAnt, le site de vente en ligne de Rémy et Antoine !</p>
    <h2>Gestion des catégories</h2>
    <h3>Ajouter une catégorie</h3>
    <form action="adminCategories.php" method="post">
        <p>
            <label for="nom">Nom de la catégorie :</label>
            <input type="text" name="nom" id="nom" placeholder="Nom de la nouvelle Catégorie" required>
        </p>
        <p>
            <input type="submit" value="Ajouter la catégorie">
        </p>
    </form>
    <h3>Supprimer une catégorie</h3>
    <form action="adminCategories.php" method="post">
        <p>
            <label for="nom">Nom de la catégorie :</label>
            <select name="id" id="nom">
                <?php
                $categories = ListeCategories($conn1);
                foreach($categories as $categorie){
                    echo "<option value='".$categorie['idcategorie']."'>".$categorie['nomcategorie']."</option>";
                }
                ?>
            </select>
        </p>
        <p>
            <input type="submit" value="Supprimer la catégorie">
        </p>
    </form>
</main>
<?php 
}
include('footer.php'); ?>