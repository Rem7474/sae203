<html>
<head>
  <title>Saisie d'une information</title>
  <meta charset="utf-8"/>
</head>

<body>
	<center>
		Saisie d'une information et vérification du format en HTML5
    <br /><br />

		<form method="post" action="traiteInfo.php">

				 Saisir l'information ici :
					<input type="text" name="P_info" placeholder="Saisir ici le texte" title="hexadécimal attendu" pattern="[0-9A-F]+" required />
		 <button type="submit" >Envoyer le formulaire</button>

		</form>
	</center>
</body>
</html>
