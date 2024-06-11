<?php
//UTILE
function NewCategorie($nom,$connex) {
/* ------------------------------------------------
permet de créer une nouvelle catégorie :
  paramètres d'entrée
    - 1er paramètre $nom : contient le nom de la catégorie
    - 2ème paramètre $connex : contient le connecteur de la bdd
  retourne l'identifiant qui a été choisi par le sgbd lors de l'insertion
*/
  $stmt = $connex->prepare("INSERT INTO CATEGORIES (NomCategorie) VALUES (:nom) RETURNING idcategorie");
  $stmt->bindParam(':nom', $nom);
  $stmt->execute();
}

//UTILE
function NewUtilisateur($nom,$prenom,$addresse,$ville,$codepostal,$pays,$telephone,$email,$mdp,$datenaissance,$connex) {
/* ------------------------------------------------
permet de créer un nouvel utilisateur :
  paramètres d'entrée
    - 1er paramètre $nom : contient le nom de l'utilisateur
    - 2ème paramètre $prenom : contient le prenom de l'utilisateur
    - 3ème paramètre $addresse : contient l'addresse de l'utilisateur
    - 4ème paramètre $ville : contient la ville de l'utilisateur
    - 5ème paramètre $codepostal : contient le code postal de l'utilisateur
    - 6ème paramètre $pays : contient le pays de l'utilisateur
    - 7ème paramètre $telephone : contient le telephone de l'utilisateur
    - 8ème paramètre $email : contient l'email de l'utilisateur
    - 9ème paramètre $mdp : contient le mot de passe de l'utilisateur
    - 10ème paramètre $datenaissance : contient la date de naissance de l'utilisateur
    - 11ème paramètre $connex : contient le connecteur de la bdd
  récupère l'id de l'utilisateur qui vient d'être créé pour l'ajouter dans la table des acheteurs ou des vendeurs
*/
  $stmt = $connex->prepare("INSERT INTO UTILISATEURS (NomUtilisateur, Prenom, Adresse, Ville, CodePostal, Pays, Telephone, Email, MotDePasse, DateNaissance, dateinscription) VALUES (:nom, :prenom, :adresse, :ville, :codepostal, :pays, :telephone, :email, :motdepasse, :datenaissance, :dateinscription) RETURNING idutilisateur");
  $stmt->bindParam(':nom', $nom);
  $stmt->bindParam(':prenom', $prenom);
  $stmt->bindParam(':adresse', $addresse);
  $stmt->bindParam(':ville', $ville);
  $stmt->bindParam(':codepostal', $codepostal);
  $stmt->bindParam(':pays', $pays);
  $stmt->bindParam(':telephone', $telephone);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':motdepasse', $mdp);
  $stmt->bindParam(':datenaissance', $datenaissance);
  //date inscription avec date du jour
  $dateinscription=date("Y-m-d");
  $stmt->bindParam(':dateinscription', $dateinscription);
  $stmt->execute();
  $lire = $stmt->fetchColumn();
  return $lire;
}
//UTILE
function NewAcheteur($idutilisateur,$connex) {
/* ------------------------------------------------
permet de créer un nouvel acheteur :
  paramètres d'entrée
    - 1er paramètre $idutilisateur : contient l'id de l'utilisateur
    - 2ème paramètre $connex : contient le connecteur de la bdd
*/ 
  $stmt = $connex->prepare("INSERT INTO ACHETEURS (IdRefUtilisateur) VALUES (:idutilisateur)");
  $stmt->bindParam(':idutilisateur', $idutilisateur);
  $stmt->execute();
}
//UTILE
function NewVendeur($idutilisateur,$connex) {
/* ------------------------------------------------
permet de créer un nouvel vendeur :
  paramètres d'entrée
    - 1er paramètre $idutilisateur : contient l'id de l'utilisateur
    - 2ème paramètre $connex : contient le connecteur de la bdd
*/
  $stmt = $connex->prepare("INSERT INTO VENDEURS (IdRefUtilisateur) VALUES (:idutilisateur)");
  $stmt->bindParam(':idutilisateur', $idutilisateur);
  $stmt->execute();
}
//UTILE
function CreationUtilisateur($nom,$prenom,$addresse,$ville,$codepostal,$pays,$telephone,$email,$mdp,$datenaissance,$role,$connex) {
/* ------------------------------------------------
fait appel aux fonction NewUtilisateur, NewAcheteur et NewVendeur pour créer un nouvel utilisateur :
  paramètres d'entrée
    - 1er paramètre $nom : contient le nom de l'utilisateur
    - 2ème paramètre $prenom : contient le prenom de l'utilisateur
    - 3ème paramètre $addresse : contient l'addresse de l'utilisateur
    - 4ème paramètre $ville : contient la ville de l'utilisateur
    - 5ème paramètre $codepostal : contient le code postal de l'utilisateur
    - 6ème paramètre $pays : contient le pays de l'utilisateur
    - 7ème paramètre $telephone : contient le telephone de l'utilisateur
    - 8ème paramètre $email : contient l'email de l'utilisateur
    - 9ème paramètre $mdp : contient le mot de passe de l'utilisateur
    - 10ème paramètre $datenaissance : contient la date de naissance de l'utilisateur
    - 11ème paramètre $role : contient le role de l'utilisateur (1 pour acheteur, 2 pour vendeur)
    - 12ème paramètre $connex : contient le connecteur de la bdd
*/
//on affiche les parametre pour voir si il sont bien là
  $idutilisateur=NewUtilisateur($nom,$prenom,$addresse,$ville,$codepostal,$pays,$telephone,$email,$mdp,$datenaissance,$connex);
  if ($role==1) {
    NewAcheteur($idutilisateur,$connex);
  }
  else {
    NewVendeur($idutilisateur,$connex);
  }
  return $idutilisateur;
}
//UTILE
function NewArticle($nom,$prix,$quantite,$description,$categorie,$idvendeur,$connex) {
/* ------------------------------------------------
permet de rajouter un article avec comme parametre d'entree :
  - 1er paramètre $nom : contient le nom de l'article
  - 2ème paramètre $prix : contient le prix de l'article
  - 3ème paramètre $quantite : contient la quantite de l'article
  - 4ème paramètre $description : contient la description de l'article
  - 5ème paramètre $categorie : contient la categorie de l'article
  - 6ème paramètre $idvendeur : contient l'id du vendeur
  - 7ème paramètre $connex : contient le connecteur de la bdd
return l'id de l'article qui vient d'être créé
*/
  $stmt = $connex->prepare("INSERT INTO ARTICLES (NomArticle, PrixArticle, QuantiteArticle, DescriptionArticle, RefCategorie, RefVendeur) VALUES (:nom, :prix, :quantite, :description, :categorie, :idvendeur) RETURNING IdArticle");
  $stmt->bindParam(':nom', $nom);
  $stmt->bindParam(':prix', $prix);
  $stmt->bindParam(':quantite', $quantite);
  $stmt->bindParam(':description', $description);
  $stmt->bindParam(':categorie', $categorie);
  $stmt->bindParam(':idvendeur', $idvendeur);
  $stmt->execute();
  $lire = $stmt->fetchColumn();
  return $lire;
}
//PAS ENCORE UTILISE
function NewCommande($idacheteur,$connex) {
/* ------------------------------------------------
permet de de créer une commande avec comme parametre d'entree :
  - 1er paramètre $idacheteur : contient l'id de l'acheteur
  - 2ème paramètre $connex : contient le connecteur de la bdd
  dans la requête, la date est celle du jour
  retourne l'id de la commande
*/
  $stmt = $connex->prepare("INSERT INTO COMMANDES (DateCommande,RefAcheteur) VALUES (CURRENT_DATE,:idacheteur) RETURNING IdCommande");
  $stmt->bindParam(':idacheteur', $idacheteur);
  $stmt->execute();
  $lire = $stmt->fetchColumn();
  return $lire;
}
//PAS ENCORE UTILISE
function NewArticleInCommande($idarticle,$idcommande,$quantite,$connex) {
/* ------------------------------------------------
permet de rajouter un article dans une commande avec comme parametre d'entree :
  - 1er paramètre $idarticle : contient l'id de l'article
  - 2ème paramètre $idcommande : contient l'id de la commande
  - 3ème paramètre $quantite : contient la quantite de l'article
  - 4ème paramètre $connex : contient le connecteur de la bdd
*/
  $sql="INSERT INTO CONTENIR (IdRefCommande,IdRefArticle,Quantite) VALUES ('".$idarticle."','".$idcommande."','".$quantite."')";    // déclaration de la variable appelée $sql.
  $res=$connex->query($sql);				// demande d'execution de la requête sur la base via le connecteur $connex. Le resultat est dans la variable $res au format structuré PDO
}
//UTILE
function ListeArticles($connex) {
/* ------------------------------------------------
permet de lister les articles avec comme parametre d'entree :
  - 1er paramètre $connex : contient le connecteur de la bdd
  retourne la liste des articles
*/
  $stmt=$connex->prepare("SELECT * FROM ARTICLES");
  $stmt->execute();
  $lire = $stmt->fetchAll();
  return $lire;
}
//PAS UTILE
function ListeArticlesByNomCategorieandPrix($nom,$categorie,$prixmin,$prixmax,$connex) {
/* ------------------------------------------------
permet de lister les articles avec comme parametre d'entree :
  - 1er paramètre $nom : contient le nom de l'article
  - 2ème paramètre $categorie : contient la categorie de l'article
  - 3ème paramètre $prix : contient le prix de l'article
  - 4ème paramètre $connex : contient le connecteur de la bdd
  retourne la liste des articles
*/
  $stmt=$connex->prepare("SELECT * FROM ARTICLES WHERE NomArticle LIKE :nom AND CategorieArticle LIKE :categorie AND PrixArticle BETWEEN :prix-min AND :prix-max");
  $stmt->bindParam(':nom', $nom);
  $stmt->bindParam(':categorie', $categorie);
  $stmt->bindParam(':prix-min', $prixmin);
  $stmt->bindParam(':prix-max', $prixmax);
  $stmt->execute();
  return $stmt;
}
//PAS UTILE
function ListeArticlesByCategorie($categorie,$connex) {
/* ------------------------------------------------
permet de lister les articles d'une categorie avec comme parametre d'entree :
  - 1er paramètre $categorie : contient la categorie de l'article
  - 2ème paramètre $connex : contient le connecteur de la bdd
  retourne la liste des articles
*/
  $sql="SELECT * FROM ARTICLES WHERE CategorieArticle='".$categorie."'";    // déclaration de la variable appelée $sql.
  $res=$connex->query($sql);				// demande d'execution de la requête sur la base via le connecteur $connex. Le resultat est dans la variable $res au format structuré PDO
  return $res;
}
//UTILE
function ListeArticlesByVendeur($idvendeur,$connex) {
/* ------------------------------------------------
permet de lister les articles d'un vendeur avec comme parametre d'entree :
  - 1er paramètre $idvendeur : contient l'id du vendeur
  - 2ème paramètre $connex : contient le connecteur de la bdd
  retourne la liste des articles
*/
  $stmt=$connex->prepare("SELECT * FROM ARTICLES WHERE RefVendeur=:idvendeur");
  $stmt->bindParam(':idvendeur', $idvendeur);
  $stmt->execute();
  $lire = $stmt->fetchALL();
  return $lire;
}
//PAS UTILE
function ListeArticlesByNom($nom,$connex) {
/* ------------------------------------------------
permet de lister les articles avec comme parametre d'entree :
  - 1er paramètre $nom : contient le nom de l'article, ou une partie du nom
  - 2ème paramètre $connex : contient le connecteur de la bdd
  retourne la liste des articles
*/
  $sql="SELECT * FROM ARTICLES WHERE NomArticle LIKE '%".$nom."%'";    // déclaration de la variable appelée $sql.
  $res=$connex->query($sql);				// demande d'execution de la requête sur la base via le connecteur $connex. Le resultat est dans la variable $res au format structuré PDO
  return $res;
}
//PAS UTILE
function ListeArticlesByPrix($prix,$connex) {
/* ------------------------------------------------
permet de lister les articles avec comme parametre d'entree :
  - 1er paramètre $prix : contient le prix de l'article, ou une partie du prix
  - 2ème paramètre $connex : contient le connecteur de la bdd
  retourne la liste des articles
*/
  $sql="SELECT * FROM ARTICLES WHERE PrixArticle LIKE '%".$prix."%'";    // déclaration de la variable appelée $sql.
  $res=$connex->query($sql);				// demande d'execution de la requête sur la base via le connecteur $connex. Le resultat est dans la variable $res au format structuré PDO
  return $res;
}
//UTILE
function listeArticlesCommande($idcommande,$connex) {
/* ------------------------------------------------
permet de lister les articles d'une commande avec comme parametre d'entree :
  - 1er paramètre $idcommande : contient l'id de la commande
  - 2ème paramètre $connex : contient le connecteur de la bdd
  retourne la liste des articles
  utilise pdo prepare
*/
  $stmt=$connex->prepare("SELECT * FROM CONTENIR INNER JOIN ARTICLES ON CONTENIR.IdRefArticle=ARTICLES.IdArticle WHERE IdRefCommande=:idcommande ");
  $stmt->bindParam(':idcommande', $idcommande);
  $stmt->execute();
  $lire = $stmt->fetchALL();
  return $lire;
}
//PAS ENCORE UTILE
function ArticleVendu($idarticle,$connex) {
/* ------------------------------------------------
recherche dans la table CONTENIR si IdRefArticle=idarticle
  - 1er paramètre $idarticle : contient l'id de l'article
  - 2ème paramètre $connex : contient le connecteur de la bdd
  retourne le nombre d'articles vendus
*/
  $sql="SELECT SUM(Quantite) FROM CONTENIR WHERE IdRefArticle='".$idarticle."'";    // déclaration de la variable appelée $sql.
  $res=$connex->query($sql);				// demande d'execution de la requête sur la base via le connecteur $connex. Le resultat est dans la variable $res au format structuré PDO
  $lire = $res->fetchColumn(); 		// récupération de la valeur l'élément RETURNING contenu dans $res
  return $lire;	
}
//PAS ENCORE UTILE
function ArticleVenduByVendeur($idarticle,$idvendeur,$connex) {
/* ------------------------------------------------
recherche dans la table CONTENIR si IdRefArticle=idarticle et IdRefVendeur=idvendeur
  - 1er paramètre $idarticle : contient l'id de l'article
  - 2ème paramètre $idvendeur : contient l'id du vendeur
  - 3ème paramètre $connex : contient le connecteur de la bdd
  retourne le nombre d'articles vendus
*/
  $sql="SELECT SUM(Quantite) FROM CONTENIR WHERE IdRefArticle='".$idarticle."' AND IdRefVendeur='".$idvendeur."'";    // déclaration de la variable appelée $sql.
  $res=$connex->query($sql);				// demande d'execution de la requête sur la base via le connecteur $connex. Le resultat est dans la variable $res au format structuré PDO
  $lire = $res->fetchColumn(); 		// récupération de la valeur l'élément RETURNING contenu dans $res
  return $lire;	
}
//PAS ENCORE UTILE
function ArticleVenduByCategorie($idarticle,$categorie,$connex) {
/* ------------------------------------------------
recherche dans la table CONTENIR si IdRefArticle=idarticle et CategorieArticle=categorie
  - 1er paramètre $idarticle : contient l'id de l'article
  - 2ème paramètre $categorie : contient la catégorie de l'article
  - 3ème paramètre $connex : contient le connecteur de la bdd
  retourne le nombre d'articles vendus
*/
  $sql="SELECT SUM(Quantite) FROM CONTENIR WHERE IdRefArticle='".$idarticle."' AND CategorieArticle='".$categorie."'";    // déclaration de la variable appelée $sql.
  $res=$connex->query($sql);				// demande d'execution de la requête sur la base via le connecteur $connex. Le resultat est dans la variable $res au format structuré PDO
  $lire = $res->fetchColumn(); 		// récupération de la valeur l'élément RETURNING contenu dans $res
  return $lire;	
}
//UTILE
function CheckUser($login,$connex) {
/* ------------------------------------------------
recherche dans la table UTILISATEURS si email existe, retourne les infos de l'utilisateur
  - 1er paramètre $login : contient l'email de l'utilisateur
  - 2ème paramètre $connex : contient le connecteur de la bdd
  retourne les infos de l'utilisateur
*/
  $stmt = $connex->prepare("SELECT * FROM UTILISATEURS WHERE Email=:login");	// préparation de la requête
  $stmt->bindParam(':login', $login);		// affectation de la variable $login au paramètre :login
  $stmt->execute();				// execution de la requête
  $lire = $stmt->fetchAll(); 			// récupération de la valeur l'élément RETURNING contenu dans $res
  return $lire;
}
//UTILE
function CheckVendeur($idvendeur,$connex) {
/* ------------------------------------------------
recherche dans la table VENDEURS si idvendeur existe, retourne les infos du vendeur
  - 1er paramètre $idvendeur : contient l'id du vendeur
  - 2ème paramètre $connex : contient le connecteur de la bdd
  retourne les infos du vendeur
*/
  $stmt = $connex->prepare("SELECT * FROM VENDEURS WHERE idrefutilisateur=:idvendeur");	// préparation de la requête
  $stmt->bindParam(':idvendeur', $idvendeur);		// affectation de la variable $idvendeur au paramètre :idvendeur
  $stmt->execute();				// execution de la requête
  $lire = $stmt->fetchAll(); 			// récupération de la valeur l'élément RETURNING contenu dans $res
  return $lire;
}
//UTILE
function CheckAcheteur($idacheteur,$connex) {
/* ------------------------------------------------
rechercche dans la table ACHETEURS si idacheteur existe, retourne les infos de l'acheteur
  - 1er paramètre $idacheteur : contient l'id de l'acheteur
  - 2ème paramètre $connex : contient le connecteur de la bdd
  retourne les infos de l'acheteur
*/
  $stmt = $connex->prepare("SELECT * FROM ACHETEURS WHERE idrefutilisateur=:idacheteur");	// préparation de la requête
  $stmt->bindParam(':idacheteur', $idacheteur);		// affectation de la variable $idacheteur au paramètre :idacheteur
  $stmt->execute();				// execution de la requête
  $lire = $stmt->fetchAll(); 			// récupération de la valeur l'élément RETURNING contenu dans $res
  return $lire;
}
//UTILE
function RechercheArticle($category = null, $name = null, $minPrice = null, $maxPrice = null, $pdo) {
  //fonction qui permet de rechercher un article en fonction de plusieurs critères s'ils sont renseignés
  //si aucun critère n'est renseigné, on affiche tous les articles
  //si un critère est renseigné, on affiche les articles qui correspondent à ce critère
  //si plusieurs critères sont renseignés, on affiche les articles qui correspondent à tous les critères
  //on retourne un tableau contenant les articles qui correspondent à la recherche
  $sql = "SELECT * FROM ARTICLES";
  $where = array();
  if ($category != null) {
    $where[] = "refcategorie = '$category'";
  }
  if ($name != null) {
    $name_upper = strtoupper($name); // convertir en majuscules

    $where[] = "UPPER(NomArticle) LIKE '%$name_upper%'";
  }
  //on test si la conditions sur les prix est un between ou un simple comparaison
  if ($minPrice != null && $maxPrice != null) {
    $where[] = "PrixArticle BETWEEN $minPrice AND $maxPrice";
  } else {
    if ($minPrice != null) {
      $where[] = "PrixArticle >= $minPrice";
    }
    if ($maxPrice != null) {
      $where[] = "PrixArticle <= $maxPrice";
    }
  }
  if (count($where) > 0) {
    $sql .= " WHERE " . implode(' AND ', $where);
  }
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $lire = $stmt->fetchAll();
  return $lire;
}
//UTILE
function RechercheArticleById($idarticle,$connex) {
/* ------------------------------------------------
recherche dans la table ARTICLES si idarticle existe, retourne les infos de l'article
  - 1er paramètre $idarticle : contient l'id de l'article
  - 2ème paramètre $connex : contient le connecteur de la bdd
  retourne les infos de l'article
*/
  $stmt = $connex->prepare("SELECT * FROM ARTICLES WHERE idarticle=:idarticle");	// préparation de la requête
  $stmt->bindParam(':idarticle', $idarticle);		// affectation de la variable $idarticle au paramètre :idarticle
  $stmt->execute();				// execution de la requête
  $lire = $stmt->fetchAll(); 			// récupération de la valeur l'élément RETURNING contenu dans $res
  return $lire;
}
//UTILE
function ListeCategories($connex) {
/* ------------------------------------------------
fonction qui retourne la liste des catégories d'articles
  - 1er paramètre $connex : contient le connecteur de la bdd
  retourne la liste des catégories d'articles
*/
  $stmt = $connex->prepare("SELECT IdCategorie,NomCategorie FROM CATEGORIES");	// préparation de la requête
  $stmt->execute();				// execution de la requête
  $lire = $stmt->fetchAll(); 			// récupération de la valeur l'élément RETURNING contenu dans $res
  return $lire;	
}
//UTILE
function RechercheCategorieByNom($nomcategorie,$connex) {
/* ------------------------------------------------
recherche dans la table CATEGORIES si nomcategorie existe, retourne les infos de la catégorie
  - 1er paramètre $nomcategorie : contient le nom de la catégorie
  - 2ème paramètre $connex : contient le connecteur de la bdd
  retourne les infos de la catégorie
*/
  $stmt = $connex->prepare("SELECT * FROM CATEGORIES WHERE NomCategorie=:nomcategorie");	// préparation de la requête
  $stmt->bindParam(':nomcategorie', $nomcategorie);		// affectation de la variable $nomcategorie au paramètre :nomcategorie
  $stmt->execute();				// execution de la requête
  $lire = $stmt->fetchAll(); 			// récupération de la valeur l'élément RETURNING contenu dans $res
  return $lire;
}
//UTILE
function RechercheCategorieById($idcategorie,$connex) {
  /* ------------------------------------------------
  recherche dans la table CATEGORIES si idcategorie existe, retourne les infos de la catégorie
    - 1er paramètre $idcategorie : contient l'id de la catégorie
    - 2ème paramètre $connex : contient le connecteur de la bdd
    retourne les infos de la catégorie
  */
    $stmt = $connex->prepare("SELECT * FROM CATEGORIES WHERE IdCategorie=:idcategorie");	// préparation de la requête
    $stmt->bindParam(':idcategorie', $idcategorie);		// affectation de la variable $idcategorie au paramètre :idcategorie
    $stmt->execute();				// execution de la requête
    $lire = $stmt->fetchAll(); 			// récupération de la valeur l'élément RETURNING contenu dans $res
    return $lire;
  }
