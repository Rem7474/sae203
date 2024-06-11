//formulaire pour demander a l'utilisateur le client dans une liste déroulante
//affichage de commande existante pour le client en question
//ensuite saisie des articles

<?php
require_once 'fonctionsConnexion.php';
require_once 'fonctionsBDD.php';
$conn1=connexionBDD('paramCon.php');
?>
<html>
	<head>
		<title> Formulaire Saisie de commande pour un client </title>
		<meta charset="utf-8"/>
	</head>
	<body>
		<center>
			<h1> Formulaire : Saisie de commande pour un client </h1>
		<form method="GET" action="EnregistreCommandeClient.php">
        &nbsp; <!-- &nbsp; est le code "espace" en html -->
        Client : &nbsp;
        <?php
        $resultat=ListerClients($conn1);
        $resuTab = $resultat->fetchAll();
        print '<select name="P_refCli">';
        foreach ($resuTab as $ligne) {
                print '<option value="'.$ligne["idclient"].'">'.$ligne["nomclient"].'</option>';
        }
        print "</select>";
        ?> 
        
        &nbsp; articles :&nbsp;
        <?php
        $resultat=ListeArticles($conn1);
        $resuTab = $resultat->fetchAll();
        print '<select name="P_refArticle">';
        foreach ($resuTab as $ligne) {
                print '<option value="'.$ligne["idarticle"].'">'.$ligne["designation"].'</option>';
        }
        print "</select>";
        ?>
			&nbsp;
            Quantité commandée <input type="text" size=20 name="P_qt">
            &nbsp;
			<input type="submit" value="Enregistrer"></td>
		</form>
		<center>
		
	</body>
</html>
<?php
deconnexionBDD($conn1); // fermeture de connexion BDD
?>
