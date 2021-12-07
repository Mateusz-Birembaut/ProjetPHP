
<?php 

if (!isset($redirection)){
    echo'
    <div class="vide"></div>

        <div class ="page">';
}
?>

<section class="listCommandes">


        <?php

        $idCommande = htmlspecialchars($c->get("idCommande")); 
        $idCommandeURL = rawurlencode($c->get("idCommande"));
        $dateC = htmlspecialchars($c->get("dateC"));  
        $adresse = htmlspecialchars($c->get("adresse"));
        $prixTotal = 0;  

        echo "<p class=\"userListP\"> Commande numéro ". $idCommande ." : </p>";

            foreach ($tab_d as $detail) {

                    $p = ModelProduit::select($detail['produitID']);
                    $nomImage = htmlspecialchars($p->get("imageProduit"));
                    $idURL = rawurlencode($p->get("idProduit"));
                    $imageP  = "<a href=\"?controller=produit&action=read&idProduit=$idURL\"><img class=\"imagePDetail\" src=\"images/produit/".$nomImage."\" alt=\"imageProduit\"></a>";
                    $nomProduit = htmlspecialchars($p->get("nomProduit"));
                    $prixProduit = htmlspecialchars($p->get("prixProduit"));
                    $quantite = $detail["quantite"];
                    $prixTotal += $prixProduit * $quantite;
                    echo "<p class=\"articlesPanierInfo\"> $imageP
                    $nomProduit  |  Quantité : $quantite | Prix : $prixProduit.00 €
                    </p>";
                    
                }

                echo "<p class=\"articlesPanierInfo\"> 
                    Prix Total : $prixTotal.00 €
                    </p>";
            
        echo "<p class=\"articlesPanierInfo\" >Date de création : $dateC</p>"
        ."<p class=\"articlesPanierInfo\" >Adresse de livraison : $adresse</p>"
        . "<p class=\"commandesCancel\"><a href=\"?controller=commande&action=delete&idCommande=$idCommandeURL\"><input class=\"button\" type=\"button\" value=\"Annuler la commande\" /></a><br></p>";

    

?>

</section>