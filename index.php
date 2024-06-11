<?php 
include('header.php'); 
?>


    <main>
    <p>Bienvenue <?php echo ($nom);?> sur RemEfficiAnt, le site de vente en ligne de Rémy et Antoine !</p>
    <h2>Résultats de la recherche</h2>
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
            <button type="submit" class="send"><i class="bi bi-search"></i></button>
    </form>

    <div id="resultats" class="resultats">

    </div>
    </main>
<?php
include('footer.php'); ?>
