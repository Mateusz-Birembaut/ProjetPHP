<?php 

    echo"
    <div class=\"vide\"></div>";

        if (isset($message)){

            echo "<p>$message</p>";

        }

        echo "<div class =\"page\">";

?>

<section class="formulaire">
    <form method="post" action="index.php">
        <fieldset class="contentFormulaire">
            <?php 
            echo "<input type='hidden' name='action'  value=". $action .">";
            echo "<input type='hidden' name='controller' value='produit'>";
            ?>         
            <p>
                Detail du Produit :
            </p>
            
            <p class="attributPasModifiable">
            <label for="idProduit">ID du produit</label> :
            <?php
            echo "<input type='text' value='". $idP ."'  placeholder='Ex : 7' name='idProduit' id='idProduit' />";
            ?>
            </p>
            
            <p>
            <label for="nomProduit">Nom du produit</label> :
            <?php
            echo "<input type='text' value='". $nomP ."'  placeholder='Ex : yeezys' name='nomProduit' id='nomProduit' required/>";
            ?>
            </p>
            
            <p>
            <label for="descProduit">Description du produit</label> :
            <?php
            echo "<input type='text' value='". $descP ."' placeholder='Ex : joli trucs' name='descProduit' id='descProduit' required/>";
            ?>
            </p>
                
            <p>
            <label for="prixProduit">Prix</label> :
            <?php
            echo "<input type='number' value='". $prixP ."' placeholder='Ex : 9' name='prixProduit' id='prixProduit' required/>";
            ?>
            </p>
                
            <p>
            <label for="imageProduit">Image du produit</label> :
            <?php
            echo "<input type='text' value='". $imageP ."' placeholder='Ex :x.jpg' name='imageProduit' id='imageProduit' required/>";
            ?>
            </p>
                
            <p>
            <label for="couleurProduit">Couleur du produit</label> :
            <?php
            echo "<input type='text' value='". $couleurP ."' placeholder='Ex : Jaune' name='couleurProduit' id='couleurProduit' required/>";
            ?>
            </p>
            
            <p>
            <input class="button" type="submit" value="Valider" />
            </p>
        </fieldset> 
    </form>
</section>