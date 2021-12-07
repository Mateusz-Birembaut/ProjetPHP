
    <div class="vide"></div>

        <div class ="page">

<section class="panier">
            <p class="userListP"> Vos Articles : </p>

            <?php
            
            if (isset($_SESSION['panier'])) {
                $prixTotal = 0;   
                foreach ($_SESSION['panier'] as $idProduit => $quantite) {
                    $p = ModelProduit::select($idProduit);
                    $idURL=rawurlencode($idProduit);
                    $nomImage = htmlspecialchars($p->get("imageProduit"));
                    $imageP  = "<a href=\"?controller=produit&action=read&idProduit=$idURL\"><img class=\"imagePDetail\" src=\"images/produit/".$nomImage."\" alt=\"imageProduit\"></a>";
                    $nomProduit = htmlspecialchars($p->get("nomProduit"));
                    $prixProduit = htmlspecialchars($p->get("prixProduit"));
                    $prixTotal += $prixProduit*$quantite;
                    echo "<p class=\"articlesPanierInfo\"> $imageP 
                    $nomProduit  |  Quantité : $quantite | Prix à l'unité : $prixProduit.00 €
                        </p>";
                    }
                echo "<p class=\"articlesPanierInfo\"> 
                    Prix Total : $prixTotal.00 €
                    </p>";
            }

            ?>
</section>


 <section class="formulaire">  
    <form method="post" action="index.php">
        <fieldset class="contentFormulaire">
            <?php 
            echo '<input type=\'hidden\' name=\'action\' value=\'created\'>';
            echo '<input type=\'hidden\' name=\'controller\' value="commande">';
            ?>
            <p>
                Validation :
            </p>
            <p>
            <label for="login">Adresse</label> :
            <?php
            echo "<input type='text' value=''  placeholder='Ex : 173 Rue Michel Crépo' name='adresse' id='adresse' required/>"
             ?>
            </p>
               
            <p>
            <input class="button" type="submit" value="Valider" />
            </p>

        </fieldset> 
    </form>