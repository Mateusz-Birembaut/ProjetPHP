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
            echo "<input type='hidden' name='action' value=\"quantiteUpdated\">";
            echo '<input type=\'hidden\' name=\'controller\' value="panier">';

            if(isset($_GET["idProduit"])){

                echo "<input type='hidden' name='idProduit' value=".rawurldecode($_GET["idProduit"]).">";
            }else {
                echo "<input type='hidden' name='idProduit' value=".rawurldecode($_POST["idProduit"]).">";
            }
            ?>
            <p>
                Mise a jour quantité <?php echo "$nomProduit"; ?> :
            </p>

            <p>
               <?php 

                    echo "$imageP Prix à l'unité : $prix.00 €";

               ?> 
            </p> 

            <label for="newQuantite">Quantité</label> :
            <?php
            if(isset($_GET["idProduit"])){
                echo "<input type='number' value='". htmlspecialchars($_SESSION["panier"][$_GET["idProduit"]]) ."'  placeholder='Ex : 1' name='newQuantite' id='newQuantite' required/>";
            }

            else {
                echo "<input type='number' value='". htmlspecialchars($_SESSION["panier"][$_POST["idProduit"]]) ."'  placeholder='Ex : 1' name='newQuantite' id='newQuantite' required/>";
            }
            ?>
            </p>
            
            
            <p>
            <input class="button" type="submit" value="Valider" />
            </p>
            
        </fieldset> 
    </form>