//UTILE
function SupprimerCatégorie($idcategorie,$connex) {
/* ------------------------------------------------
supprime dans la table CATEGORIES la catégorie dont l'id est idcategorie
  - 1er paramètre $idcategorie : contient l'id de la catégorie
  - 2ème paramètre $connex : contient le connecteur de la bdd
  -retourne le nombre de lignes supprimées
*/
  $stmt = $connex->prepare("DELETE FROM CATEGORIES WHERE IdCategorie=:idcategorie");	// préparation de la requête
  $stmt->bindParam(':idcategorie', $idcategorie);		// affectation de la variable $idcategorie au paramètre :idcategorie
  $stmt->execute();				// execution de la requête
  //vérification que la catégorie a bien été supprimée, retourne true si c'est le cas, false sinon
  if ($stmt->rowCount() == 1) {
    return true;
  } else {
    return false;
  }
  
}
//UTILE
function SupprimerArticle($idarticle,$connex) {
/* ------------------------------------------------
supprime dans la table ARTICLES l'article dont l'id est idarticle
  - 1er paramètre $idarticle : contient l'id de l'article
  - 2ème paramètre $connex : contient le connecteur de la bdd
  retourne le nombre de lignes supprimées
*/
  $stmt = $connex->prepare("DELETE FROM ARTICLES WHERE IdArticle=:idarticle");	// préparation de la requête
  $stmt->bindParam(':idarticle', $idarticle);		// affectation de la variable $idarticle au paramètre :idarticle
  $stmt->execute();				// execution de la requête
  //vérification que l'article a bien été supprimé, retourne true si c'est le cas, false sinon
  if ($stmt->rowCount() == 1) {
    return true;
  } else {
    return false;
  }
}
//UTILE
function UpdateMdp($iduser,$mdp,$connex) {
/* ------------------------------------------------
met à jour dans la table USERS le mot de passe de l'utilisateur dont l'id est iduser
  - 1er paramètre $iduser : contient l'id de l'utilisateur
  - 2ème paramètre $mdp : contient le nouveau mot de passe
  - 3ème paramètre $connex : contient le connecteur de la bdd
  retourne l'id de l'utilisateur
*/
  $stmt = $connex->prepare("UPDATE UTILISATEURS SET MotDePasse=:mdp WHERE IdUtilisateur=:iduser RETURNING IdUtilisateur");	// préparation de la requête
  $stmt->bindParam(':iduser', $iduser);		// affectation de la variable $iduser au paramètre :iduser
  $stmt->bindParam(':mdp', $mdp);		// affectation de la variable $mdp au paramètre :mdp
  $stmt->execute();				// execution de la requête
  $res = $stmt->fetch(); 			// récupération de la valeur l'élément RETURNING contenu dans $res
  return $res['idutilisateur'];
}
//UTILE
function QuantiteArticle($idarticle, $connex) {
  $stmt = $connex->prepare("SELECT quantitearticle FROM ARTICLES WHERE idarticle = :idarticle");
  $stmt->bindParam(":idarticle", $idarticle);
  $stmt->execute();
  $res = $stmt->fetch();
  return $res['quantitearticle'];
}
//UTILE
function modifInfoUtilisateur($iduser,$nom,$prenom,$adresse,$ville,$cp,$pays,$telephone,$email,$connex) {
/* ------------------------------------------------
met à jour dans la table USERS les infos de l'utilisateur dont l'id est iduser
  - 1er paramètre $iduser : contient l'id de l'utilisateur
  - 2ème paramètre $nom : contient le nouveau nom
  - 3ème paramètre $prenom : contient le nouveau prénom
  - 4ème paramètre $adresse : contient la nouvelle adresse
  - 5ème paramètre $ville : contient la nouvelle ville
  - 6ème paramètre $cp : contient le nouveau code postal
  - 7ème paramètre $pays : contient le nouveau pays
  - 8ème paramètre $telephone : contient le nouveau téléphone
  - 9ème paramètre $email : contient le nouvel email
  - 10ème paramètre $connex : contient le connecteur de la bdd
  retourne l'id de l'utilisateur
*/
  $stmt = $connex->prepare("UPDATE UTILISATEURS SET NomUtilisateur=:nom, Prenom=:prenom, Adresse=:adresse, Ville=:ville, CodePostal=:cp, Pays=:pays, Telephone=:telephone, Email=:email WHERE IdUtilisateur=:iduser RETURNING IdUtilisateur");	// préparation de la requête
  $stmt->bindParam(':iduser', $iduser);		// affectation de la variable $iduser au paramètre :iduser
  $stmt->bindParam(':nom', $nom);		// affectation de la variable $nom au paramètre :nom
  $stmt->bindParam(':prenom', $prenom);		// affectation de la variable $prenom au paramètre :prenom
  $stmt->bindParam(':adresse', $adresse);		// affectation de la variable $adresse au paramètre :adresse
  $stmt->bindParam(':ville', $ville);		// affectation de la variable $ville au paramètre :ville
  $stmt->bindParam(':cp', $cp);		// affectation de la variable $cp au paramètre :cp
  $stmt->bindParam(':pays', $pays);		// affectation de la variable $pays au paramètre :pays
  $stmt->bindParam(':telephone', $telephone);		// affectation de la variable $telephone au paramètre :telephone
  $stmt->bindParam(':email', $email);		// affectation de la variable $email au paramètre :email
  $stmt->execute();				// execution de la requête
  $res = $stmt->fetch(); 			// récupération de la valeur l'élément RETURNING contenu dans $res
  return $res['idutilisateur'];
}
function RechercheVendeurById($iduser,$connex) {
/* ------------------------------------------------
recherche dans la table USERS l'utilisateur dont l'id est iduser
  - 1er paramètre $iduser : contient l'id de l'utilisateur
  - 2ème paramètre $connex : contient le connecteur de la bdd
  retourne l'utilisateur
*/
  $stmt = $connex->prepare("SELECT * FROM UTILISATEURS WHERE IdUtilisateur=:iduser");	// préparation de la requête
  $stmt->bindParam(':iduser', $iduser);		// affectation de la variable $iduser au paramètre :iduser
  $stmt->execute();				// execution de la requête
  $res = $stmt->fetch(); 			// récupération de la valeur l'élément RETURNING contenu dans $res
  return $res;
}

