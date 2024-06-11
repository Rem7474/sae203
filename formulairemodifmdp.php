<!-- Formulaire pour modifier le mot de passe -->
<?php
include 'header.php';
include 'checklogin.php';
//si la page est appelée en post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['mdp_actuel']) || !isset($_POST['mdp_1']) || !isset($_POST['mdp_2'])) {
        //rediriger vers la page de modification de mot de passe en utilisant la page erreur.php si le formulaire n'a pas été soumis
        header('Location: erreur.php?error=Le formulaire n\'a pas été soumis correctement&page=formulairemodifmdp');
        exit();
    }
    if (empty($_POST['mdp_actuel']) || empty($_POST['mdp_1']) || empty($_POST['mdp_2'])) {
        //rediriger vers la page de modification de mot de passe en utilisant la page erreur.php si des champs sont vides
        header('Location: erreur.php?error=Un ou plusieurs champs sont vides&page=formulairemodifmdp');
        exit();
    }
    else {  
            //on recupère toute les variables du formulaire
            $mdp_actuel = $_POST['mdp_actuel'];
            $mdp_1 = $_POST['mdp_1'];
            $mdp_2 = $_POST['mdp_2'];
            $login = $_SESSION['email'];
            //on filtre les variables
            [$mdp_actuel, $resultat]=filtre($mdp_actuel, "string", 20);
            if($resultat == false){
                //rediriger vers la page de modification de mot de passe en utilisant la page erreur.php si le mot de passe actuel est invalide
                header('Location: erreur.php?error=Le mot de passe actuel est invalide&page=formulairemodifmdp');
                exit();
            }
            // Vérifier si les mots de passe correspondent
            if ($mdp_1 != $mdp_2) {
                //rediriger vers la page de modification de mot de passe en utilisant la page erreur.php si les mots de passe ne correspondent pas
                header('Location: erreur.php?error=Les nouveaux mots de passe ne correspondent pas&page=formulairemodifmdp');
                exit();
            } 
            [$mdp_1, $resultat]=filtre($mdp_1, "string", 20);
            if($resultat == false){
                //rediriger vers la page de modification de mot de passe en utilisant la page erreur.php si le nouveau mot de passe est invalide
                header('Location: erreur.php?error=Le nouveau mot de passe est invalide&page=formulairemodifmdp');
                exit();
            }
            [$mdp_2, $resultat]=filtre($mdp_2, "string", 20);
            if($resultat == false){
                //rediriger vers la page de modification de mot de passe en utilisant la page erreur.php si la confirmation du nouveau mot de passe est invalide
                header('Location: erreur.php?error=La confirmation du nouveau mot de passe est invalide&page=formulairemodifmdp');
                exit();
            }
                //on vérifie si l'utilisateur existe
                $check = CheckUser($login, $conn1);
                $resultat = $check[0];
                $row = count($resultat);
                //si l'utilisateur existe on vérifie si le mot de passe actuel est correct
                if($row > 0){
                    if (password_verify($mdp_actuel, $resultat['motdepasse'])) {
                        // Si le mot de passe actuel est correct, on modifie le mot de passe
                        $mdp_1 = $_POST['mdp_1'];
                        $mdp_1 = password_hash($mdp_1, PASSWORD_DEFAULT);
                        $id = $_SESSION['id'];
                        //on appel la fonction pour modifier le mot de passe
                        $result = UpdateMdp($id, $mdp_1, $conn1);
                        if ($result==$id) {
                            $mail = $_SESSION['email'];
                            $subject = "RemEfficiAnt : Modification du mot de passe";
                            $message = "Bonjour, votre mot de passe a été modifié avec succès.";
                            sendMail($mail,$subject,$message);
                            //redirige vers la page de succès
                            header('Location: succes.php?success=Le mot de passe a été modifié avec succès&page=myaccount');
                            exit();
                        } else {
                            //rediriger vers la page de modification de mot de passe en utilisant la page erreur.php si la modification du mot de passe a échoué
                            header('Location: erreur.php?error=La modification du mot de passe a échoué&page=formulairemodifmdp');
                            exit();
                        }
                    } else {
                        //rediriger vers la page de modification de mot de passe en utilisant la page erreur.php si le mot de passe actuel est incorrect
                        header('Location: erreur.php?error=Le mot de passe actuel est incorrect&page=formulairemodifmdp');
                        exit();
                    }
                }
                //sinon on redirige vers la page de déconnexion
                else{
                    //rediriger vers la page de modification de mot de passe en utilisant la page erreur.php si l'utilisateur n'existe pas
                    header('Location: erreur.php?error=Utilisateur inexistant&page=formulairemodifmdp');
                    exit();
                }
        }
}
//sinon on affiche le formulaire
else{
?>
<form method="post" action="formulairemodifmdp.php">
    <div class="form-group">
        <label for="mdp">Mot de passe actuel</label>
        <input type="password" class="form-control" id="mdp" name="mdp_actuel" placeholder="Mot de passe actuel">
    </div>
    <div class="form-group">
        <label for="mdp">Nouveau mot de passe</label>
        <input type="password" class="form-control" id="mdp" name="mdp_1" placeholder="Nouveau mot de passe">
    </div>
    <div class="form-group">
        <label for="mdp">Confirmer le nouveau mot de passe</label>
        <input type="password" class="form-control" id="mdp" name="mdp_2" placeholder="Confirmer le nouveau mot de passe">
    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
    <a class="button" id="cancel" href="myaccount.php">Annuler</a>
</form>
<?php
}
include 'footer.php';
?>