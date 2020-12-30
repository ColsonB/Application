<html>
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accès sécurisé Croix-Rouge française</title>
        <link rel="icon" type="image/png" href="src/img/croix-rouge.png">
        <link rel='stylesheet' type='text/css' href='src/css/test.css'>
    </head>

    <body>
        <section class="container">
            <div class="login">
                <h1>Accès sécurisé Croix-Rouge française</h1>
    
                <form action="connexion.php"method="POST">  
                    <center>          
                        <img src="src/img/logo.png" alt="Croix-Rouge française">
                    </center>
                    <input type="text" id="login" name="log" placeholder="Votre login" autocomplete="off" autocapitalize="off" required>
                    <input type="password" id="mdp" name="pass" placeholder="Votre mot de passe" autocomplete="off" autocapitalize="off" required>
                    <p class="submit">
                        <input type="submit" class="credentials_input_submit" value="Ouverture de session">
                        <?php
                        if(isset($_GET['erreur'])){
                            $err = $_GET['erreur'];
                            if($err==1 || $err==2)
                                echo "<p style='color:red'>Login ou mot de passe incorrect</p>";
                        }
                        ?>
                    </p>
                </form>
            
            </div>
        </section>
    <body>
</html>