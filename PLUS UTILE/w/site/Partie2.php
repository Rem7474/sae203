<div id="Partie2">       <!-- Partie 2 -->
	<div id="Partie2_1">  <!-- Partie 2.1 -->
		Texte libre partie 2_1<BR/>
		Suite texte libre<BR/>
	</div>
    <div id="Partie2_2">  <!-- Partie 2.2 contenenant le menu 'chapitre' cad le 1er niveau de menu-->
        <UL>
		<li><a <?php if ($chapitre_en_cours==0) {
								echo 'id="S_Chap" href=#ancreFictive';
							} else {
								echo 'href=index1.php?chap=0&sec=0';
							}
					?>
					>&nbsp;Menu 0&nbsp;</A></li>

		<li><a <?php if ($chapitre_en_cours==1) {
								echo 'id="S_Chap" href=#ancreFictive';
							} else {
								echo 'href=index1.php?chap=1&sec=0';
							}
					?>
					>&nbsp;Menu 1&nbsp;</A></li>

		<li><a <?php if ($chapitre_en_cours==2) {
								echo 'id="S_Chap" href=#ancreFictive';
							} else {
								echo 'href=index1.php?chap=2&sec=0';
							}
					?>
					>&nbsp;Menu 2&nbsp;</A></li>


        </ul>
    </div>
</div>
<?php include("LigneTexte.htm"); ?>
