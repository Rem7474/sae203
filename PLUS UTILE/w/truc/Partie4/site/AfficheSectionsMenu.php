<div id="Partie3_1"> <!-- Partie 3.1 -->
	<ul>
        <!-- ici ca ce complique, on teste le chapitre et la section  -->
        <?php
        if ($chapitre_en_cours==0) {
            if ($section_en_cours==0) {echo '<li><a id="S_Section" href=#>          Section00 </a><br /></li>';}
                        else {echo '<li><a                 href=index1.php?chap=0&sec=0> Section00 </a><br /></li>';}
            if ($section_en_cours==1) {echo '<li><a id="S_Section" href=#>          Section01 </a><br /></li>';}
                        else {echo '<li><a                 href=index1.php?chap=0&sec=1> Section01 </a><br /></li>';}
            if ($section_en_cours==2) {echo '<li><a id="S_Section" href=#>          Section02 </a><br /></li>';}
                        else {echo '<li><a                 href=index1.php?chap=0&sec=2> Section02 </a><br /></li>';}
            if ($section_en_cours==3) {echo '<li><a id="S_Section" href=#>          Section03 </a><br /></li>';}
                        else {echo '<li><a                 href=index1.php?chap=0&sec=3> Section03 </a><br /></li>';}
            if ($section_en_cours==4) {echo '<li><a id="S_Section" href=#>          Section04 </a><br /></li>';}
                        else {echo '<li><a                 href=index1.php?chap=0&sec=4> Section04 </a><br /></li>';}
        }
        if ($chapitre_en_cours==1) {
            echo '<li><a id="S_Section" href=#>            Section10 </a><br /></li>';
            echo '<li><a                 href="index1.php?chap=1&sec=0"> Section11 </a><br /></li>';
            echo '<li><a                 href="index1.php?chap=1&sec=1"> Section12 </a><br /></li>';
            echo '<li><a                 href="index1.php?chap=1&sec=3"> Section13 </a><br /></li>';
        }
        if ($chapitre_en_cours==2) {
            echo '<li><a id="S_Section" href=#>            Section20 </a><br /></li>';
            echo '<li><a                 href="index1.php?chap=2&sec=0"> Section21 </a><br /></li>';
            echo '<li><a                 href="index1.php?chap=2&sec=1"> Section22 </a><br /></li>';
        }
        ?>
	</ul>
</div>
