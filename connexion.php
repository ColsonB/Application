<?php

session_start();

if(isset($_POST['log']) && isset($_POST['pass']))
{
    $db_username = 'Cauet';
    $db_password = 'Cauet';
    $db_name     = 'tpfinal-cauet-colson';
    $db_host     = '192.168.64.175';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
    
    $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['log'])); 
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['pass']));
    
    if($username !== "" && $password !== "")
    {
        $_SESSION['nivol'] = $_POST['log'];
        $requete = "SELECT count(*) FROM benevole where 
              Nivol = '".$username."' and MDP = '".$password."' ";
        $exec_requete = mysqli_query($db,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0)
        {
           $_SESSION['log'] = $username;
           include("inventaire.php");
        }
        else{
            include("formulaire.php");
        }
    }
}
?>
