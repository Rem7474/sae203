<!-- Page de déconnexion -->
<?php
include('header.php');
// Détruire toutes les variables de session
session_unset();
// Détruire la session
session_destroy();
?>
<head>
    <meta charset="UTF-8">
    <title>Déconnexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    //rediriige vers la page d'accueil avec un message de succès
    header('Location: succes.php?success=Vous avez été déconnecté avec succès&page=index');
    exit();
    ?>
</body>
<?php include('footer.php'); ?>