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
            echo "<input type='hidden' name='action' value=". $action .">";
            echo '<input type=\'hidden\' name=\'controller\' value="utilisateur">';
            if ($action == "created"){
                echo "<input type=\"hidden\" name=\"nonce\" value=\"" . Security::generateRandomHex() ."\">";
            }
            ?>
            <p>
                Inscription :
            </p>

            <p>
            <label for="login">Login</label> :
            <?php
            echo "<input ". $inputLogin ."=". $inputLogin ." type='text' value='". $uLogin  ."'  placeholder='Ex : nadirf' name='login' id='login'/>"
             ?>
            </p>
            
            <p>
            <label for="nom">Nom</label> :
            <?php
            echo "<input type='text' value='". $uNom  ."'  placeholder='Ex : Nadir' name='nom' id='nom' required/>";
            ?>
            </p>          
                                            
            <p>
            <label for="prenom">Prénom</label> :
            <?php
            echo "<input type='text' value='". $uPrenom ."' placeholder='Ex : Farfa' name='prenom' id='prenom' required/>";
            ?>
            </p>
            
            <p>
            <label for="email">Email</label> :
            <?php
            echo "<input type='email' value='". $uEmail ."' placeholder='Ex : xd@gmail.com' name='email' id='email' required/>";
            ?>
            </p>
            
            <p>
            <label for="mdp">Mot de passe</label> :
            <?php
            echo "<input type='password' value='". $uPassword ."' placeholder='Ex : xxxxx' name='mdp' id='mdp' required/>";
            ?>
            </p>

            <p>
            <label for="mdp">Confirmation mot de passe</label> :
            <?php
            echo "<input type='password' value='". $uPassword ."' placeholder='Ex : xxxxx' name='mdpConfirm' id='mdpConfirm' required/>";
            ?>
            </p>
            
            <p>
            <input class="button" type="submit" value="Valider" />
            </p>
            
        </fieldset> 
    </form>