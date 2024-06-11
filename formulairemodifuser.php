<!-- Formulaire de modification d'adresse et d'informations personnelles -->
<?php
include 'header.php';
include 'checklogin.php';
//on regarde si la page a été appelée avec en post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //récupération des informations du formulaire
if(!isset($_POST['nom']) && !isset($_POST['prenom']) && !isset($_POST['email']) && !isset($_POST['adresse']) && !isset($_POST['ville']) && !isset($_POST['codePostal']) && !isset($_POST['telephone']) && !isset($_POST['pays'])){
    //si aucune information n'est rentrée, on redirige vers la page de modification en affichant qu'il n'y a eu aucune modification
    header('Location: erreur.php?error=Vous n\'avez pas modifié vos informations&page=myaccount');
    exit();
}
$iduser = $_SESSION['id'];
if(!empty($_POST['nom'])){
    $nom = $_POST['nom'];
}
else{
    $nom = $_SESSION['nom'];
}
    if(!empty($_POST['prenom'])){
    $prenom = $_POST['prenom'];
    }
    else{
        $prenom = $_SESSION['prenom'];
    }
    if(!empty($_POST['email'])){
    $email = $_POST['email'];
    }
    else{
        $email = $_SESSION['email'];
    }
    if(!empty($_POST['adresse'])){
    $adresse = $_POST['adresse'];
    }
    else{
        $adresse = $_SESSION['adresse'];
    }
    if(!empty($_POST['ville'])){
    $ville = $_POST['ville'];
    }
    else{
        $ville = $_SESSION['ville'];
    }
    if(!empty($_POST['codePostal'])){
    $code_postal = $_POST['codePostal'];
    }
    else{
        $code_postal = $_SESSION['cp'];
    }
    if(!empty($_POST['pays'])){
    $pays = $_POST['pays'];
    }
    else{
        $pays = $_SESSION['pays'];
    }
    if(!empty($_POST['telephone'])){
    $telephone = $_POST['telephone'];
    }
    else{
        $telephone = $_SESSION['tel'];
    }
    if(!empty($_POST['email'])){
        $email = $_POST['email'];
    }
    else{
        $email = $_SESSION['email'];
    }
    //vérification des informations
    [$nom, $resultat]=filtre($nom, "string", 20);
    if($resultat == false){
        header('Location: erreur.php?error=Le nom n\'est pas valide&page=formulairemodifuser');
        exit();
    }
    [$prenom, $resultat]=filtre($prenom, "string", 20);
    if($resultat == false){
        header('Location: erreur.php?error=Le prénom n\'est pas valide&page=formulairemodifuser');
        exit();
    }
    [$adresse, $resultat]=filtre($adresse, "string", 40);
    if($resultat == false){
        header('Location: erreur.php?error=L\'adresse n\'est pas valide&page=formulairemodifuser');
        exit();
    }
    [$ville, $resultat]=filtre($ville, "string", 20);
    if($resultat == false){
        header('Location: erreur.php?error=La ville n\'est pas valide&page=formulairemodifuser');
        exit();
    }
    [$cp, $resultat]=filtre($code_postal, "int", 5);
    if($resultat == false){
        header('Location: erreur.php?error=Le code postal n\'est pas valide&page=formulairemodifuser');
        exit();
    }
    [$pays, $resultat]=filtre($pays, "string", 20);
    if($resultat == false){
        header('Location: erreur.php?error=Le pays n\'est pas valide&page=formulairemodifuser');
        exit();
    }
    [$telephone, $resultat]=filtre($telephone, "int", 10);
    if($resultat == false){
        header('Location: erreur.php?error=Le numéro de téléphone n\'est pas valide&page=formulairemodifuser');
    }
    [$email, $resultat]=filtre($email, "email", 50);
    if($resultat == false){
        header('Location: erreur.php?error=L\'email n\'est pas valide&page=formulairemodifuser');
        exit();
    }


    $modif=modifInfoUtilisateur($iduser,$nom,$prenom,$adresse,$ville,$cp,$pays,$telephone,$email,$conn1);
    if($modif > 0){
        //test si une photo a été envoyée
        if(!empty($_FILES['photo'])){
            $photo = $_FILES['photo'];
            if ($photo[error]!=4){
            //on traite la photo grace a la fonction traitementImage qui est dans fonctionSys.php
            $error=traitementImage($photo, "/var/www/RT/B13/upload/images/vendeurs/",$modif);
            $UrlRedirect="logout";
            TraitementErreurImage($error,$UrlRedirect);
            }
        }
        //redirige vers la page mon compte en affichant que les informations ont bien été modifiées avec succes.php
        header('Location: succes.php?success=Vos informations ont bien été modifiées, vous allez être déconnecté&page=logout');
        exit();
    }
    else{
        header('Location: erreur.php?error=Vos informations n\'ont pas pu être modifiées&page=myaccount');
        exit();
    }
}
else{
    //si la page n'a pas été appelée en post
?>
<script src="js/map.js"></script>
<!-- Formulaire de modification d'adresse et d'informations personnelles -->
<!-- On met en placeholder dans le formulaire les informations de l'utilisateur -->
<form action="formulairemodifuser.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Modification des Informations personnelles</legend>

            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" title="Le nom doit faire entre 2 et 20 caractères" placeholder="<?php echo $_SESSION['nom']; ?>" pattern=".{2,20}">

            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" title="Le prénom doit faire entre 2 et 20 caractères" placeholder="<?php echo $_SESSION['prenom']; ?>" pattern=".{2,20}">

            <label for="dateNaissance">Date de naissance :</label>
            <input type="date" name="dateNaissance" id="dateNaissance" pattern="^[0-9-]{0,10}$" placeholder="<?php echo $_SESSION['dateNaissance']; ?>">

            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" id="adresse" title="Veuillez mettre l'adresse au format : Numéro et nom de la rue" placeholder="<?php echo $_SESSION['adresse']; ?>" pattern="[0-9]{1,5}.{1,40}">

            <label for="codePostal">Code postal :</label>
            <input type="text" name="codePostal" id="codePostal" title="Veuillez entrer un code postal à 5 chiffres" placeholder="<?php echo $_SESSION['cp']; ?>" pattern="^[0-9]{5}$">

            <label for="ville">Ville :</label>
            <input type="text" name="ville" id="ville" title="La ville doit faire entre 2 et 20 caractères" placeholder="<?php echo $_SESSION['ville']; ?>" pattern=".{2,20}">

            <label for="pays">Pays :</label>
            <input type="text" name="pays" id="pays" title="Le Pays doit faire entre 2 et 20 caractères" placeholder="<?php echo $_SESSION['pays']; ?>" pattern="[a-zA-Z]{2,20}">

            <label for="telephone">Téléphone :</label>
            <input type="text" name="telephone" id="telephone" title="Veuillez entrer un numéro de téléphone à 10 chiffres" placeholder="<?php echo $_SESSION['tel']; ?>" pattern="^[0-9]{10}$">

            <label for="email">Email :</label>
            <input type="email" name="email" id="email" title="Veuillez entrer une adresse mail valide" placeholder="<?php echo $_SESSION['email']; ?>" pattern="^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$">
            <!--Modification de la photo de profil-->
            <label for="photo">Photo de profil :</label>
            <input type="file" name="photo" id="photo" title="Veuillez entrer une photo de profil">
        </fieldset>

    <input type="submit" value="Modifier">
    <a class="button" id="cancel" href="myaccount.php">Annuler</a>
</form>
<?php
}
include 'footer.php';
?>

