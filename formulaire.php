<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accès sécurisé Croix-Rouge française</title>
        <link rel="icon" type="image/png" href="src/img/croix-rouge.png">
        <link rel='stylesheet' type='text/css' href='src/css/formulaire.css'>
    </head>

    <body>
        <section class="container">
            <div class="login">
                <h1>Accès sécurisé Croix-Rouge française</h1>
                <form action="connexion.php" method="POST">    
                    <img src="src/img/logo.png" class="logo" alt="Croix-Rouge française">
                    <?php
                    if(isset($_SESSION['count'])){
                        if($_SESSION['count'] == 0){
                            ?><div class="erreur">Login ou mot de passe invalide</div><?php
                        }
                    }
                    ?>
                    <input type="text" id="login" name="log" placeholder="Votre login" autocomplete="off" autocapitalize="off" required></input>
                    <input type="password" id="mdp" name="pass" placeholder="Votre mot de passe" autocomplete="off" autocapitalize="off" required></input>
                    <p class="submit">
                        <input type="submit" class="credentials_input_submit" value="Ouverture de session"></input>
                    </p>
                </form>
            </div>
        </section>
    </body>
</html>