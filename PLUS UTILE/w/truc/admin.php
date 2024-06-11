<!-- Page de l'administrateur permettant de gérer les utilisateurs et les articles et les catégories et les commandes -->
<?php
include('header.php');
include('checkAdmin.php')
?>
<main>
    <p>Bienvenue <?php echo ($nom);?> sur RemEfficiAnt, le site de vente en ligne de Rémy et Antoine !</p>
    <h2>Page d'administration</h2>
    <h3>Gestion des utilisateurs</h3>
    <p><a href="adminUtilisateurs.php">Gérer les utilisateurs</a></p>
    <h3>Gestion des articles</h3>
    <p><a href="adminArticles.php">Gérer les articles</a></p>
    <h3>Gestion des catégories</h3>
    <p><a href="adminCategories.php">Gérer les catégories</a></p>
    <h3>Gestion des commandes</h3>
    <p><a href="adminCommandes.php">Gérer les commandes</a></p>
</main>
<?php include('footer.php'); ?>