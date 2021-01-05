<?php
    session_start();

    try{
        //Appel de la Base De Donnée (BDD)
        $BDD=new PDO('mysql:host=192.168.64.175; dbname=tpfinal-cauet-colson; charset=utf8','Cauet','Cauet');
    }catch(Exception $e){
        die('Erreur : ' . $e->getMessage());
    }

    //Fonction select de la page
    function requet_select_pharmacie($BDD){
        try {
            //Requête SQL de la fonction select avec une barre de recherche
            $req = "SELECT * FROM `fourniture`";
            if(isset($_GET['recherche'])){
                $nomProduit = $_GET['recherche']; 
                $req .= " WHERE nomProduit LIKE '$nomProduit%'";
            }
            $RequetStatement=$BDD->query($req);
            ?>
                <!-- Affichage du tableau de donnée -->
                <form method="post">
                    <table>
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Produit</td>
                                <td>Quantité</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($Tab=$RequetStatement->fetch()){ ?>
                            <tr>
                                <?php
                                    //Si on appuie sur le bouton Modifier, on créé un champ pour pouvoir modifier les données
                                    if(isset($_POST['modifier'])){
                                        foreach($_POST['radio'] as $radio){
                                            if(isset($_POST['radio']) && $Tab[0]==$radio){
                                                echo "<td><input type='hidden' name='updateId' value=".$Tab[0].">".$Tab[0]."</td>";
                                                echo "<td><input type='text' name='updateProduit' size='15' value=".$Tab[1]."></td>";
                                                echo "<td><input type='text' name='updateQuantité' size='3' value=".$Tab[2]."></td>";
                                                echo "<td><input type='submit' name='updateModifier' class='update' value='Modifier'></td>";
                                            }else{
                                                echo "<td>".$Tab[0]."</td>";
                                                echo "<td>".$Tab[1]."</td>";
                                                echo "<td>".$Tab[2]."</td>";
                                            }
                                        }
                                    }else{
                                        echo "<td>".$Tab[0]."</td>";
                                        echo "<td>".$Tab[1]."</td>";
                                        echo "<td>".$Tab[2]."</td>";
                                    }
                                    //Si on appuie sur le bouton Supprimer, on créé des radio et boutton Modifier pour selectionner les données à modifier
                                    if(isset($_POST['update'])){
                                        echo "<td><input type='radio' name='radio[]' value=".$Tab[0].">";?>
                                        <input type='submit' name='modifier' class="update" value='Modifier'></td><?php
                                    }
                                    //Si on appuie sur le bouton Supprimer, on créé des checkbox pour selectionner les données à supprimer
                                    if(isset($_POST['delete'])){
                                        ?><td><input type="checkbox" name="checkbox[]" value="<?php echo $Tab[0] ?>"></td><?php
                                    }
                                ?>
                            </tr>
                            <?php
                                }
                            ?>
                            <?php
                                //Si on appuie sur le bouton Supprimer les éléments, on supprime toutes les données cochées par les checkbox
                                if(isset($_POST['delete'])){
                            ?>
                                <tr>
                                    <td colspan="3"></td>
                                    <td><input type="submit" name="deleteAll" class="delete" value="Supprimer"></td>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </form>
            <?php
                //Appel de la fonction update (Modifier)
                requet_update_pharmacie($BDD);
                //Appel de la fonction delete (Supprimer)
                requet_delete_pharmacie($BDD);
        }catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    //Fonction insert de la page
    function requet_insert_pharmacie($BDD){
        try{
            if(isset($_POST['FournitureSubmit'])){
                if(isset($_POST['NomProduit']) && isset($_POST['Quantité'])){
                    $NomProduit = $_POST['NomProduit'];
                    $Quantité = $_POST['Quantité'];
                    //Requête SQL de la fonction insert
                    $req = "INSERT INTO `Fourniture`( `NomProduit`, `Quantité`) VALUES ('".$NomProduit."','".$Quantité."')";
                    $donneeBrute=$BDD->query($req);
                    echo "<meta http-equiv='refresh' content='0'";
                }
            }
        }catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

    //Fonction update de la page
    function requet_update_pharmacie($BDD){
        try{
            if(isset($_POST['updateModifier'])){
                $updateId=$_POST['updateId'];
                $updateProduit=$_POST['updateProduit'];
                $updateQuantité=$_POST['updateQuantité'];
                //Requête SQL de la fonction update
                $req = "UPDATE `fourniture` SET `nomProduit`='$updateProduit', `Quantité`='$updateQuantité' WHERE `idFourniture`='$updateId'";
                $RequetStatement = $BDD->query($req);
                $_SESSION['updateId'] = $updateId;
                $_SESSION['modifier'] = 1;
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

    //Fonction delete de la page
    function requet_delete_pharmacie($BDD){
        try{
            if(isset($_POST['checkbox'])){
                foreach($_POST['checkbox'] as $check){
                    //Requête SQL de la fonction delete
                    $req = "DELETE FROM `fourniture` WHERE `idFourniture`= $check";
                    $RequetStatement = $BDD->query($req);
                    echo "<meta http-equiv='refresh' content='0'>";
                }
            }
        }catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

    //fonction annuler de la page
    function requet_cancel_phermacie(){
        try{
            unset($_POST);
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
        <link rel='stylesheet' type='text/css' href='src/css/menu.css'>
        <link rel='stylesheet' type='text/css' href='src/css/pharmacie.css'>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
        <script type="text/javascript" src="src/js/menu.js"></script>
    </head>
    <body>
        <?php
            include("menu.php");
        ?>
        <div class="back">
            <form method="get">
                <div class="forms-group">
                    <input type="text" class="forms-control" name="recherche" placeholder="Rechercher">
                    <button class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            <form method="post">
                <div class="boutton">
                    <input type="submit" name="create" class="create" value="Ajouter">
                    <input type="submit" name="update" class="update" value="Modifier">
                    <input type="submit" name="delete" class="delete" value="Supprimer">
                    <?php
                        //Si on appuie sur le bouton Ajouter, Modifier ou Supprimer, on créé un bouton Annuler
                        if(isset($_POST['create']) || isset($_POST['update']) || isset($_POST['modifier']) || isset($_POST['delete'])){
                            ?><input type='submit' name='cancel' class='cancel' value='Annuler'><?php
                            if(isset($_POST['cancel'])){
                                //Appel de fonction cancel (Annuler)
                                requet_cancel_pharmacie();
                            }
                        }
                    ?>
                </div>
            </form>
            <?php
                //Si on appuie sur le bouton Ajouter, on créé un formulaire pour ajouter des données
                if(isset($_POST['create'])){
            ?>
            <div class="form-create">
                <form method="post">
                    <input type="text" name="NomProduit" id="NomProduit" placeholder="Nom du Produit" required>
                    <input type="text" name="Quantité" id="Quantité" placeholder="Quantité de Produit" required>
                    <input type="submit" name="FournitureSubmit" class="ajouter" value="Ajouter le Produit">
                </form>
            </div>
            <?php
                }
                //Appel de la fonction insert (Ajouter)
                requet_insert_pharmacie($BDD);
                //Appel de la fonction select (Afficher)
                requet_select_pharmacie($BDD);
            ?>
        </div>
    </body>
</html>