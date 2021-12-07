<div class="vide"></div>

	<div class="texteMaj">



<?php 
echo     "<section class=\"filtre\">"
        ."<form class=\"filtreForm\" method=\"get\" action=\"index.php\">"
        ."<select class=\"couleurProduit\" name=\"couleurProduit\" id=\"couleurProduit\">"
        ."<option value=\"\">Choisir Couleur</option></p>";

        foreach ($tab_c as $c){
            $couleur = htmlspecialchars($c);
            echo "<option name=\"couleurProduit\" value=".$couleur.">".$couleur."</option>";
        }

        echo "<input type='hidden' name='action' value=\"readAll\">";
        echo "<input type='hidden' name='controller' value=\"produit\">";
        echo '<input class="button" type="submit" value="Valider" />'; 
        echo "</select></form>";
        echo'</section>';
?>




		<p>Produit supprimé</p>
	</div>
	
    <div class ="page">


			<?php

			$redirection = true;

			require_once File::build_path(array("view","produit","list.php"));
			  
			?>