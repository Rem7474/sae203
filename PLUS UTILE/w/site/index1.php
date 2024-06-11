<?php
//CORRECTION pour site reboucle sur la page index
	if (isset($_GET['chap'])) {
		$chapitre_en_cours=$_GET['chap']; // le chapitre est defini
	} else {
		$chapitre_en_cours=0;	// chapitre par defaut (0)
	}

	if (isset($_GET['sec'])) {
		$section_en_cours=$_GET['sec']; // la section est definie
	} else {
		$section_en_cours=0;	// section par defaut (0)
	}

// c'est dans les urls qu'il faudra dire quels couples (chap, section) on souhaite
// ex d'url de destination a mettre : index.php?chap=2&sec=0


// PARTIE 1 (+entete) -------------------------------------------------------------------------------------------
    include("HautDePage.php"); //entête de la page html + partie 1
// PARTIE 2 -----------------------------------------------------------------------------------------------------
    include("Partie2.php"); //partie 2 (qui contient notamment la presentation - partie2_1 - et le menu 'chapitre' cad le 1er niveau de menu)
	//include("Partie2Fichier.php"); //partie 2 avec les menus dans un fichier
	//include("Partie2BDD.php"); //partie 2 avec les menus dans  la bdd
// PARTIE 3 -----------------------------------------------------------------------------------------------------
?>
<div id="Partie3">   <!-- Partie 3 affichage du corps de page (les 2 colonnes) -->
    <?php
	// partie 3_1-------------------------------------------------------------------------------------------
		//include("AfficheSectionsMenu0.php"); // affichage du menu du chapitre 0
		include("AfficheSectionsMenu.php"); // affichage du menu avec gestion des sections encadrees.
		//include("AfficheSectionsMenuFichier.php"); // affichage du menu avec gestion des sections encadrees. Lecture dans un fichier
		//include("AfficheSectionsMenuBDD.php")


		//include("LigneTexte.htm");
		// pour l'instant remplace temporairement par les lignes ci-dessous
	?>
	<!-- contenu de  include("LigneTexte.htm"); -->
	<div id="ModeTexteSeul">  <!-- Affichage en mode textuel - cad si pas css -->
			<hr />   <!-- ligne de fractionnement-->
		</div>
		<!-- fin contenu de  include("LigneTexte.htm"); -->

    <!-- partie 3_2-----------------------------------------------------------------------------------
    ---- Debut du contenu propre a la page courante  qui est presente dans la partie 3.2---------------
    --------------------------------------------------------------------------------------->
	<div id="Partie3_2"> <!-- Partie 3.2 -->
	<?php // gestion de l'affichage propre à la page en cours
		switch ($chapitre_en_cours)  {
			case 0 :
				switch ($section_en_cours)  {
					case 0 :
						include ("nomFichierPartie0_0.php"); // il s'agit de la patie 3 qui est propre a (section,chapitre) en cours
						break;
					case 1 :
						include ("nomFichierPartie0_1.php");
						break;
				}
				break;
			case 1 :
				switch ($section_en_cours)  {
					case 0 :
						include ("nomFichierPartie1_0.php"); // il s'agit de la patie 3 qui est propre a (section,chapitre) en cours
						break;
					case 1 :
						include ("nomFichierPartie1_1.php");
						break;
				}
				break;
			case 2 :
				switch ($section_en_cours)  {
					case 0 :
						include ("rebouclage_simple.php"); // il s'agit de la patie 3 qui est propre a (section,chapitre) en cours
						break;
					case 1 :
						include ("nomFichierPartie2_1.php");
						break;
				}
				break;
			default: include ("nomFichierPartie0_0.php"); // au cas ou. Normalement on ne passe pas ici
		}

	?>
    </div>

    <!-------------------------------------------------------------------------------------
    ---- Fin du contenu de la page courante -----------------------------------------------
    --------------------------------------------------------------------------------------->
	<?php
// PARTIE 4 -----------------------------------------------------------------------------------------------------
	include("LigneTexte.htm"); ?>
</div>

<?php include("BasDePage.php"); ?>