function ListeCommandesByacheteur($idacheteur,$connex) {
  /* ------------------------------------------------
  permet de lister les co avec comme parametre d'entree :
    - 1er paramètre $idvendeur : contient l'id du vendeur
    - 2ème paramètre $connex : contient le connecteur de la bdd
    retourne la liste des articles
  */
    $stmt=$connex->prepare("SELECT * FROM COMMANDES WHERE RefAcheteur=:idutilisateur ORDER BY idcommande DESC");
    $stmt->bindParam(':idutilisateur', $idacheteur);
    $stmt->execute();
    $lire = $stmt->fetchALL();
    return $lire;
}

function ModifArticle($idarticle,$nomarticle,$prixarticle,$quantitearticle,$descriptionarticle,$categorie,$connex) {
/* ------------------------------------------------
met à jour dans la table ARTICLES les infos de l'article dont l'id est idarticle
  - 1er paramètre $idarticle : contient l'id de l'article
  - 2ème paramètre $nomarticle : contient le nouveau nom
  - 3ème paramètre $prixarticle : contient le nouveau prénom
  - 4ème paramètre $quantitearticle : contient la nouvelle adresse
  - 5ème paramètre $descriptionarticle : contient la nouvelle ville
  - 6ème paramètre $categorie : contient le nouveau code postal
  - 7ème paramètre $connex : contient le connecteur de la bdd
  retourne l'id de l'article
*/
  $stmt = $connex->prepare("UPDATE ARTICLES SET NomArticle=:nomarticle, PrixArticle=:prixarticle, QuantiteArticle=:quantitearticle, DescriptionArticle=:descriptionarticle, RefCategorie=:categorie  WHERE IdArticle=:idarticle RETURNING IdArticle");	// préparation de la requête
  $stmt->bindParam(':idarticle', $idarticle);		// affectation de la variable $idarticle au paramètre :idarticle
  $stmt->bindParam(':nomarticle', $nomarticle);		// affectation de la variable $nomarticle au paramètre :nomarticle
  $stmt->bindParam(':prixarticle', $prixarticle);		// affectation de la variable $prixarticle au paramètre :prixarticle
  $stmt->bindParam(':quantitearticle', $quantitearticle);		// affectation de la variable $quantitearticle au paramètre :quantitearticle
  $stmt->bindParam(':descriptionarticle', $descriptionarticle);		// affectation de la variable $descriptionarticle au paramètre :descriptionarticle
  $stmt->bindParam(':categorie', $categorie);		// affectation de la variable $categorie au paramètre :categorie
  $stmt->execute();				// execution de la requête
  $res = $stmt->fetch(); 			// récupération de la valeur l'élément RETURNING contenu dans $res
  return $res['idarticle'];
}
function ListeArticlesVendus($idvendeur,$connex) {
  /* ------------------------------------------------
  permet de lister les articles vendus par un vendeur avec comme parametre d'entree :
    - 1er paramètre $idvendeur : contient l'id du vendeur
    - 2ème paramètre $connex : contient le connecteur de la bdd
    retourne la liste des articles
  */
    $stmt=$connex->prepare("SELECT * FROM ARTICLES INNER JOIN CONTENIR ON ARTICLES.IdArticle=CONTENIR.IdRefArticle INNER JOIN COMMANDES  ON COMMANDES.idcommande=CONTENIR.IdRefCommande WHERE RefVendeur=:idvendeur ORDER BY COMMANDES.idcommande DESC");
    $stmt->bindParam(':idvendeur', $idvendeur);
    $stmt->execute();
    $lire = $stmt->fetchALL();
    return $lire;
}
//fonction qui permet a un acheteur de faire une commande en faisant appel a la table COMMANDES et la table CONTENIR
function Commande($idacheteur,$articles,$connex) {
  /* ------------------------------------------------
  permet de faire une commande avec comme parametre d'entree :
    - 1er paramètre $idacheteur : contient l'id de l'acheteur
    - 2ème paramètre $articles : array contenant les id des articles et la quantité
    - 4ème paramètre $connex : contient le connecteur de la bdd
    décrémente la quantité d'article dans la table ARTICLES en faisant appel a la fonction ModifArticle
    retourne la liste des articles
  */
  $message="";
  //initialisation de la variable contenant le nombre d'article contenue dans l'array $articles
  $nbarticle=count($articles);
    //vérification du stock de chaque article avant de créer la commande
    foreach ($articles as $key => $value) {
      //récupération de la quantité d'article
      $stmt=$connex->prepare("SELECT QuantiteArticle FROM ARTICLES WHERE IdArticle=:idarticle");
      $stmt->bindParam(':idarticle', $key);
      $stmt->execute();
      $res = $stmt->fetch();
      $quantite=$res['quantitearticle'];
      //vérification de la quantité d'article
      if ($quantite!=0){
      if ($value>$quantite) {
        $articles[$key]=$quantite;
        $message=$message."L'article ".$key." n'est plus en stock, la quantité a été modifiée à ".$quantite.".";
      }
      }
      else {
        $nbarticle=$nbarticle-1;
        $message=$message."L'article ".$key." n'est plus en stock.";
      }
    }
    if ($nbarticle==0) {
      $message="Aucun article n'est disponible.";
      return $message;
    }
    $stmt=$connex->prepare("INSERT INTO COMMANDES (DateCommande,RefAcheteur) VALUES (NOW(),:idacheteur) RETURNING IdCommande");
    $stmt->bindParam(':idacheteur', $idacheteur);
    $stmt->execute();
    $res = $stmt->fetch();
    $idcommande=$res['idcommande'];

    foreach ($articles as $key => $value) {
      $quantitearticle=$quantite-$value;
      //récupération des informations de l'article
      $article = RechercheArticleById($key,$connex);
      $article=$article[0];
      $nomarticle=$article['nomarticle'];
      $prixarticle=$article['prixarticle'];
      $descriptionarticle=$article['descriptionarticle'];
      $categorie=$article['refcategorie'];
      ModifArticle($key,$nomarticle,$prixarticle,$quantitearticle,$descriptionarticle,$categorie,$connex);
      //insertion dans la table CONTENIR
      $stmt=$connex->prepare("INSERT INTO CONTENIR (idrefcommande,idrefarticle,quantite) VALUES (:idcommande,:idarticle,:quantitearticle)");
      $stmt->bindParam(':idarticle', $key);
      $stmt->bindParam(':idcommande', $idcommande);
      $stmt->bindParam(':quantitearticle', $value);
      $stmt->execute();
    }
    return array($idcommande,$message);
}
//fonction qui permet de lister toutes les commandes
function ListeCommandes($connex) {
  /* ------------------------------------------------
  permet de lister toutes les commandes avec comme parametre d'entree :
    - 1er paramètre $connex : contient le connecteur de la bdd
    retourne la liste des commandes
  */
    $stmt=$connex->prepare("SELECT * FROM COMMANDES ORDER BY idcommande DESC");
    $stmt->execute();
    $lire = $stmt->fetchALL();
    return $lire;
}
function supprimerCommande($idcommande,$connex) {
  /* ------------------------------------------------
  permet de supprimer une commande avec comme parametre d'entree :
    - 1er paramètre $idcommande : contient l'id de la commande
    - 2ème paramètre $connex : contient le connecteur de la bdd
    retourne la liste des commandes
  */
    $stmt=$connex->prepare("DELETE FROM COMMANDES WHERE idcommande=:idcommande");
    $stmt->bindParam(':idcommande', $idcommande);
    $stmt->execute();
}
//liste les utilisateurs et leurs roles*
function ListeUtilisateurs($connex) {
  /* ------------------------------------------------
  permet de lister tous les utilisateurs avec comme parametre d'entree :
    - 1er paramètre $connex : contient le connecteur de la bdd
    retourne la liste des utilisateurs
  */
    $stmt=$connex->prepare("SELECT * FROM UTILISATEURS INNER JOIN ACHETEURS ON idutilisateur=idrefutilisateur ORDER BY idutilisateur DESC");
    $stmt->execute();
    $acheteurs = $stmt->fetchALL();
    $stmt=$connex->prepare("SELECT * FROM UTILISATEURS INNER JOIN VENDEURS ON idutilisateur=idrefutilisateur ORDER BY idutilisateur DESC");
    $stmt->execute();
    $vendeurs = $stmt->fetchALL();
    return array($acheteurs,$vendeurs);
}
function supprimerUtilisateur($idutilisateur,$connex) {
  /* ------------------------------------------------
  permet de supprimer un utilisateur avec comme parametre d'entree :
    - 1er paramètre $idutilisateur : contient l'id de l'utilisateur
    - 2ème paramètre $connex : contient le connecteur de la bdd
    retourne la liste des utilisateurs
  */
    $stmt=$connex->prepare("DELETE FROM UTILISATEURS WHERE idutilisateur=:idutilisateur");
    $stmt->bindParam(':idutilisateur', $idutilisateur);
    $stmt->execute();
}
?>