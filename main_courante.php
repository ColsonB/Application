<?php

    session_start();

    try{
        //Appel de la Base De Donnée (BDD)
        $BDD=new PDO('mysql:host=localhost; dbname=tpfinal-cauet-colson; charset=utf8','root','');
    }catch(Exception $e){
        die('Erreur : ' . $e->getMessage());
    }

    function requet_select_main_courante($BDD){
        try {
            //Requête SQL de la fonction select
            $req = "SELECT benevole.Nom, benevole.Prénom, benevole.Nivol, fourniture.idFourniture, fourniture.nomProduit, fourniture.Quantité, main_courante.date FROM `main_courante`, benevole, fourniture
            WHERE
                benevole.Nivol = main_courante.numNivol
            AND
                main_courante.numFourniture = fourniture.idFourniture
            ORDER BY date DESC";
            $RequetStatement=$BDD->query($req);
            ?>
            <!-- Affichage du tableau de donnée -->
                <?php while($Tab=$RequetStatement->fetch()){?>
                    <div class="block">
                        <div class="profil">
                            <?php echo $Tab[0]." ";
                            echo $Tab[1]." ";
                            echo "(".$Tab[2]."), ";
                            echo "le ".$Tab[6];?>
                        </div>
                        <div class="commentaire">
                            <p><?php echo "Modification : ".$Tab[4]." (ID : ".$Tab[3].")";?></p>
                            <p><?php echo "Quantité restante : " .$Tab[5];?></p>
                        </div>
                    </div>
                    <?php
                    }
        }catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

    function requet_insert_main_courante($BDD){
        try {
            $numNivol = $_SESSION['nivol'];
            $numFourniture = $_SESSION['updateId'];
            $req = "INSERT INTO `main_courante`(`numNivol`, `numFourniture`, `date`) VALUES ('$numNivol','$numFourniture', NOW())";
            $RequetStatement=$BDD->query($req);
            echo "<meta http-equiv='refresh' content='0'";
        }catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
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
                    requet_select_main_courante($BDD);
                    
                    if($_SESSION['modifier'] == 1){
                        //Appel de la insert select (Ajouter)
                        requet_insert_main_courante($BDD);
                        $_SESSION['modifier'] = null;
                    }else{
                        $_SESSION['modifier'] = null;
                    }
                ?>
            </div>
        </div>    
    </body>

</html>