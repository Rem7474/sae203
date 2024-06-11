<?php
function trieinjection($texte) { //SERT A RIEN
/*---------------------------------------------
fonction qui escape les caractères spéciaux d'une chaîne de caractères
Paramètres d'entrée :
 - $texte : chaîne de caractères à filtrer
------------------------------------------------*/
    $texte = trim($texte); // supprime les espaces en début et fin de chaîne
    $texte = stripslashes($texte); // supprime les antislashs d'une chaîne
    $texte = htmlspecialchars($texte); // convertit les caractères spéciaux en entités HTML
    return $texte;
}
//fonction pour traiter une variable en fonction du type attendu et de la longueur maximale
function trieregex($texte,$regex) {
/*--------------------------------------------- 
fonction qui regarde si le texte entrée correspond a la regex entrée
Paramètres d'entrée :
 - $texte : chaîne de caractères à filtrer
 - $regex : regex a respecter
------------------------------------------------*/
    if (preg_match($regex, $texte)) {
        return true;
    }
    else {
        return false;
    }
}
function filtre($texte,$type,$longueurMax) {
/*---------------------------------------------
Fonction qui traiter une variable en fonction du type attendu et de la longueur maximale, on utilise la 
Paramètres d'entrée :
 - $texte : chaîne de caractères à filtrer
 - $type : type de la variable (int, float, string)
 - $longueurMax : longueur maximale de la variable
 en sortie on a la variable traitée et le resultat du traitement
 ------------------------------------------------*/
    $texte = trim($texte); // supprime les espaces en début et fin de chaîne
    $texte = stripslashes($texte); // supprime les antislashs d'une chaîne
    $texte = htmlspecialchars($texte); // convertit les caractères spéciaux en entités HTML
    //vérification de la longueur de la variable
    if (strlen($texte)>$longueurMax) {
        return [$texte,false];
    }
    $texte = substr($texte,0,$longueurMax); // tronque la chaîne à la longueur maximale
    $resultat=true;
    if ($type=="int") {
        //vérification que la variable est bien un entier
        $regex = "/^[0-9]+$/";
        $resultat=trieregex($texte,$regex);
        $texte = intval($texte); // convertit en entier
    }
    if ($type=="float") {
        $texte = floatval($texte); // convertit en réel
    }
    if ($type=="string") {
        $texte = strval($texte); // convertit en chaîne de caractères
    }
    if ($type=="date") {
        //vérification du format de la date
        $regex = "/^[1-2][0-9][0-9][0-9]-[0-1][0-9]-[0-3][0-9]$/";
        $resultat=trieregex($texte,$regex);
        $texte = date($texte); // convertit en date
    }
    if ($type=="password") {
        //vérification de la complexité du mot de passe
        $regex = "/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,20}$/";
        $resultat=trieregex($texte,$regex);
    }
    if ($type=="email") {
        //vérification du format de l'email
        $regex = "/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/";
        $resultat=trieregex($texte,$regex);
    }
    if ($type=="tel") {
        //vérification du format du numéro de téléphone
        $regex = "/^[0-9]{10}$/";
        $resultat=trieregex($texte,$regex);
    }
    if ($type=="adresse") {
        //vérification du format de l'adresse
        $regex = "/^(\d{1,5}[[:space:]]{1}(?i)[0-9a-zÀ-ÿ' -]*){1,50}$/";
        $resultat=trieregex($texte,$regex);
    }
    if ($type=="cp") {
        //vérification du format du code postal
        $regex = "/^[0-9]{5}$/";
        $resultat=trieregex($texte,$regex);
    }
    //retourne la variable traitée et le résultat du traitement
    return array($texte,$resultat);
}

