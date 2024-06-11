<?php
$texteIn="Ceci est un texte avec un [b]mot important[/b] à l'interieur de celui-ci";
$texteOut = preg_replace('#\[b\](.+)\[/b\]#i', '<strong>$1</strong>', $texteIn);
print $texteOut;
?>