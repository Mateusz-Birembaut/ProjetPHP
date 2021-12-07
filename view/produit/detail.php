<?php 

if (!isset($redirection)){
    echo'
    <div class="vide"></div>

        <div class ="page">';
}
?>

<?php

    $image = htmlspecialchars($p->get("imageProduit"));  
    $titreProduit = htmlspecialchars($p->get("nomProduit"));
    $desc = htmlspecialchars($p->get("descProduit"));
    $prix = htmlspecialchars($p->get("prixProduit"));
    $couleur = htmlspecialchars($p->get("couleurProduit"));

    $idProduitURL = rawurlencode($p->get("idProduit"));

    echo 
    "<div class=\"divLeft\">"
    ."<img class=\"imageDetailProduit\" src=\"images/produit/$image\" alt=\"imageAccueil\">"
    ."</div>"
    ."<div class=\"divRight\">"
    ."<h1 class=\"titreProduit\">". $titreProduit ."</h1>"
    . "<ul class=\"detailProduit\">"
    ."<li class=\"textDetail\">Description du produit : " . $desc . "</li>"
    ."<li class=\"textDetail\">Prix : " . $prix  . " €</li>"
    ."<li class=\"textDetail\">Couleur du produit : " . $couleur . "</li></ul>"     
    . "<div class=\"detailProduit\">"
    . "<a href='?controller=panier&action=ajouterPanier&idProduit=" . $idProduitURL . "'><input class=\"button\" type=\"button\" value=\"Ajouter Au Panier\" /></a></li>";

    if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {

        echo "<a href='?controller=produit&action=update&idProduit=" . $idProduitURL . "'><input class=\"button\" type=\"button\" value=\"Modifier Produit\" /></a></li>"
        . "<a href='?controller=produit&action=delete&idProduit=" . $idProduitURL . "'><input class=\"button\" type=\"button\" value=\"Supprimer Produit\" /></a></li>"
        ."</div>" ;
        
    }
    echo "</div>";
    
?>
