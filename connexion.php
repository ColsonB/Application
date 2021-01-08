<?php

session_start();

try{
    //Appel de la Base De Donnée (BDD)
    $BDD=new PDO('mysql:host=192.168.64.175; dbname=tpfinal-cauet-colson; charset=utf8','Cauet','Cauet');
}catch(Exception $e){
    die('Erreur : ' . $e->getMessage());
}

/* Si on a replie le formulaire avec le login et le mdp on envoie une requete à la bdd
    pour tester si le user existe */
if(isset($_POST['log']) && isset($_POST['pass'])){
    $username = $_POST['log'];
    $password = $_POST['pass'];
    $_SESSION['nivol'] = $username;
    
    $req = "SELECT count(*) FROM benevole where 
            Nivol = '".$username."' and MDP = '".$password."' ";
    $RequetStatement=$BDD->query($req);
    $count=$RequetStatement->fetchColumn();

    /* Si il existe un user avec un login et un mdp correct alors il va sur la page "inventaire.php"
        sinon il reste sur la page de "formulaire.php" */
    $_SESSION['count'] = $count;
    if($count!=0)
    {
        $_SESSION['log'] = $username;
        include("inventaire.php");
    }
    else{
        include("formulaire.php");
    }
}else{
    include("formulaire.php");
}
?>
