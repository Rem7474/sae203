<?php
function filtreEntier ($entree) {
    //$entree est par défaut une chaine de caractères - issue de $_GET ou $_POST, etc...

// etape préalable 1 : traitement chaine mal formatée
//-------------------
    $entree=pg_escape_string($entree); // protège l'accès à la base de chaines mal formatées. (Utilise la dernière connexion ouverte)

// etape préalable 2 : limitation de la longueur de la chaine d'entree
//-------------------
    $a=0;
    $b=9;
    //limitation de la longueur de la variable (chaine) recue
    $entree=substr($entree, $a, $b); // démarre au $a ieme caractere sur b caractères

// filtrage du type
//-------------------
    settype($entree,"float");

    return $entree; // retourne le résultat
}

function filtreTexte ($entree) {
    $entree=pg_escape_string($entree);
    $a=0;
    $b=15;
    //limitation de la longueur de la variable (chaine) recue
    $entree=substr($entree, $a, $b);
    return $entree;
}
/****************************************************************************
                         afficheTableau

Permet d'afficher le résultat dde N'IMPORTE QUELLE REQUETE traitee par fetchall

Elle affiche le nom des colonnes du tableau et leur contenu
*****************************************************************************/
function afficheTableau($resultat) {
     $affTitre=0;
    foreach ($resultat as $ligne) { // pour chaque ligne du tableau globale 2D (une ligne est vue comme un tableau 1D)
        echo "<tr>";
        $i=0;
        if ($affTitre==0) {//traitement de la ligne de nom de colonnes
            $affTitre=1;
            foreach ($ligne as $cle=>$valeur) {
                if (($i % 2)==0) { echo '<td>'.$cle.'</td>';  }
                $i++;
            }
            echo "</tr></tr>";
        }
        $i=0;
        foreach ($ligne as $cle=>$valeur) {
            if (($i % 2)==0) { echo '<td>'.$valeur.'</td>';  }
            $i++;
        }
        echo "</tr>";
    }
}

?>
