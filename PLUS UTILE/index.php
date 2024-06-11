<?php 
include('header.php'); 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
?>
    <main>
    <p>Bienvenue <?php echo ($nom);?> sur RemEfficiAnt, le site de vente en ligne de Rémy et Antoine !</p>
    <h2>Résultats de la recherche</h2>
    <?php
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
    }?>
    <!-- Formulaire de trie des résultats -->
    <form id="formulaire_recherche">
            <label for="recherche">Recherche :</label>
            <input type="text" name="recherche" id="recherche" pattern="[A-Za-z]{1,20}" placeholder="Entrer le nom du produit que vous cherchez">
            <label for="categorie">Catégorie :</label>
            <select name="categorie" id="categorie">
                <option value="">Toutes les catégories</option>
                <!-- Récupérer les catégories de la base de données -->
                <?php
                $categrories=ListeCategories($conn1);
                foreach($categrories as $categorie){
                    echo "<option value=".$categorie['idcategorie'].">".$categorie['nomcategorie']."</option>";
                }
                ?>
            </select>
            <div id="prix">
                <div id="div_prix_min">
            <label for="prix_min">Prix minimum :</label>
            <input type="number" name="prix_min" id="prix_min" min="0" step="0.01" placeholder="Prix min">
                </div>
            <div id="div_prix_max">
            <label for="prix_max">Prix maximum :</label>
            <input type="number" name="prix_max" id="prix_max" min="0" step="0.01" placeholder="Prix max">
                </div>
            </div>
            <input type="submit" value="Rechercher">
        </form>
        <div class="resultats">
    <?php
    // Appel de la fonction de recherche
    $resultats=RechercheArticle($categorie, $recherche, $prix_min, $prix_max, $conn1);
    // Affichage des résultats s'il y en a
    if($resultats){
      //Retourne les articles disponibles
        $resultats=ArticlesDisponible($resultats);
        AffichageArticle($resultats, 0, $conn1);
        /*
        foreach($resultats as $resultat){
            $categorie = RechercheCategorieById($resultat['refcategorie'], $conn1);
            $categorie = $categorie[0];
            $nomcategorie = $categorie['nomcategorie'];
            echo "<a class='resultat-article' href='article.php?id=".$resultat['idarticle']."'>";
            echo "<div class='article'>";
            echo "<img src='upload/images/".$resultat['idarticle']."' alt='image article' class='image_article'>";
            echo "<div class='description_article'>";
            echo "<h3>".$resultat['nomarticle']."</h3>";
            echo "<p>Quantité disponible : ".$resultat['quantitearticle']."</p>";
            echo "<p>Catégorie : ".$nomcategorie."</p>";
            echo "</div>";
            echo "<p class='prix_article'>".$resultat['prixarticle']."€</p>";
            echo "</div>";
            echo "</a>";
            
        }*/
    }
    else{
        //redirige vers la page d'accueil avec un message d'erreur
        header('Location: erreur.php?error=Aucun résultat pour cette recherche&page=index');
    }
    ?>
    </div>
    </main>
<?php
}
else{
    //affiche le formulaire de recherche
?>
    <main>
    <p>Bienvenue <?php echo ($nom);?> sur RemEfficiAnt, le site de vente en ligne de Rémy et Antoine !</p>
        <h2>Recherche de produits</h2>
        <form action="index.php" method="post">
            <label for="recherche">Recherche :</label>
            <input type="text" name="recherche" id="recherche" pattern="[A-Za-z]{1,20}" placeholder="Entrer le nom du produit que vous cherchez">
            <label for="categorie">Catégorie :</label>
            <select name="categorie" id="categorie">
                <option value="">Toutes les catégories</option>
                <!-- Récupérer les catégories de la base de données -->
                <?php
                $categrories=ListeCategories($conn1);
                foreach($categrories as $categorie){
                    echo "<option value=".$categorie['idcategorie'].">".$categorie['nomcategorie']."</option>";
                }
                ?>
            </select>
            <div id="prix">
                <div id="div_prix_min">
            <label for="prix_min">Prix minimum :</label>
            <input type="number" name="prix_min" id="prix_min" min="0" step="0.01" placeholder="Prix min">
                </div>
            <div id="div_prix_max">
            <label for="prix_max">Prix maximum :</label>
            <input type="number" name="prix_max" id="prix_max" min="0" step="0.01" placeholder="Prix max">
                </div>
            </div>
            <input type="submit" value="Rechercher">
        </form>
    </main>
    
<?php 
}
include('footer.php'); ?>
