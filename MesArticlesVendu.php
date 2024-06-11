<!-- Pages pour afficher les articles vendus par un vendeur -->
<?php
include('header.php');
include("checklogin.php");
include("checkvendeur.php");
//réupération de l'id du vendeur
$idvendeur = $_SESSION['id'];
//récupération des articles vendus par le vendeur
$listeArticles = ListeArticlesVendus($idvendeur, $conn1);
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/graphique.js" defer></script>
<main>
    <h2>Mes articles vendus</h2>
    <div class="graphique">
    <canvas id="graphique"></canvas>
    </div>
    <?php
    //affichage des articles vendus par le vendeur
    echo "<div class='resultats fade'>";
$infos=AffichageArticle($listeArticles, 3, $conn1);
if (count($infos) == 0) {
    echo "<p>Vous n'avez pas encore vendu d'articles</p>";
}
echo "</div>";
$mois = array_column($infos, 'mois');
$totalArticlesVendus = array_column($infos, 'total');

// Préparer les données pour le graphique
$donneesGraphique = array(
    'mois' => $mois,
    'totalArticlesVendus' => $totalArticlesVendus
);
//trier les données par mois
array_multisort($donneesGraphique['mois'], SORT_ASC, $donneesGraphique['totalArticlesVendus']);
echo '<script>';
//test du nombre de lignes dans le tableau donnéesGraphique pour savoir si on affiche le graphique ou non
if (count($donneesGraphique['mois']) > 0) {
    echo 'var jsonDonneesGraphique = ' . json_encode($donneesGraphique) . ';';
} else {
    echo 'var jsonDonneesGraphique = null;';
}

echo '</script>';
    ?>
</main>
<?php include('footer.php'); ?>