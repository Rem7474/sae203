<!-- Affiche un article grace à son id dans le get -->
<?php
include('header.php');
if(isset($_SESSION['prenom'])){
        $nom = $_SESSION['prenom'];
}
else{
    $nom = "NON CONNECTE";
}
if(isset($_SESSION['id'])){
    $idvendeur = $_SESSION['id'];
}
else{
    $idvendeur = "";
}
//on regarde si l'utilisateur est un vendeur ou un acheteur
if(isset($_SESSION['role'])){
    $role = $_SESSION['role'];
}
else{
    $role = "";
}
//vérification si l'id est passer dans le get et si il existe dans la bdd
if(!isset($_GET['id'])){
    //redirection vers la page d'accueil en utilisant la page erreur.php en affichant que l'id n'a pas été précisé
    header('Location: erreur.php?error=L\'id de l\'article n\'a pas été précisé&page=index');
    exit();
}
$id = $_GET['id'];
//filtrage de l'id pour éviter les injections sql avec la fonction filtre
[$id, $resultat]=filtre($id, "int", 5);
    if($resultat == false){
        //redirection vers la page d'accueil en utilisant la page erreur.php en affichant que l'id n'est pas valide
        header('Location: erreur.php?error=L\'id de l\'article n\'est pas valide&page=index');
        exit();
    }
$article = RechercheArticleById($id, $conn1);
$article=$article[0];
if($article){
    $nomarticle = $article['nomarticle'];
    $descriptionarticle = $article['descriptionarticle'];
    $prixarticle = $article['prixarticle'];
    $quantitearticle = $article['quantitearticle'];
    $refcategorie = $article['refcategorie'];
    $imagearticle = $article['idarticle'];
    //récupération du nom de la catégorie
    $categorie = RechercheCategorieById($refcategorie, $conn1);
    $categorie = $categorie[0];
    $nomcategorie = $categorie['nomcategorie'];
    if ($role == "acheteur"){
        //Ajoute a la variable le code html qui contient les quantités disponibles de l'article a partir de la quantité de l'article dans la bdd
        //l'affiche sous la forme d'un formulaire avec un bouton submit, en selectionnant la quantité de l'article que l'on veut avec option
        $quantite_disponible = QuantiteArticle($id, $conn1);
        //on stocke dans une variable le code html du formulaire, qui retourne l'id et la quantité de l'article
        $formulaire_ajout_panier='<form action="AjoutPanier.php" method="GET">
        <label for="quantite">Quantité : </label>
        <select name="quantite" id="quantite">';
        //on boucle sur la quantité disponible de l'article pour afficher les options
        if ($quantite_disponible<100){
        for($i=1; $i<=$quantite_disponible; $i++){
            $formulaire_ajout_panier.='<option value="'.$i.'">'.$i.'</option>';
        }
        }
        else{
            for($i=1; $i<=100; $i++){
                $formulaire_ajout_panier.='<option value="'.$i.'">'.$i.'</option>';
            }
        }
        $formulaire_ajout_panier.='</select>
        <input type="hidden" name="id" value="'.$id.'">
        <input type="submit" value="Ajouter au panier">
        </form>';  
        }
    else{
        //sinon affichage pour dire à l'utilisateur qu'il doit être connecté en tant qu'acheteur pour ajouter au panier, et d'un bouton pour se connecter (de type submit)
        $formulaire_ajout_panier = "<form action='login.php' method='GET'>
        <p>Vous devez être connecté en tant qu'acheteur pour ajouter au panier</p>
        <input type='submit' value='Se connecter'>";
    }
    //test si l'utilisateur est le vendeur de l'article
    if($idvendeur == $article['refvendeur']){
        //si oui, affichage d'un bouton pour modifier l'article et d'un bouton pour supprimer l'article
        $bouton_modifier = '<a class="button" id="change" href="formulairemodifarticle.php?idproduit='.$id.'"><i class="bi bi-pencil-square"></i></a>';
        $bouton_supprimer = '<a class="button" id="delete" href="traitementSupprimerArticle.php?idarticle='.$id.'"><i class="bi bi-trash3-fill"></i></a>';
        $formulaire_ajout_panier .=$bouton_modifier.$bouton_supprimer."</form>";
    }
    else{
        //sinon aucun bouton
        $bouton_modifier = "";
        $bouton_supprimer = "";
        $formulaire_ajout_panier .="</form>";
    }
}
    else{
        //redirection vers la page d'accueil en utilisant la page erreur.php en affichant que l'article n'existe pas
        header('Location: erreur.php?error=L\'article n\'existe pas&page=index');
        exit();
    }
?>
<!-- Affichage de l'article -->
<main>
    <p>Bienvenue <?php echo ($nom);?> sur RemEfficiAnt, le site de vente en ligne de Rémy et Antoine !</p>
    <div class="page_article">
    <h2><?php echo $nomarticle;?></h2>
    <div class="article_vendeur">
    <div class='article_seul'>
        <div class="partie_article_haut">
        <div class="image_article_seul">
        <img src='upload/images/<?php echo $imagearticle;?>' alt='image article'>
        </div>
        <div class='description_article_seul'>
            <p>Prix : <b><?php echo $prixarticle;?>€</b></p>
            <p>Quantité disponible : <?php echo $quantitearticle;?></p>
            <p>Catégorie : <?php echo $nomcategorie;?></p>
        </div>
        <div class="colonnes etroit">
        <?php echo $formulaire_ajout_panier?>
        </div>
        </div>
        <div class="description">
        <h3>Descriptif : </h3>
            <p><?php echo $descriptionarticle;?></p>
        </div>
        </div>
    <!-- Affiche les informations du vendeur -->
    <div class="vendeur">
        <h3>Vendeur : </h3>
        <?php
        $vendeur = RechercheVendeurById($article['refvendeur'], $conn1);
        $nomvendeur = $vendeur['nomutilisateur'];
        $prenomvendeur = $vendeur['prenom'];
        $mailvendeur = $vendeur['email'];
        $telephonevendeur = $vendeur['telephone'];
        echo "<img class='profil_vendeur' src='upload/images/vendeurs/".$article['refvendeur']."' alt='image vendeur'>";
        echo "<p class='page_vendeur'><a href=vendeur.php?id=".$article['refvendeur'].">".$prenomvendeur." ".$nomvendeur."</a></p>";
        echo "<p class='mail'>Mail : <a href=mailto:".$mailvendeur.">".$mailvendeur."</a></p>";
        echo "<p class='tel'>Téléphone : <a href=tel:+33".$telephonevendeur.">0".$telephonevendeur."</a></p>";
        ?>
    </div>
    </div>
    </div>
</main>
<?php include('footer.php'); ?>

