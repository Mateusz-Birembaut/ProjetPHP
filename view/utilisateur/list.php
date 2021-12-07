<?php 

if (!isset($redirection)){
    echo'
    <div class="vide"></div>';
    if( $pagetitle == 'Utilisateur supprimé'){
        echo'
        <div class="texteMaj">
            <p>Utilisateur supprimé</p>
        </div>';
    }
     echo'<div class ="page">';
}

?>

<section class="listUser">
            <p class="userListP"> Utilisateurs : </p>
            <?php
            foreach ($tab_u as $u) {
                $login = $u->get("login");
                $loginAffichage = htmlspecialchars($login);
                $loginURL = rawurlencode($login);
                if (Session::is_user($login)) {

                    echo "<p class=\"userListInfo\">"
                    . "<a class=\"inscription\" href='?controller=utilisateur&action=detail&login=" . $loginURL . "'>". $loginAffichage ."</a><br>"
                    . "<a class=\"inscription\" href='?controller=utilisateur&action=update&login=" . $loginURL . "'>Modifier votre compte</a><br>"
                    . "<a class=\"inscription\" href='?controller=utilisateur&action=delete&login=" . $loginURL . "'>Supprimer votre compte</a>"                            
                    . "</p>";            
                }else {
                    echo "<p class=\"userListInfo\">"
                    . $loginAffichage ."<br>"
                    . "<a class=\"inscription\" href='?controller=utilisateur&action=delete&login=" . $loginURL . "'>Supprimer l'utilisateur</a>"                            
                    . "</p>";  
                }
            }

        ?>
       
</section>