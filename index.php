<?php

session_start();

/* Si le user est connecté on affiche la page "inventaire.php" 
    sinon on affiche la page "formulaire.php" pour se connecter */
 if(isset($_SESSION['connexion'])){
     
    include("inventaire.php");
 }
else{
    include("formulaire.php");
}
?>