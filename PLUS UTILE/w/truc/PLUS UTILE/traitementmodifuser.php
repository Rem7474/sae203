<!-- Traitement de la modification des informations d'un utilisateur -->
<?php
include('header.php');
include('checklogin.php');
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
    [$nom, $resultat]=filtre($nom, "string", 50);
    if($resultat == false){
        header('Location: erreur.php?error=Le nom n\'est pas valide&page=formulairemodifuser');
        exit();
    }
    [$prenom, $resultat]=filtre($prenom, "string", 50);
    if($resultat == false){
        header('Location: erreur.php?error=Le prénom n\'est pas valide&page=formulairemodifuser');
        exit();
    }
    [$email, $resultat]=filtre($email, "email", 50);
    if($resultat == false){
        #header('Location: erreur.php?error=L\'email n\'est pas valide&page=formulairemodifuser');
        exit();
    }
    [$adresse, $resultat]=filtre($adresse, "string", 50);
    if($resultat == false){
        header('Location: erreur.php?error=L\'adresse n\'est pas valide&page=formulairemodifuser');
        exit();
    }
    [$ville, $resultat]=filtre($ville, "string", 50);
    if($resultat == false){
        header('Location: erreur.php?error=La ville n\'est pas valide&page=formulairemodifuser');
        exit();
    }
    [$cp, $resultat]=filtre($code_postal, "int", 5);
    if($resultat == false){
        header('Location: erreur.php?error=Le code postal n\'est pas valide&page=formulairemodifuser');
        exit();
    }
    [$pays, $resultat]=filtre($pays, "string", 50);
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
        //redirige vers la page mon compte en affichant que les informations ont bien été modifiées avec succes.php
        header('Location: succes.php?success=Vos informations ont bien été modifiées, vous allez être déconnecté&page=logout');
        exit();
    }
    else{
        header('Location: erreur.php?error=Vos informations n\'ont pas pu être modifiées&page=myaccount');
        exit();
    }