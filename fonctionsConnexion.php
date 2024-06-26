<<<<<<< HEAD
<?php
function connexionBDD($fichierParametre) {
/*---------------------------------------------
Paramètres d'entrées :
 - $fichierParametre :  nom du fichier qui contient les paramètres de connexion
   ce fichier devra définir les variables suivantes :
    $lehost
    $leport
    $dbname
    $leport
------------------------------------------------*/

    include $fichierParametre; // on "inclut" le fichier source contenant du code
    $dsn='pgsql:host='.$lehost.';dbname='.$dbname.';port='.$leport;

    // connexion à la bdd (connexion non persistante)
    try {
        $connex = new PDO($dsn, $user, $pass); // tentative de connexion
        //print "Connecté :)<br />";// si réussite
    } catch (PDOException $e) { // si échec
        print "Erreur de connexion à la base de données ! : " . $e->getMessage();
        die(""); // Arrêt du script - sortie.
    }
    return $connex; // on retourne le connecteur (à l'appelant)
}


function deconnexionBDD($connex) {
/*---------------------------------------------
détruit la connexion
paramètres d'entrée
 - $connex qui est la ressource (connecteur) à la base de données à détruire
------------------------------------------------*/
    $connex = null; // fermeture de la connexion a la base de donnees (même si demande de connexion persistante).
}
?>
=======
<?php
function connexionBDD($fichierParametre) {
/*---------------------------------------------
Paramètres d'entrées :
 - $fichierParametre :  nom du fichier qui contient les paramètres de connexion
   ce fichier devra définir les variables suivantes :
    $lehost
    $leport
    $dbname
    $leport
------------------------------------------------*/

    include $fichierParametre; // on "inclut" le fichier source contenant du code
    $dsn='pgsql:host='.$lehost.';dbname='.$dbname.';port='.$leport;

    // connexion à la bdd (connexion non persistante)
    try {
        $connex = new PDO($dsn, $user, $pass); // tentative de connexion
        //print "Connecté :)<br />";// si réussite
    } catch (PDOException $e) { // si échec
        print "Erreur de connexion à la base de données ! : " . $e->getMessage();
        die(""); // Arrêt du script - sortie.
    }
    return $connex; // on retourne le connecteur (à l'appelant)
}


function deconnexionBDD($connex) {
/*---------------------------------------------
détruit la connexion
paramètres d'entrée
 - $connex qui est la ressource (connecteur) à la base de données à détruire
------------------------------------------------*/
    $connex = null; // fermeture de la connexion a la base de donnees (même si demande de connexion persistante).
}
?>
>>>>>>> 521457ac98f141eec458e34e9992cda7c61fff25
