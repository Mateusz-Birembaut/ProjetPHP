
<!DOCTYPE html>
<html lang="fr">
    <head>  
        <meta charset="UTF-8">
        <link rel="stylesheet" href="view/style.css">
        <title><?php echo $pagetitle;?></title>
    </head>
    
    <body>
    <div class="nav_box">
    <header>
    <nav class="nav">
      <div class="divleft">
        <img class="logoimg" src="images/header/logo.png" alt="logo">
        <div>
          <label for="toggle">&#9776;</label>
        </div>
      </div>
      <input type="checkbox" id="toggle" />
      <ul class="menu">
        <li><a href="index.php?controller=site&action=accueil">ACCUEIL</a></li>
        <li><a href="index.php?controller=produit&action=readAll">NOS PRODUITS</a></li>
        <li><a href="index.php?controller=site&action=propos">A PROPOS</a></li>
      </ul>
      <div class="divright">
            <?php 
            if (isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
                echo "Bonjour ".$_SESSION['login'];
                echo "<a href=\"index.php?controller=utilisateur&action=detail\"><img class=\"logoimg\" src=\"images/header/iconeCompt.png\" alt=\"logo\"></a>";                       
            }else {
                echo "<a href=\"index.php?controller=utilisateur&action=connect\"><img class=\"logoimg\" src=\"images/header/iconeCompt.png\" alt=\"logo\"></a>";    
            }
            ?>   
            <?php

            ?>
            <p>
            <a href="index.php?controller=panier&action=panier"><img class="logoimg" src="images/header/iconePanier.png" alt="logo"></a>
            <?php 
            $totalItemPanier = ControllerSite::getTotalPanier();
            if ($totalItemPanier != 0){ echo "$totalItemPanier"; }?>
            </p>

      </div>
    </nav>
    </header>
    </div>

        <?php
            $filepath = File::build_path(array("view", static::$object, "$view.php"));
            require $filepath;
        ?>
            </div> 
            
    <footer>
            <div class="footerContact">
                <h3>Contact</h3>
                <p>55-55-55-55-55</p>
                <p>supportclient@contact.com</p>
                <p>info Covid-19</p>
                <p>info Livraisons</p>
            </div>
            <div class="footerSociete">
                <h3>La Société</h3>
                <p>Politique de Confidentialité & Cookies</p>
                <p>Mentions légales</p>
                <p>178 Rue Michel Crépeau, Montpellier, 34070</p>
            </div>
            <div class="footerMedias">
                <img class="imageFooter" src="images/header/logo.png" alt="icones réseaux sociaux">
                <img class="imageFooter" src="images/header/logo.png" alt="icones réseaux sociaux">
                <img class="imageFooter" src="images/header/logo.png" alt="icones réseaux sociaux">
                <img class="imageFooter" src="images/header/logo.png" alt="icones réseaux sociaux">
                <img class="imageFooter" src="images/header/logo.png" alt="icones réseaux sociaux">
            </div>
      </footer>
   </body>
    

</html>