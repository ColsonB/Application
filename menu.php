<?php

    if (session_status() == PHP_SESSION_NONE) {
    session_start();
    }

    $nivol = $_SESSION['nivol'];

    try{
        //Appel de la Base De Donnée (BDD)
        $BDD=new PDO('mysql:host=192.168.64.175; dbname=tpfinal-cauet-colson; charset=utf8','Cauet','Cauet');
    }catch(Exception $e){
        die('Erreur : ' . $e->getMessage());
    }

    //Requête SQL pour afficher le profil de l'utilisatieur dans la barre de menu
    $req = "SELECT benevole.Nom, benevole.Prénom FROM benevole WHERE Nivol = '$nivol'";
    $requetStatement=$BDD->query($req);
?>

<header class="header">
    <a class="titre" href="inventaire.php">
        <img class="logo" src="src/img/croix-rouge.png" width="25" height="25">
        <p class="inventaire">Inventaire</p>
    </a>
    <nav class="navbar-collapse">
        <ul class="navbar-gauche">
            <li>
                <a href="pharmacie.php">Pharmacie</a>
            </li>
            <li>
                <a href="main_courante.php">Main Courante</a>
            </li>
        </ul>
        <ul class="navbar-droite">
            <div class="dropdown">
                <button onclick="profilFunction()" class="dropdown-profil-menu">
                    <i class="fas fa-user"></i>
                    <?php
                        while($Tab=$requetStatement->fetch()){
                            echo $Tab[1]." ".$Tab[0]." ";
                        }
                    ?>
                    <i class="fas fa-caret-down"></i>
                </button>
                <div id="dropdown-profil" class="dropdown-profil">
                    <a href="deconnexion.php">
                        <i class="fas fa-sign-out-alt"></i>
                        Déconnexion
                    </a>
                </div>
            </div>
        </ul>
    </nav>
</header>