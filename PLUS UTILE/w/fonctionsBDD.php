<?php

function enregistreClient($nom,$prenom,$connex) {
/* ------------------------------------------------
permet d'enregister le client dans  la bdd (insert)
	paramètres d'entrée
		- 1er paramètre $nom : contient le nom du client
		- 2ème paramètre $connex : contient le connecteur de la bdd
	retourne l'identifiant qui a été choisi par le sgbd lors de l'insertion
*/
  $sql="INSERT INTO CLIENTS (NomClient, prenom) VALUES ('".$nom."','".$prenom."') RETURNING idclient";    // déclaration de la variable appelée $sql.
  $res=$connex->query($sql);				// demande d'execution de la requête sur la base via le connecteur $connex. Le resultat est dans la variable $res au format structuré PDO
  $lire = $res->fetchColumn(); 		// récupération de la valeur l'élément RETURNING contenu dans $res
  return $lire;							// retourne l'identifiant choisi par le sgbd
}

function ListerClients($connex) {
/*--------------------------------
récupère les clients à partir de la base de données
paramètres d'entrées :
	$connex : connecteur de la base de données
retourne la liste des clients
-----------------------------*/
   $sql="SELECT NomClient, idclient FROM CLIENTS ORDER BY NomClient";				// déclaration de la variable appelee $sql.
   $res=$connex->query($sql); 				// execution de la requête. Le resultat est dans la variable $res.
   return $res;								// retourne a l'appelant le resultat.
}

function EnregistreNouvelArticle($leNomArticle,$lePrix,$connex) {
  $sql="INSERT INTO ARTICLES (Designation, PrixVente) VALUES ('".$leNomArticle."','".$lePrix."')";
  $res=$connex->query($sql);
}
function ListeArticles($connex) {
  $sql="SELECT Designation, idarticle FROM ARTICLES ORDER BY Designation";
  $res=$connex->query($sql);
  return $res;
}
function EnregistreNouvelleCommande($laRefClient, $laDate, $connex) {
  $sql="INSERT INTO COMMANDES (datec, refclient) VALUES ('".$laDate."','".$laRefClient."')";
  $res=$connex->query($sql);
}
function ListeCommandes($connex) {
  $sql="SELECT idcommande FROM COMMANDES ORDER BY idcommande";
  $res=$connex->query($sql);
  return $res;
}
function EnregistreContenu($refidcommande, $refarticle, $qtcommande,$connex) {
  $sql="INSERT INTO CONTENIR (IdRefCommande, IdRefArticle, qtecommandee) VALUES ('".$refidcommande."','".$refarticle."','".$qtcommande."')";
  $res=$connex->query($sql);
}
function rechercheArticle($connex,$leprix) {
  // permet de lister les articles dont le prix est supérieur au prix passé en paramètre.
  // parametres d'entrée :
  //	- $connex : le connecteur de la base de données
  //	- $leprix : 
  // retourne le résultat sous forme d'objet PDO
  $sql="SELECT designation, infosuppl,prixvente FROM articles WHERE prixvente > ".$leprix; // déclaration de la variable appelee $sql.
  $res=$connex->query($sql); // execution de la requête. Le resultat est dans la variable $res.
  return $res;								// retourne a l'appelant le resultat.
  }

function rechercheArticlev3($connex,$prix) {
  $stmt = $connex->prepare("SELECT designation, infosuppl,prixvente FROM articles WHERE prixvente > :prix");
  $stmt->bindParam(':prix', $prix);
  $stmt->execute();
  return $stmt;
}

function EnregistreNouvelArticlev2($leNomArticle,$lePrix,$connex) {
  $stmt = $connex->prepare("INSERT INTO ARTICLES (Designation, PrixVente) VALUES (:nom, :prix)");
  $stmt->bindParam(':nom', $leNomArticle);
  $stmt->bindParam(':prix', $lePrix);
  $stmt->execute();
  return $stmt;
}
?>
