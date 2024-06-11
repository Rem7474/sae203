<!-- Page de formulaire et de traitement de la modification d'un produit -->
<?php
include 'header.php';
include 'checklogin.php';
//on regarde si la page a été appelée avec en post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idproduit = $_POST['idproduit'];
    //récupération des informations du formulaire
    if (!isset($_POST['nom']) && !isset($_POST['description']) && !isset($_POST['prix']) && !isset($_POST['quantite']) && !isset($_POST['categorie']) && !isset($_FILES['image'])) {
        //si aucune information n'est rentrée, on redirige vers la page de modification en affichant qu'il n'y a eu aucune modification
        header('Location: erreur.php?error=Vous n\'avez pas modifié vos informations&page=formulairemodifarticle?idproduit='.$_idproduit);
        exit();
    }
    //récupération des informations du produit
    $article = RechercheArticleById($idproduit, $conn1);
    $article = $article[0];
    if (!empty($_POST['nom'])) {
        $nom = $_POST['nom'];
    } else {
        $nom = $article['nomarticle'];
    }
    if (!empty($_POST['description'])) {
        $description = $_POST['description'];
    } else {
        $description = $article['descriptionarticle'];
    }
    if (!empty($_POST['prix'])) {
        $prix = $_POST['prix'];
    } else {
        $prix = $article['prixarticle'];
    }
    if (!empty($_POST['quantite'])) {
        $stock = $_POST['quantite'];
    } else {
        $stock = $article['quantitearticle'];
    }
    if (!empty($_POST['categorie'])) {
        $categorie = $_POST['categorie'];
    } else {
        $categorie = $article['refcategorie'];
    }
    //traitement de l'image si elle a été modifiée
    if (isset($_FILES['image'])) {
        $photo = $_FILES['image'];
        if ($photo['error']!=4){
            //traitement de l'image par la fonction TraitementImage
        $erreur = TraitementImage($photo, "/var/www/RT/B13/upload/images/", $idproduit);
        $UrlRedirect="formulairemodifarticle.php?idproduit=$idarticle";
        TraitementErreurImage($erreur, $UrlRedirect);
    }
    }
    //modification des informations du produit
    $modif = ModifArticle($idproduit, $nom, $prix, $stock, $description, $categorie, $conn1);
    if ($modif) {
        header('Location: succes.php?success=Votre produit a bien été modifié&page=index');
        exit();
    } else {
        header('Location: erreur.php?error=Votre produit n\'a pas pu être modifié&page=index');
        exit();
    }
}
//on regarde si la page à été appelée avec un id en get
elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idproduit'])) {
    $idproduit = $_GET['idproduit'];
    //on récupère les informations du produit
    $article = RechercheArticleById($idproduit, $conn1);
    $article=$article[0];
    if($article){
    $nom = $article['nomarticle'];
    $description = $article['descriptionarticle'];
    $prix = $article['prixarticle'];
    $stock = $article['quantitearticle'];
    $categorie = $article['refcategorie'];
    $image = $article['idarticle'];
    $vendeur = $article['refvendeur'];
    //on vérifie que le produit appartient bien au vendeur
    if ($vendeur != $_SESSION['id'] && $_SESSION['id'] != 1) {
        header('Location: erreur.php?error=Vous ne pouvez pas modifier ce produit&page=index');
        exit();
    }
    //récupération de la catégorie
    $idcategorie=$categorie;
    $categorie = RechercheCategorieById($categorie, $conn1);
    $categorie = $categorie[0];
    $nomcategorie = $categorie['nomcategorie'];
    //formulaire de modification
    ?>
<body>
    <section class="user-info">
        <h1>Modifier un article</h1>
        <form action="formulairemodifarticle.php" method="post" enctype="multipart/form-data">
            <label for="nom">Nom de l'article :</label>
            <input type="text" name="nom" id="nom" placeholder="<?php echo $nom ?>">
            <label for="description">Description :</label>
            <textarea name="description" id="description" cols="30" rows="10" placeholder="<?php echo $description ?>"></textarea>
            <label for="prix">Prix :</label>
            <input type="number" name="prix" id="prix" min="0" step="0.01" placeholder="<?php echo $prix ?>">
            <label for="quantite">Quantité :</label>
            <input type="number" name="quantite" id="quantite" min="0" step="1" placeholder="<?php echo $stock ?>">
            <label for="categorie">Catégorie :</label>
            <select name="categorie" id="categorie">
                <option value="<?php echo $idcategorie ?>"><?php echo $nomcategorie ?></option>
                <!-- Récupérer les catégories de la base de données -->
                <?php
                $categrories=ListeCategories($conn1);
                foreach($categrories as $categorie){
                    echo "<option value=".$categorie['idcategorie'].">".$categorie['nomcategorie']."</option>";
                }
                ?>
            </select>
            <label for="image">Image :</label>
            <input type="file" name="image" id="image">
            <!-- Rajout de l'id du produit pour le traitement -->
            <input type="hidden" name="idproduit" value="<?php echo $idproduit ?>">
            <input type="submit" value="Modifier l'article">
        </form>
    </section>
</body>

<?php
    }
    else{
        header('Location: erreur.php?error=Le produit n\'existe pas&page=index');
        exit();
    }

} else {
    //la page n'a pas été appelée correctement
    header('Location: erreur.php?error=La page n\'a pas été appelée correctement&page=index');
    exit();
}
include 'footer.php';
?>