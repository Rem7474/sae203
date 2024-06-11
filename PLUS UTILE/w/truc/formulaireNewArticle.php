<!-- Formulaire accessible uniquement par les vendeurs pour ajouter un article à la vente -->
<?php
include('header.php');
// Vérifier si l'utilisateur est connecté
include('checklogin.php');
//on regarde si l'utilisateur est un vendeur ou un acheteur
include('checkvendeur.php');
//vérifie si un la page est appelée par un formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //affichage de la pge de validation du formulaire
    // Vérifier si toutes les données du formulaire ont été envoyées
if (!isset($_POST['nom']) || !isset($_POST['description']) || !isset($_POST['prix']) || !isset($_POST['categorie']) || !isset($_FILES['image']) || !isset($_POST['quantite'])) {
    //redirige vers la page d'ajout d'article en utilisant la page erreur.php
    header('Location: erreur.php?error=Erreur lors de l\'envoi du formulaire&page=formulaireNewArticle');
    exit();
}
// Récupérer les données du formulaire
$nom = $_POST['nom'];
$description = $_POST['description'];
$prix = $_POST['prix'];
$quantite = $_POST['quantite'];
$categorie = $_POST['categorie'];
$image = $_FILES['image'];
$idvendeur=$_SESSION['id'];
// Vérifier si les données sont vides
if (empty($nom) || empty($description) || empty($prix) || empty($categorie) || empty($image) || empty($quantite)) {
    //redirige vers la page d'ajout d'article en utilisant la page erreur.php
    header('Location: erreur.php?error=Veuillez remplir tous les champs&page=formulaireNewArticle');
    exit();
}
//vérification des données avec la fonction filtre
[$nom, $resultat]=filtre($nom, "string", 20);
if($resultat == false){
    //redirige vers la page d'ajout d'article en utilisant la page erreur.php
    header('Location: erreur.php?error=Le nom de l\'article est invalide&page=formulaireNewArticle');
    exit();
}
[$description, $resultat]=filtre($description, "string", 1000);
if($resultat == false){
    //redirige vers la page d'ajout d'article en utilisant la page erreur.php
    header('Location: erreur.php?error=La description de l\'article est invalide&page=formulaireNewArticle');
    exit();
}
[$prix, $resultat]=filtre($prix, "float",1000000);
if($resultat == false){
    //redirige vers la page d'ajout d'article en utilisant la page erreur.php
    header('Location: erreur.php?error=Le prix de l\'article est invalide&page=formulaireNewArticle');
    exit();
}
[$categorie, $resultat]=filtre($categorie, "int", 1000);
if($resultat == false){
    //redirige vers la page d'ajout d'article en utilisant la page erreur.php
    header('Location: erreur.php?error=La catégorie de l\'article est invalide&page=formulaireNewArticle');
    exit();
}
[$quantite, $resultat]=filtre($quantite, "int", 1000);
if($resultat == false){
    //redirige vers la page d'ajout d'article en utilisant la page erreur.php
    header('Location: erreur.php?error=La quantité de l\'article est invalide&page=formulaireNewArticle');
    exit();
}
//enregistrement de l'article dans la base de données avec la fonction AjouterArticle
$idarticle=NewArticle($nom,$prix,$quantite,$description,$categorie,$idvendeur,$conn1);
//enregistrer l'image dans le dossier images avec le nom correspondant à l'id de l'article
//$nomImage = $idarticle . "." . pathinfo($image['name'], PATHINFO_EXTENSION);
//move_uploaded_file($image['tmp_name'], "/var/www/RT/B13/upload/images/$nomImage");

//enregistrementde l'image avec la fonction TraitementImage
$erreur=TraitementImage($image, "/var/www/RT/B13/upload/images/", $idarticle);
$UrlRedirect="formulairemodifarticle.php?idproduit=$idarticle";
TraitementErreurImage($erreur, $UrlRedirect);

//redirection vers la page de l'article
header("Location: article.php?id=$idarticle");
exit();
}
else{
?>
<head>
    <title>Ajouter un article</title>
</head>
<body>
    <section class="user-info">
        <h1>Ajouter un article</h1>
        <form action="formulaireNewArticle.php" method="post" class="fade" enctype="multipart/form-data">
            <label for="nom">Nom de l'article :</label>
            <input type="text" name="nom" id="nom" required>
            <label for="description">Description :</label>
            <textarea name="description" id="description" cols="30" rows="10" required></textarea>
            <label for="prix">Prix :</label>
            <input type="number" name="prix" id="prix" min="0" step="0.01" required>
            <label for="quantite">Quantité :</label>
            <input type="number" name="quantite" id="quantite" min="0" step="1" required>
            <label for="categorie">Catégorie :</label>
            <select name="categorie" id="categorie" required>
                <option value="">Choisir une catégorie</option>
                <!-- Récupérer les catégories de la base de données -->
                <?php
                $categrories=ListeCategories($conn1);
                foreach($categrories as $categorie){
                    echo "<option value=".$categorie['idcategorie'].">".$categorie['nomcategorie']."</option>";
                }
                ?>
            </select>
            <label for="image">Image :</label>
            <input type="file" name="image" id="image" required>
            <input type="submit" value="Ajouter l'article">
        </form>
    </section>
</body>
<?php }
include('footer.php'); ?>