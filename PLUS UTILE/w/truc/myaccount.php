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
<section class="user-info">
	<h1>Informations de <?php echo $prenom; echo " "; echo $nomUtilisateur;?></h1>
	<?php
	echo "<img src='./upload/images/vendeurs/".$idUtilisateur."' alt='image du vendeur' class='photo_vendeur'>";
	?>
	<div class="ligne">
	<p><strong>IdUtilisateur:</strong></p> 
	<p><?php echo $idUtilisateur; ?></p>
	</div>
	<div class="ligne">
	<p><strong>Nom d'utilisateur:</strong></p> 
	<p><?php echo $nomUtilisateur; ?></p>
	</div>
	<div class="ligne">
	<p><strong>Prénom:</strong></p> 
	<p><?php echo $prenom; ?></p>
	</div>
	<div class="ligne">
	<p><strong>Téléphone:</strong></p> 
	<p><?php echo $telephone; ?></p>
	</div>
	<div class="ligne">
	<p><strong>Email:</strong></p> 
	<p><?php echo $email; ?></p>
	</div>
	<div class="ligne">
	<p><strong>Date de naissance:</strong></p> 
	<p><?php echo $dateNaissance; ?></p>
	</div>
	<div class="ligne">
	<p><strong>Date d'inscription:</strong></p> 
	<p><?php echo $dateInscription; ?></p>
	</div>
	
</section>
<section class="user-info">
	<div class="ligne">
	<p><strong>Adresse:</strong></p> 
	<p><?php echo $adresse; ?></p>
	</div>
	<div class="ligne">
	<p><strong>Code postal:</strong></p> 
	<p><?php echo $codePostal; ?></p>
	</div>
	<div class="ligne">
	<p><strong>Ville:</strong></p> 
	<p><?php echo $ville; ?></p>
	</div>
	<div class="ligne">
	<p><strong>Pays:</strong></p> 
	<p><?php echo $pays; ?></p>
	</div>
</section>
<a class="button" id="edit" href="formulairemodifuser.php">Modifier les informations</a>
<a class="button" id="changemdp" href="formulairemodifmdp.php">Changer le mot de passe</a>
<a class="button" id="logout" href="logout.php">Déconnexion</a>
</div>
</main>
</body>
<?php include('footer.php'); ?>
