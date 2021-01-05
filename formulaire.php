<html>
    
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
                    <center>          
                        <img src="src/img/logo.png" alt="Croix-Rouge française">
                    </center>
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