
<?php 

if (!isset($redirection)){
    echo'
    <div class="vide"></div>';

    if (isset($message)){
    
        echo "<p>$message</p>";

    }

    echo '<div class ="page">';
}
?>

<section class="formulaire">
        <form method="post" action="index.php">
            <fieldset class="contentFormulaire">
                <input type='hidden' name='action' value='connected'>
                <input type='hidden' name='controller' value='utilisateur'>
                <p>
                    Connexion :
                </p>
                    
                <p>
                    <label for="login">Login</label> :
                    <?php  echo "<input type=\"text\" name=\"login\" id=\"login\"  value=\"$login\" required>";?>
                </p>

                <p>
                    <label for="mdp">Mot de Passe</label> :
                    <input type="password" name="mdp" id="mdp"  required>
                </p>
                
                <p>
                    <input class="button" type="submit" value="Se Connecter" />
                </p>
            </fieldset> 
            <a class="inscription" href="index.php?controller=utilisateur&action=create"><h4>S'inscrire</h4></a>
        </form>
</section>