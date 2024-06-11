<div id="Partie2"> 		<!-- Partie 2 affichage du menu horizontal (sous partie droite et gauche)-->
	<div id="Partie2_1"> <!-- Partie 2.1 -->
		Texte libre<br />
		Suite texte libre<br />
	</div>
    <div id="Partie2_2"> <!-- Partie 2.2 -->
        <ul>
			<?php
				// On récupère le contenu du fichier dans une chaîne
				$str = file_get_contents("menu.txt");
				// On élimine le premier séparateur de chapitre
				$str = substr($str, 1);
				// Chaque ligne de $tabMenus correspondra à un chapitre (avec ses sections)
				$tabMenus = explode("*", $str);
				// On parcours les chapitres
				for ($i=0; $i<count($tabMenus); $i++)
				{
					// On récupère les informations concernant le chapitre
					$tabMenu = explode("\r\n", rtrim($tabMenus[$i]));
					$tabInfosChap = explode(",", $tabMenu[0]); // on ne s'interesse qu'a ligne [0] qui contient les infos utiles pour l'affichage du chapitre
																				// les autres lignes (relatives aux sections) seront ignorées
					echo "<li><a ";
					if ($i == $chapitre_en_cours)
					{
						echo 'id="S_Chap"';
					}
					echo "href=" . $tabInfosChap[1] . ">" . $tabInfosChap[0] . "</a></li>";
				}
			?>
		</ul>
    </div>
</div>
<?php include("LigneTexte.htm"); ?>