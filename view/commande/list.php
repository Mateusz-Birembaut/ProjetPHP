
<?php 

if (!isset($redirection)){
    echo'
    <div class="vide"></div>

        <div class ="page">';
}
?>

<section class="listCommandes">


        <?php

        if (empty($tab_c)) {
            echo "<p class=\"articlesPanierInfo\"> Aucune commande passée  </p>";
        }else {

            foreach ($tab_c as $c) { 
                $idCommande = htmlspecialchars($c->get("idCommande")); 

                echo "<p class=\"userListP\"> Commande numéro ". $idCommande ." : </p>";

                $idCommandeURL = rawurlencode($c->get("idCommande"));
     
                $dateC = htmlspecialchars($c->get("dateC"));  
                $adresse = htmlspecialchars($c->get("adresse"));
                        echo "<p class=\"articlesPanierInfo\" >Date de création : $dateC</p>"
                        ."<p class=\"articlesPanierInfo\" >Adresse de livraison : $adresse</p>"
                        . "<p class=\"commandesCancel\"><a href=\"?controller=commande&action=read&idCommande=$idCommandeURL\"><input class=\"button\" type=\"button\" value=\"Détail de la commande\"/></a>       "
                        . "<a href=\"?controller=commande&action=delete&idCommande=$idCommandeURL\"><input class=\"button\" type=\"button\" value=\"Annuler la commande\" /></a></p>";               

            }
        }


?>

</section>