/****************************************************************************
                         afficheTableau

Permet d'afficher le résultat dde N'IMPORTE QUELLE REQUETE traitee par fetchall

Elle affiche le nom des colonnes du tableau et leur contenu
*****************************************************************************/
function afficheTableau($resultat) {
     $affTitre=0;
    foreach ($resultat as $ligne) { // pour chaque ligne du tableau globale 2D (une ligne est vue comme un tableau 1D)
        echo "<TR></TR>";
        $i=0;
        if ($affTitre==0) {//traitement de la ligne de nom de colonnes
            $affTitre=1;
            foreach ($ligne as $cle=>$valeur) {
                if (($i % 2)==0) { echo '<th>'.$cle.'</th>';  }
                $i++;
            }
            echo "</tr></tr>";
        }
        $i=0;
        foreach ($ligne as $cle=>$valeur) { // pour chaque colonne de la ligne
            if (($i % 2)==0) { echo '<td>'.$valeur.'</td>';  }
            $i++;
        }
        echo "</tr>";
    }
}
//Retourne uniquement les articles disponible a partir de l'array contennant les informations sur les articles
function ArticlesDisponible($listeArticles) {
    $listeArticlesDispo = array();
    foreach ($listeArticles as $article) {
        if ($article['quantitearticle'] > 0) {
            array_push($listeArticlesDispo, $article);
        }
    }
    return $listeArticlesDispo;
}
function AffichageArticle($listeArticles, $options, $conn1) {
    //options : 
    // 0 : affichage normal
    // 1 : affichage avec Description
    // 2 : affichage avec Description et Bouton Supprimer et modifier sans lien vers l'article
    // 3 : affichage pour article vendu avec nom des acheteurs
    // 4 : affichage pour articles dans commande avec quantité acheté
    $data = array();
    foreach($listeArticles as $resultat){
        $categorie = RechercheCategorieById($resultat['refcategorie'], $conn1);
        $categorie = $categorie[0];
        $nomcategorie = $categorie['nomcategorie'];
        if ($options == 2) {
            echo "<div class='resultat-article'>";
        }
        else {
            echo "<a class='resultat-article' href='article.php?id=".$resultat['idarticle']."'>";
        }
        echo "<div class='article'>";
        echo "<div class='encard-image'>";
        echo "<img src='upload/images/".$resultat['idarticle']."' alt='image article' class='image_article'>";
        echo "</div>";
        echo "<div class='description_article'>";
        echo "<div class='titre_article'>";
        echo "<h3>".$resultat['nomarticle']."</h3>";
        echo "</div>";
        echo "<div class='infos_article'>";
        if ($options == 3) {
            //date de la vente
            echo "<p>Date de la vente : ".$resultat['datecommande']."</p>";
            //récupération du mois à partir de la date de la vente (uniquement les mois de l'année en cours)
            $mois = date('m', strtotime($resultat['datecommande']));
            //récupération du prix de vente (prixarticle*quantite)
            $prix = $resultat['prixarticle']*$resultat['quantite'];
            //ajout du prix de vente au total du mois s'il est déjà présent dans le tableau
            if (isset($data[$mois]['total'])) {
                $totalArticlesVendus = $data[$mois]['total'] + $prix;
            }
            //sinon on initialise le total du mois avec le prix de vente
            else {
                $totalArticlesVendus = $prix;
            }
            //ajout du mois et du total au tableau
            $data[$mois] = array('mois' => $mois, 'total' => $totalArticlesVendus);
            echo "<p>Quantité vendue : ".$resultat['quantite']."</p>";
            //affichage des acheteurs à partir de l'id de l'acheur
            $acheteur = RechercheVendeurById($resultat['refacheteur'], $conn1);
            //print_r($acheteur);
            echo "<p>Acheteur : ".$acheteur['nomutilisateur']." ".$acheteur['prenom']."</p>";
            //affichage de son adresse
            echo "<p>Adresse : <a href='https://www.google.com/maps/search/?api=1&query=".$acheteur['adresse']." ".$acheteur['codepostal']." ".$acheteur['ville']."' target='_blank'>".$acheteur['adresse'].", ".$acheteur['codepostal']." ".$acheteur['ville']."</a></p>";

        }
        else if ($options == 4) {
            echo "<p>Quantité achetée : ".$resultat['quantite']."</p>";
        }
        else{
            echo "<p>Quantité disponible : ".$resultat['quantitearticle']."</p>";
        }
        if ($options != 3){
            echo "<p>Catégorie : ".$nomcategorie."</p>";
        }
        if ($options == 1 or $options == 2) {
            echo "<p>Description : ".$resultat['descriptionarticle']."</p>";
        }
        echo "</div>";
        echo "</div>";
        echo "<p class='prix_article'>".$resultat['prixarticle']."€</p>";
        if ($options == 2) {
            echo '<div class="panel-button">';
            echo '<a class="button" href="article.php?id='.$resultat['idarticle'].'">Consulter</a>';
            echo '<a class="button" id="change" href="formulairemodifarticle.php?idproduit='.$resultat['idarticle'].'">Modifier</a>';
            echo '<a class="button" id="delete" href="traitementSupprimerArticle.php?idarticle='.$resultat['idarticle'].'">Supprimer</a>';
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        else {
            echo "</div>";
            echo "</a>";
        }
    }
    return $data;
}
//fonction pour vérifier l'image passer en paramètre, si elle est valide, elle est enregistrée dans le dossier préciser dans un autre paramètre, et enfin son nom est préciser dans un troisième paramètre
function TraitementImage($image, $dossier, $nom) {
    $erreur = 0;
    $extensions = array('.png', '.jpg', '.jpeg');
    $extension = strrchr($image['name'], '.');
    if (!in_array($extension, $extensions)) {
        $erreur = 1;
    }
    if ($image['size'] > 10000000) {
        $erreur = 2;
    }
    if ($erreur == 0) {
        $nom = $nom.$extension;
        $resultat = move_uploaded_file($image['tmp_name'], $dossier.$nom);
        if ($resultat) {
            return "ok";
        }
        else {
            return 3;
        }
    }
    else {
        return $erreur;
    }
}
function TraitementErreurImage($erreur, $redirection) {
    if ($erreur == 1) {
        //redirige vers la page de modification d'article en utilisant la page erreur.php
        //affiche que le problème est dû au format de l'image
        header("Location: erreur.php?error=Le fichier envoyé n'est pas une image&page=$redirection");
        exit();
    }
    elseif ($erreur == 2) {
        //redirige vers la page de modification d'article en utilisant la page erreur.php
        //affiche que le problème est dû à la taille de l'image
        header("Location: erreur.php?error=Le fichier envoyé est trop volumineux&page=$redirection");
        exit();
    }
    elseif ($erreur == 3) {
        //redirige vers la page de modification d'article en utilisant la page erreur.php
        //affiche que le problème est que l'image n'a pas pu être enregistrée
        header("Location: erreur.php?error=Le fichier envoyé n\'a pas pu être enregistré&page=$redirection");
        exit();
    }
}
function AffichageCommande($listeCommandes,$affichage, $conn1) {
    // Vérifier si l'array contient des résultats
    if (count($listeCommandes) > 0) {
        // Parcourir les résultats et afficher les informations de la commande
        foreach($listeCommandes as $commandes){
            $idcom= $commandes['idcommande'];
            $date= $commandes['datecommande'];
            $refacheteur = $commandes['refacheteur'];
            echo "<div class='commande'>";
            echo "ID de commande : " . $idcom. "<br>";
            echo "Date de commande : " . $date. "<br>";
            //récupération du nombre d'article dans la commande et du prix total
            $infoCommande=listeArticlesCommande($idcom, $conn1);
            //print_r($infoCommande);
            //boucle pour avoir la quantité totale de la commande
            $quantiteTotale=0;
            $prixTotal=0;
            foreach($infoCommande as $info){
                $quantiteTotale=$quantiteTotale+$info['quantite'];
                $infoArticle=RechercheArticleById($info['idrefarticle'], $conn1);
                $infoArticle=$infoArticle[0];
                $prixTotal=$prixTotal+($infoArticle['prixarticle']*$info['quantite']);
            }
            echo "Quantité d'article totale : " . $quantiteTotale. "<br>";
            echo "Prix total : " . $prixTotal. "€<br>";
            echo "</a>";
            echo "<a class='button' id='edit' href='MesCommandes.php?id=$idcom'>Détails de la commande</a>";
            if ($affichage == 1) {
                //affichage des boutons pour modifier ou supprimer la commande
                echo "<a class='button delete' href='traitementSupprimerCommande.php?idcommande=$idcom'>Supprimer</a>";
            }
            echo "</div>";
            

        }
    } else {
        echo "Aucune commande correspondante trouvée.";
    }
}
function checkCommande($idcom,$idacht, $conn1){
    $listeCommandes=ListeCommandesByAcheteur($idacht,$conn1);
    $trouve=false;
    foreach($listeCommandes as $commandes){
        if($commandes['idcommande']==$idcom){
            $trouve=true;
        }
    }
    return $trouve; 
}
function AffichageInfosUser($idUtilisateur,$nomUtilisateur,$prenom,$telephone,$email,$dateNaissance,$dateInscription,$adresse,$codePostal,$ville,$pays){
    ?>
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
<?php
}
//fonction pour envoyer un mail
function sendMail($to,$subject,$message){
$headers = 'From: recuv007@gmail.com' . "\r\n" .
           'Reply-To: remy.cuvelier@outlook.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

// Envoi de l'e-mail
$mailSent = mail($to, $subject, $message, $headers);

// Vérification du succès de l'envoi
if ($mailSent) {
    return true;
} else {
    return false;
}
}
?>