<!-- Page pour faire une commande a partir du panier -->
<?php
include 'header.php';
?>
<main>
    <h2>Commande</h2>
    <?php
    //récupération du panier stocké dans un cookie
    if (isset($_COOKIE['panier'])) {
        // Récupérer la chaîne JSON du cookie
        $panier = isset($_COOKIE['panier']) ? json_decode($_COOKIE['panier'], true) : [];
        //vérification que le cookie n'a pas été modifié
        if (md5($_COOKIE['panier']) == $_SESSION['panier_hash']) {
            // Utiliser le panier restauré
            foreach ($panier as $articleId => $article) {
                //stockage des id des articles et des quantité dans une array
                $idarticle = $article['idarticle'];
                $quantitepanier = $article['quantite'];
                $idarticlepanier[] = $idarticle;
                $quantitepanierarticle[] = $quantitepanier;

            }
        } else {
            echo "Le panier a été modifié.";
        }
    } else {
        echo "Le panier est vide.";
    }