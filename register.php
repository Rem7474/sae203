<!-- Formulaire d'inscription -->
<?php 
include('header.php'); 
if (isset($_SESSION['id'])) {
    // Si l'utilisateur est déjà connecté, rediriger vers la page du compte
    header("Location: myaccount.php");
    exit();
  }
//test si la page est appelée en post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['dateNaissance']) || !isset($_POST['adresse']) || !isset($_POST['codePostal']) || !isset($_POST['ville']) || !isset($_POST['pays']) || !isset($_POST['telephone']) || !isset($_POST['mail']) || !isset($_POST['mdp']) || !isset($_POST['mdp2']) || !isset($_POST['type'])) {
        //redirige vers la page d'accueil avec un message d'erreur
        header('Location: erreur.php?error=Les données du formulaire sont incomplètes&page=index');
        exit();
    }
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateNaissance = $_POST['dateNaissance'];
    $adresse = $_POST['adresse'];
    $codePostal = $_POST['codePostal'];
    $ville = $_POST['ville'];
    $pays = $_POST['pays'];
    $telephone = $_POST['telephone'];
    $mail = $_POST['mail'];
    $type = $_POST['type'];
    $mdp = $_POST['mdp'];
    $mdp2 = $_POST['mdp2'];
    
    // on vérifie que les deux mots de passe sont identiques
    if ($mdp != $mdp2) {
        //redirige vers la page de création de compte avec un message d'erreur
        header('Location: erreur.php?error=Les mots de passe ne sont pas identiques&page=register');
        exit();
    }
    // on vérifie que le mail n'est pas déjà utilisé
    $check = CheckUser($mail, $conn1);
    if (!empty($check)) {
        //redirige vers la page de création de compte avec un message d'erreur
        header('Location: erreur.php?error=Le mail est déjà utilisé&page=register');
        exit();
    }
    //on vérifie que les données réspectenet le format attendu grace a la fonction filtre qui est dans fonctionSys.php
    /* ------------------------------------------------
    Fonction qui traiter une variable en fonction du type attendu et de la longueur maximale, on utilise la 
    Paramètres d'entrée :
     - $texte : chaîne de caractères à filtrer
     - $type : type de la variable (int, float, string, date, password)
     - $longueurMax : longueur maximale de la variable
     ------------------------------------------------*/
     //on récupère l'array retourné par la fonction filtre
    [$nom, $resultat]=filtre($nom, "string", 20);
    if ($resultat == false) {
        //on affiche un message d'erreur et on redirige vers la page de création de compte
        header('Location: erreur.php?error=Le nom n\'est pas valide&page=register');
        exit();
    }
    [$prenom, $resultat]=filtre($prenom, "string", 20);
    if ($resultat == false) {
        header('Location: erreur.php?error=Le prénom n\'est pas valide&page=register');
        exit();
    }
    [$dateNaissance, $resultat]=filtre($dateNaissance, "date", 10);
    if ($resultat == false) {
        header('Location: erreur.php?error=La date de naissance n\'est pas valide&page=register');
        exit();
    }
    [$adresse, $resultat]=filtre($adresse, "adresse", 50);
    if ($resultat == false) {
        //on affiche un message d'erreur et on redirige vers la page de création de compte
        header('Location: erreur.php?error=L\'adresse n\'est pas valide&page=register');
        exit();
    }
    [$codePostal, $resultat]=filtre($codePostal, "cp", 5);
    if ($resultat == false) {
        header('Location: erreur.php?error=Le code postal n\'est pas valide&page=register');
        exit();
    }
    [$ville, $resultat]=filtre($ville, "string", 50);
    if ($resultat == false) {
        //on affiche un message d'erreur et on redirige vers la page de création de compte
        header('Location: erreur.php?error=La ville n\'est pas valide&page=register');
        exit();
    }
    [$pays, $resultat]=filtre($pays, "string", 50);
    if ($resultat == false) {
        //on affiche un message d'erreur et on redirige vers la page de création de compte
        header('Location: erreur.php?error=Le pays n\'est pas valide&page=register');
        exit();
    }
    [$telephone, $resultat]=filtre($telephone, "tel", 10);
    if ($resultat == false) {
        //on affiche un message d'erreur et on redirige vers la page de création de compte
        header('Location: erreur.php?error=Le téléphone n\'est pas valide&page=register');
        exit(); 
    }
    [$mail, $resultat]=filtre($mail, "mail", 50);
    if ($resultat == false) {
        //on affiche un message d'erreur et on redirige vers la page de création de compte
        header('Location: erreur.php?error=Le mail n\'est pas valide&page=register');
        exit(); 
    }
    [$mdp, $resultat]=filtre($mdp, "password", 20);
    if ($resultat == false) {
        //on affiche un message d'erreur et on redirige vers la page de création de compte
        header('Location: erreur.php?error=Le mot de passe n\'est pas valide&page=register');
        exit(); 
    }
    [$type, $resultat]=filtre($type, "int", 1);
    if ($resultat == false) {
        //on affiche un message d'erreur et on redirige vers la page de création de compte
        header('Location: erreur.php?error=Le type de compte n\'est pas valide&page=register');
        exit(); 
    }
    // on crypte le mot de passe
    $mdp = password_hash($mdp, PASSWORD_DEFAULT);
    // on insère les données dans la table client
    $idUtilisateur=CreationUtilisateur($nom,$prenom,$adresse,$ville,$codePostal,$pays,$telephone,$mail,$mdp,$dateNaissance,$type,$conn1);
    // on ferme la connexion
    deconnexionBDD($conn1);
    if ($idUtilisateur > 0) {
        //récupération de la photo de profil si elle existe
        if (isset($_FILES['photo'])) {
        $photo = $_FILES['photo'];
        if ($photo[error]!=4){
        //on traite la photo grace a la fonction traitementImage qui est dans fonctionSys.php
        $error=traitementImage($photo, "/var/www/RT/B13/upload/images/vendeurs/",$idUtilisateur);
        $UrlRedirect="login";
        TraitementErreurImage($error,$UrlRedirect);
        }
        else{
            //on copie l'image par défaut
            copy("/var/www/RT/B13/images/profil.png","/var/www/RT/B13/upload/images/vendeurs/".$idUtilisateur.".jpg");
        }
        //on redirige vers la page de connexion en utilisant la page succes.php
        $subject="RemEfficiAnt : Création de votre compte";
        $message="Bonjour ".$prenom." ".$nom.",<br><br>Votre compte a bien été créé.<br><br>Vous pouvez désormais vous connecter à votre compte en utilisant votre adresse mail et votre mot de passe.<br><br>L'équipe RemEfficiAnt";
        sendMail($mail,$subject,$message);
        header('Location: succes.php?success=Votre compte a bien été créé&page=login');
        exit();
    }
    }
    else {
        // on redirige vers la page de création de compte avec un message d'erreur
        header('Location: erreur.php?error=Une erreur est survenue lors de la création de votre compte&page=register');
        exit();
    }
}
else {
?>
<head>
<script src="js/map.js"></script>

    <meta charset="UTF-8">
    <title>Formulaire d'inscription</title>
</head>
<body>
    <h1>Formulaire d'inscription</h1>
    <!-- lien pour se connecter -->

    <form action="register.php" method="post" enctype="multipart/form-data" class="scaleup">
    <p class="sous-texte">Déjà un compte ? <a href="login.php">Se connecter</a></p>
        <fieldset>
            <legend>Informations personnelles</legend>

            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" title="Le nom doit faire entre 2 et 20 caractères" placeholder="Votre Nom" pattern=".{2,20}" required>

            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" title="Le prénom doit faire entre 2 et 20 caractères" placeholder="Votre Prénom" pattern=".{2,20}" required>

            <label for="dateNaissance">Date de naissance :</label>
            <input type="date" name="dateNaissance" id="dateNaissance" pattern="^[0-9-]{0,10}$" required>

            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" id="adresse" title="Veuillez mettre l'adresse au format : Numéro et nom de la rue" placeholder="Votre Adresse" pattern="[0-9]{1,5}.{1,40}" required>

            <label for="codePostal">Code postal :</label>
            <input type="text" name="codePostal" id="codePostal" title="Veuillez entrer un code postal à 5 chiffres" placeholder="Votre Code Postal" pattern="^[0-9]{5}$" required>

            <label for="ville">Ville :</label>
            <input type="text" name="ville" id="ville" title="La ville doit faire entre 2 et 20 caractères" placeholder="Votre Ville" pattern=".{2,20}" required>

            <label for="pays">Pays :</label>
            <input type="text" name="pays" id="pays" title="Le Pays doit faire entre 2 et 20 caractères" placeholder="Votre Pays" pattern="[a-zA-Z]{2,20}" required>

            <label for="telephone">Téléphone :</label>
            <input type="tel" name="telephone" id="telephone" title="numero de télephone valide au format 0xxxxxxxxx" placeholder="Votre Téléphone" required>

            <label for="mail">E-mail :</label>
            <input type="email" name="mail" id="mail" placeholder="Votre E-mail" required>

        </fieldset>
        <!-- définir fonction utilisateur : Acheteur ou vendeur -->
        <fieldset>
            <legend>Informations de compte</legend>
            <label for="type">Type de compte :</label>
            <select name="type" id="type">
                <option value="1">Acheteur</option>
                <option value="0">Vendeur</option>
            </select>
            <!--Ajout d'une photo de profil-->
            <label for="photo">Photo de profil :</label>
            <input type="file" name="photo" id="photo" accept="image/png, image/jpeg">
        </fieldset>
        <fieldset>
            <legend>Informations de connexion</legend>

            <label for="mdp">Mot de passe :</label>
            <input type="password" name="mdp" id="mdp" title="entre 8 et 20 caracteres, 1 majuscule, 1 chiffre et 1 caractère spécial" placeholder="Votre Mot de Passe" pattern="^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,20}$" required>

            <label for="mdp2">Confirmer le mot de passe :</label>
            <input type="password" name="mdp2" id="mdp2" title="entre 8 et 20 caracteres, 1 majuscule, 1 chiffre et 1 caractère spécial" placeholder="Votre Mot de Passe" pattern="^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,20}$" required>
        </fieldset>
        <input type="submit" value="Envoyer">
    </form>
<?php 
}
include('footer.php'); ?>