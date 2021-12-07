<?php 

if (!isset($redirection)){
    echo'
    <div class="vide"></div>

        <div class ="page">';
}
?>

<?php 

    $login = htmlspecialchars($u->get('login'));
    $prenom = htmlspecialchars($u->get('prenom'));
    $nom = htmlspecialchars($u->get('nom'));
    $email = htmlspecialchars($u->get('email'));

    $loginURL = rawurlencode($u->get('login'));


    echo "<section class=\"formulaire\">"
        ."<fieldset class=\"contentFormulaire\">"   
            ."<p>"
                ."Informations de votre compte :"
            ."</p>"
            
            ."<p>"
            ."Login : ". $login       
            ."</p>"
                
            ."<p>"
            ."Prenom : ". $prenom     
            ."</p>"
                
            ."<p>"
            ."Nom : ". $nom         
            ."</p>"
                
            ."<p>"
            ."Email : ". $email 
            ."</p>"    
        
        ."</fieldset> "

            ."<p class=\"listUserAction\">"
            ."<a class=\"inscription\" href=\"?controller=utilisateur&action=logout\">Se Déconnecter</a>"            
            ."</p>";

            if( $u->get('admin') == 1){
                echo "<p class=\"listUserAction\">"
                ."<a class=\"inscription\" href=\"?controller=utilisateur&action=readAll\">Gérer les utilisateurs</a>"            
                ."</p>";
            }
            echo "<p class=\"listUserAction\">"
             ."<a class=\"inscription\" href='?controller=utilisateur&action=update&login=" . $loginURL . "'>Modifier vos paramètres</a>"
            ."</p>"
                
            ."<p class=\"listUserAction\">"
            ."<a class=\"inscription\" href='?controller=utilisateur&action=delete&login=" . $loginURL . "'>Supprimer votre compte</a>"            
            ."</p>"
         ."</section>";
?>