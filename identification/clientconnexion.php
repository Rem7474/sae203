<?php session_start();
if(isset($_SESSION['user'])){
    header("Refresh:0,URL=../");
}else{

 ?>

<!DOCTYPE html>
    <html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="./icone.png">
    <link rel="stylesheet" type="text/css" href="./Style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Clients</title>
    </head>
        <body>
            <form action="connexionclient.php" method="post" >
                <h2 class="text-center">Connexion</h2>      
							<label for="identifiant">mail :</label><br>
                            <input type="email" name="pseudoG" class="form-control" placeholder="Email" required="required" autocomplete="off"></br>
                    
							<label for="identifiant">Mot de passe :</label><br>
                            <input type="password" name="mdpG" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off"></br>
                   

                    
                            <button type="submit" name="send" class="btn btn-primary btn-block">Connexion</button></br>
                    
               
            </form> 
        </body>
</html>
<?php 
}
 ?>