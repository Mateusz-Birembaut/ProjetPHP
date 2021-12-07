

<div class="vide"></div>

	<div class="texteMaj">

<?php 
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
?>

		<?php if(isset($nomProduit)){echo "<p> $nomProduit ajouté au panier.</p>";} ?>




	</div>

    <div class ="page">


			<?php

			$redirection = true;

			require_once File::build_path(array("view","produit","list.php"));  
			?>
