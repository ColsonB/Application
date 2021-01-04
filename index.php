<?php

session_start();

 $_SESSION['connexion'] = 0;

 if($_SESSION['connexion'] != 1){
     include("formulaire.php");
 }
else{
    include("inventaire.php");
}


?>