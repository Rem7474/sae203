<?php
	if ((isset($_GET["numero"])) and (isset($_GET["texte"]))){
		$numero = $_GET["numero"];
		$texte = $_GET["texte"];
	}
	else{
		$numero = 0;
		$texte = "texte";
	}
?>

<p>                   
	<strong>
		Rebouclage simple dans le site.
	</strong>
	<br/>
</p>
<div>
	<form method="get" action="rebouclage_simple.php">
		<input type="text" name="numero" value="<?php echo $numero+10; ?>" />
		<input type="texte" name="texte" value="texte" />
		<button type="submit" >Reboucler</button>
</div>
<?php echo $texte; ?>