<<<<<<< HEAD
<!-- Permet de modifier et d'afficher les informations des utilisateurs -->
<?php
include('header.php');
include('checkAdmin.php');
[$acheteurs, $vendeurs] = ListeUtilisateurs($conn1);
echo "<div class='users'>";
echo "<div class='acheteurs'>";
foreach ($acheteurs as $acheteur) {
    $idUtilisateur = $acheteur['idutilisateur'];
    $nomUtilisateur = $acheteur['nomutilisateur'];
    $prenom = $acheteur['prenom'];
    $telephone = $acheteur['telephone'];
    $email = $acheteur['email'];
    $dateNaissance = $acheteur['datenaissance'];
    $dateInscription = $acheteur['dateinscription'];
    $adresse = $acheteur['adresse'];
    $codePostal = $acheteur['codepostal'];
    $ville = $acheteur['ville'];
    $pays = $acheteur['pays'];

?>
<div class="user">
    <?php
AffichageInfosUser($idUtilisateur, $nomUtilisateur, $prenom, $telephone, $email, $dateNaissance, $dateInscription, $adresse, $codePostal, $ville, $pays);
$href="deleteUser.php?id=".$idUtilisateur;
?>

<a class="button" id="delete" href="<?php echo $href; ?>">Supprimer l'utilisateur</a>
</div>
<?php
}
echo "</div>";
echo "<div class='vendeurs'>";
foreach ($vendeurs as $vendeur) {
    $idUtilisateur = $vendeur['idutilisateur'];
    $nomUtilisateur = $vendeur['nomutilisateur'];
    $prenom = $vendeur['prenom'];
    $telephone = $vendeur['telephone'];
    $email = $vendeur['email'];
    $dateNaissance = $vendeur['datenaissance'];
    $dateInscription = $vendeur['dateinscription'];
    $adresse = $vendeur['adresse'];
    $codePostal = $vendeur['codepostal'];
    $ville = $vendeur['ville'];
    $pays = $vendeur['pays'];

?>
<div class="user">
    <?php
AffichageInfosUser($idUtilisateur, $nomUtilisateur, $prenom, $telephone, $email, $dateNaissance, $dateInscription, $adresse, $codePostal, $ville, $pays);
$href="deleteUser.php?id=".$idUtilisateur;
?>

<a class="button" id="delete" href="<?php echo $href; ?>">Supprimer l'utilisateur</a>
</div>
<?php
}
echo "</div>";
?>
=======
<!-- Permet de modifier et d'afficher les informations des utilisateurs -->
<?php
include('header.php');
include('checkAdmin.php');
[$acheteurs, $vendeurs] = ListeUtilisateurs($conn1);
echo "<div class='users'>";
echo "<div class='acheteurs'>";
foreach ($acheteurs as $acheteur) {
    $idUtilisateur = $acheteur['idutilisateur'];
    $nomUtilisateur = $acheteur['nomutilisateur'];
    $prenom = $acheteur['prenom'];
    $telephone = $acheteur['telephone'];
    $email = $acheteur['email'];
    $dateNaissance = $acheteur['datenaissance'];
    $dateInscription = $acheteur['dateinscription'];
    $adresse = $acheteur['adresse'];
    $codePostal = $acheteur['codepostal'];
    $ville = $acheteur['ville'];
    $pays = $acheteur['pays'];

?>
<div class="user">
    <?php
AffichageInfosUser($idUtilisateur, $nomUtilisateur, $prenom, $telephone, $email, $dateNaissance, $dateInscription, $adresse, $codePostal, $ville, $pays);
$href="deleteUser.php?id=".$idUtilisateur;
?>

<a class="button" id="delete" href="<?php echo $href; ?>">Supprimer l'utilisateur</a>
</div>
<?php
}
echo "</div>";
echo "<div class='vendeurs'>";
foreach ($vendeurs as $vendeur) {
    $idUtilisateur = $vendeur['idutilisateur'];
    $nomUtilisateur = $vendeur['nomutilisateur'];
    $prenom = $vendeur['prenom'];
    $telephone = $vendeur['telephone'];
    $email = $vendeur['email'];
    $dateNaissance = $vendeur['datenaissance'];
    $dateInscription = $vendeur['dateinscription'];
    $adresse = $vendeur['adresse'];
    $codePostal = $vendeur['codepostal'];
    $ville = $vendeur['ville'];
    $pays = $vendeur['pays'];

?>
<div class="user">
    <?php
AffichageInfosUser($idUtilisateur, $nomUtilisateur, $prenom, $telephone, $email, $dateNaissance, $dateInscription, $adresse, $codePostal, $ville, $pays);
$href="deleteUser.php?id=".$idUtilisateur;
?>

<a class="button" id="delete" href="<?php echo $href; ?>">Supprimer l'utilisateur</a>
</div>
<?php
}
echo "</div>";
?>
>>>>>>> 521457ac98f141eec458e34e9992cda7c61fff25
<!-- Affichage des utilisateurs -->