<?php
    //unset($_POST);
    try{
        $BDD=new PDO('mysql:host=localhost; dbname=tpfinal-cauet-colson; charset=utf8','root','');
    }catch(Exception $e){
        die('Erreur : ' . $e->getMessage());
    }

    function requet_select_pharmacie($BDD){
        try {
            //Requête select avec une barre de recherche
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
                        <tbody>
                            <tr>
                                <td>id-Fourniture</td>
                                <td>nomProduit</td>
                                <td>Quantité</td>
                            </tr>
                            <?php while($Tab=$RequetStatement->fetch()){ ?>
                            <tr>
                                <?php
                                    if(isset($_POST['modifier'])){
                                        foreach($_POST['radio'] as $radio){
                                            if(isset($_POST['radio']) && $Tab[0]==$radio){
                                                echo "<td><input type='hidden' name='updateId' value=".$Tab[0].">".$Tab[0]."</td>";
                                                echo "<td><input type='text' name='updateProduit' value=".$Tab[1]."></td>";
                                                echo "<td><input type='text' name='updateQuantité' value=".$Tab[2]."></td>";
                                                echo "<td><input type='submit' name='updateModifier' value='Modifier'></td>";
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
                                    if(isset($_POST['update'])){
                                        echo "<td><input type='radio' name='radio[]' value=".$Tab[0]."></td>";
                                        echo "<td><input type='submit' name='modifier' value='Modifier'></td>";
                                    }
                                    if(isset($_POST['delete'])){
                                ?>
                                <td><input type="checkbox" name="checkbox[]" value="<?php echo $Tab[0] ?>"></td>
                                <?php
                                    }
                                ?>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <?php
                        if(isset($_POST['delete'])){
                        echo'<input type="submit" name="deleteAll" value="Supprimer les éléments">';
                        }
                    ?>
                </form>
            <?php
                requet_delete_pharmacie($BDD);
        }catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    function requet_insert_pharmacie($BDD){
        try{
            if(isset($_POST['FournitureSubmit'])){
                if(isset($_POST['NomProduit']) && isset($_POST['Quantité'])){
                    $NomProduit = $_POST['NomProduit'];
                    $Quantité = $_POST['Quantité'];
                    $marequete = "INSERT INTO `Fourniture`( `NomProduit`, `Quantité`) VALUES ('".$NomProduit."','".$Quantité."')";
                    $donneeBrute=$BDD->query($marequete);
                    echo "<meta http-equiv='refresh' content='0'";
                }
            }
        }catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

    function requet_delete_pharmacie($BDD){
        try{
            if(isset($_POST['checkbox'])){
                foreach($_POST['checkbox'] as $check){
                    $req = "DELETE FROM `fourniture` WHERE `id-Fourniture`= $check";
                    $RequetStatement = $BDD->query($req);
                    echo "<meta http-equiv='refresh' content='0'>";
                }
            }
        }catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

    if(isset($_POST['updateModifier'])){
        $updateId=$_POST['updateId'];
        $updateProduit=$_POST['updateProduit'];
        $updateQuantité=$_POST['updateQuantité'];
        $req = "UPDATE `fourniture` SET `nomProduit`='$updateProduit', `Quantité`='$updateQuantité' WHERE `id-Fourniture`='$updateId'";
        $RequetStatement = $BDD->query($req);
        echo "<meta http-equiv='refresh' content='0'>";
    }
    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' type='text/css' href='src/css/menu1.css'>
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
                </div>
                <button class="btn btn-primary">Rechercher</button>
            </form>
            <form method="post">
                <input type="submit" name="create" value="Ajouter">
                <input type="submit" name="update" value="Modifier">
                <input type="submit" name="delete" value="Supprimer">
            </form>
            <?php
                if(isset($_POST['create'])){
            ?>
            <div>
                <form method="post" class="form-example">
                    <label for="NomProduit">Nom du Produit: </label>
                    <input type="text" name="NomProduit" id="NomProduit" required>
                    <label for="Quantité">Quantité de Produit: </label>
                    <input type="text" name="Quantité" id="Quantité" required>
                    <input type="submit" name="FournitureSubmit" value="Ajouter le Produit">
                </form>
            <?php
                }
                requet_insert_pharmacie($BDD);
            ?>
            <?php
                requet_select_pharmacie($BDD);
            ?>
            </div>
        </div>
    </body>
</html>