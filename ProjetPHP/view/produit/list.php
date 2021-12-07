
<?php 

if (!isset($redirection)){
    echo'
    <div class="vide"></div>

        <div class ="page">';
}
?>


<?php

if (!isset($redirection)) {
    


echo     "<section class=\"filtre\">"
        ."<form class=\"filtreForm\" method=\"get\" action=\"index.php\">"
        ."<select class=\"couleurProduit\" name=\"couleurProduit\" id=\"couleurProduit\">"
        ."<option value=\"\">Choisir Couleur</option>";

        foreach ($tab_c as $c){
            $couleur = htmlspecialchars($c);
            echo "<option value=".$couleur.">".$couleur."</option>";
        }
        echo "</select>";

        echo "<input type='hidden' name='action' value=\"readAll\">"
        . "<input type='hidden' name='controller' value=\"produit\">"
        . '<input class="button" type="submit" value="Valider" />'
        . "</form>"
        . '</section>';

        if (isset($message) && !empty($_GET["couleurProduit"])) {
            echo"
            <div class=\"texteMaj\">
            <p> $message </p>
            </div>";
        }

}
        

if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {

    echo "<a class=\"ButtonAddProduit\" href=\"?controller=produit&action=ajouterProduit\"><input class=\"button\" type=\"button\" value=\"Ajouter un Produit\" /></a>";
}



foreach ($tab_p as $p) { 
    $vidProduitURL = rawurlencode($p->get("idProduit"));
    $image = htmlspecialchars($p->get("imageProduit"));  
    $nom = htmlspecialchars($p->get("nomProduit"));
    $prix = htmlspecialchars($p->get("prixProduit"));
    echo "<div class=\"caseProduit\">" 
            ."<p>$nom</p>"
            ."<p> $prix.00 €</p>"
            . "<a href=\"?controller=produit&action=read&idProduit=$vidProduitURL\"><img class=\"imageProduit\" src=\"images/produit/$image\" alt=\"imageProduit\"></a>"
            . "<a href=\"?controller=panier&action=ajouterPanier&idProduit=$vidProduitURL\"><input class=\"button\" type=\"button\" value=\"Ajouter Au Panier\" /></a>"       
            ."</div>";
}







?>
