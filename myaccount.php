<?php
// Démarrer une session PHP
include('header.php'); 
// Vérifier si l'utilisateur est connecté
include('checklogin.php');

// Récupérer toutes les informations de session de l'utilisateur connecté
$idUtilisateur = $_SESSION['id'];
$nomUtilisateur = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$adresse = $_SESSION['adresse'];
$ville = $_SESSION['ville'];
$codePostal = $_SESSION['cp'];
$pays = $_SESSION['pays'];
$telephone = $_SESSION['tel'];
$email = $_SESSION['email'];
$dateNaissance = $_SESSION['dateNaissance'];
$dateInscription = $_SESSION['dateInscription'];
?>
<body>
	<main>
		<h1>Mon compte</h1>
	<div class="user scaleup">
		<?php
	AffichageInfosUser($idUtilisateur, $nomUtilisateur, $prenom, $telephone, $email, $dateNaissance, $dateInscription, $adresse, $codePostal, $ville, $pays);
	?>
<a class="button" id="edit" href="formulairemodifuser.php"><i class="bi bi-pencil-square"></i></a>
<a class="button" id="changemdp" href="formulairemodifmdp.php"><i class="bi bi-key-fill"></i></a>
<a class="button" id="logout" href="logout.php"><i class="bi bi-box-arrow-right"></i></a>
</div>
</main>
</body>
<?php include('footer.php'); ?>
