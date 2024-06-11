<?php 
include('header.php'); 
?>
    <main>
        <h2>Mon panier</h2>
        <?php 
        //récupération du panier stocké dans un cookie

        if (isset($_COOKIE['panier'])) {
            // Récupérer la chaîne JSON du cookie
            $panier = isset($_COOKIE['panier']) ? json_decode($_COOKIE['panier'], true) : [];
            //récupère l'id d
            // Utiliser le panier restauré
            foreach ($panier as $articleId => $quantite) {
                $article = RechercheArticleById($articleId, $conn1);
                $article=$article[0];

                $nomarticle = $article['nomarticle'];
                $descriptionarticle = $article['descriptionarticle'];
                $prixarticle = $article['prixarticle'];
                $quantitepanier = $quantite;
                $refcategorie = $article['refcategorie'];
                $imagearticle = $article['idarticle'];
                //récupération du nom de la catégorie
                $categorie = RechercheCategorieById($refcategorie, $conn1);
                $categorie = $categorie[0];
                $nomcategorie = $categorie['nomcategorie'];
  
        ?>
        <div class="panier">
        <div class='article_panier'>
            <a href='article.php?id=<?php echo $articleId;?>' class='lien_article_panier'>
                <h2><?php echo $nomarticle;?></h2>
                <div class='info_article_panier'>
                    <div class='image_article_seul'>
                    <img src='upload/images/<?php echo $imagearticle;?>' alt='image article'>
                    </div>
                    <div class='description_article_panier'>
                        <p>Prix : <b><?php echo $prixarticle;?>€</b></p>
                        <p>Quantité achetée : <?php echo $quantitepanier;?></p>
                        <p>Catégorie : <?php echo $nomcategorie;?></p>
                        <h3>Descriptif : </h3>
                        <p><?php echo $descriptionarticle;?></p>
                    </div>
                </div>
            </a>
        </div>
    <?php
            }
            $jsonpanier = json_encode($panier);
            echo'<form id="commander">';
            echo'<input type="hidden" name="panier" id="panier" value='.$jsonpanier.'>';
            echo'<button type="submit">Valider la commande</button>';
            echo'</form>';
            ?>
            </div>
            <?php
        }
        else {
            echo "<p>Le panier est vide.</p>";
        }
    ?>
    <div id="resultats">
    </div>
    </main>
<?php include('footer.php'); ?>