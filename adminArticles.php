<!-- permet d'afficher la liste des articles -->
<?php
include('header.php');
include('checkAdmin.php');
//récupération de la liste des articles dans une array
$articles = ListeArticles($conn1);
//Affichage de la liste des articles
echo "<h2>Liste des articles</h2>";
echo "<table>";
echo "<tr><th>Image</th><th>Nom</th><th>Description</th><th>Prix</th><th>Quantité</th><th>Catégorie</th><th>Vendeur</th><th>Actions</th></tr>";
foreach ($articles as $article) {
    echo "<tr>";
    echo "<td><img src='upload/images/".$article['idarticle']."' alt='image article' class='image_article'></td>";
    echo "<td>".$article['nomarticle']."</td>";
    echo "<td>".$article['descriptionarticle']."</td>";
    echo "<td>".$article['prixarticle']."</td>";
    echo "<td>".$article['quantitearticle']."</td>";
    //récupération de la catégorie de l'article
    $categorie = RechercheCategorieById($article['refcategorie'], $conn1);
    $categorie = $categorie[0];
    $nomcategorie = $categorie['nomcategorie'];
    echo "<td>".$nomcategorie."</td>";
    //récupération du vendeur de l'article
    $vendeur = RechercheVendeurById($article['refvendeur'], $conn1);
    $nomvendeur = $vendeur['nomutilisateur'];
    echo "<td>".$nomvendeur."</td>";
    echo "<td><a href='formulairemodifarticle.php?idproduit=".$article['idarticle']."'>Modifier</a> <a href='traitementSupprimerArticle.php?idarticle=".$article['idarticle']."'>Supprimer</a></td>";
    echo "</tr>";
}
echo "</table>";
include('footer.php');
?>