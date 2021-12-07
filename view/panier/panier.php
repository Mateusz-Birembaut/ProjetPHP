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
                    $boutonSuppr = "<a href=\"?controller=panier&action=supprimerProduitPanier&idProduit=$idURL\"><input class=\"button\" type=\"button\" value=\"Supprimer\" /></a>";
                    $boutonUpdate = "<a href=\"?controller=panier&action=updateQuantite&idProduit=$idURL\"><input class=\"button\" type=\"button\" value=\"Modifier Quantité\" /></a>";

                    echo "<p class=\"articlesPanierInfo\"> $imageP 
                    $nomProduit  |  Quantité : $quantite | Prix à l'unité : $prixProduit.00 €   $boutonUpdate  $boutonSuppr</li>
                        </p>";
                    }
                echo "<p class=\"articlesPanierInfo\"> 
                    Prix Total : $prixTotal.00 €
                    </p>";
            }


                if (isset($_SESSION['connected'])) {
                    if (isset($_SESSION["panier"])){

                        echo "<form class=\"formPanier\" method=\"post\" action=\"index.php\">"
                        ."<input type='hidden' name='action' value=\"viderPanier\">"
                        .'<input type=\'hidden\' name=\'controller\' value="panier">'
                        . "<input class=\"button\" type=\"submit\" value=\"Vider Panier\" />"
                        . "</form>";

                        echo "<form class=\"formPanier\" method=\"post\" action=\"index.php\">"
                        ."<input type='hidden' name='action' value=\"create\">"
                        .'<input type=\'hidden\' name=\'controller\' value="commande">'
                        . "<input class=\"button\" type=\"submit\" value=\"Valider Panier\" />"
                        . "</form>";
                    }else {
                        echo "<p class=\"commandes1\">"
                                ."Panier vide"
                                ."</p>";
                    }


                }else {

                    if (!isset($_SESSION["panier"])){

                    echo "<p class=\"commandes1\">"
                            ."Panier vide"
                            ."</p>";

                    }else {

                        echo "<form class=\"formPanier\" method=\"post\" action=\"index.php\">"
                        ."<input type='hidden' name='action' value=\"viderPanier\">"
                        .'<input type=\'hidden\' name=\'controller\' value="panier">'
                        . "<input class=\"button\" type=\"submit\" value=\"Vider Panier\" />"
                        . "</form>"; 

                        echo "<p class=\"commandes1\">"
                        ."Pour valider votre panier, connectez-vous"
                        ."</p>";

                    }
            }
            if (isset($_SESSION['connected'])) {

                echo "<form class=\"endFormPanier\" method=\"post\" action=\"index.php\">"
                        ."<input type='hidden' name='action' value=\"readAll\">"
                        .'<input type=\'hidden\' name=\'controller\' value="commande">'
                        . "<input class=\"button\" type=\"submit\" value=\"Mes Commandes\" />"
                        . "</form>";
            }
            ?>
       
</section>