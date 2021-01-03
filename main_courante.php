<?php

    session_start();

    try{
        //Appel de la Base De Donnée (BDD)
        $BDD=new PDO('mysql:host=localhost; dbname=tpfinal-cauet-colson; charset=utf8','root','');
    }catch(Exception $e){
        die('Erreur : ' . $e->getMessage());
    }

    function requet_select_pharmacie($BDD){
        try {
            //Requête SQL de la fonction select
            $req = "SELECT benevole.Nom, benevole.Prénom, benevole.Nivol, fourniture.nomProduit, fourniture.Quantité FROM `main_courante`, benevole, fourniture
            WHERE
                benevole.Nivol = main_courante.numNivol
            AND
                main_courante.numFourniture = fourniture.idFourniture";
            $RequetStatement=$BDD->query($req);
            ?>
            <!-- Affichage du tableau de donnée -->
                <?php while($Tab=$RequetStatement->fetch()){
                        echo $Tab[0]." ";
                        echo $Tab[1]." ";
                        echo $Tab[2];
                        echo " à modifier : " .$Tab[3];
                        echo " et il y en a " .$Tab[4];
                    }
        }catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }
?>

<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' type='text/css' href='src/css/menu1.css'>
        <link rel='stylesheet' type='text/css' href='src/css/main_courante.css'>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
        <script type="text/javascript" src="src/js/menu.js"></script>
    </head>

    <body>
    <?php
        include("menu.php")
    ?>
        <div class="back">
            <div>
                <?php
                    //Appel de la fonction select (Afficher)
                    requet_select_pharmacie($BDD);
                ?>
            </div>
        </div>    
    </body>

</html>