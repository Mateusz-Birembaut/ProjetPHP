<?php
require_once File::build_path(array("model", "ModelUtilisateur.php"));

require_once File::build_path(array("lib","Security.php"));

require_once File::build_path(array("lib","Session.php"));

class ControllerUtilisateur {

	protected static $object = "utilisateur";

	public static function readAll() {
        if( Session::is_admin() ) {


        $tab_u = ModelUtilisateur::selectAll();

        $controller = 'utilisateur';
        $view = 'list';
        $pagetitle = 'Liste des utilisateurs';
        
        require File::build_path(array("view","view.php"));

        }else {

        $view='error';
        $message = "Essaie d'acceder a la liste des utilisateurs sans etre admin";
        $pagetitle='Liste Erreur';
        
        require File::build_path(array("view","view.php")); 

        }
    }

    public static function detail() {

        $u = ModelUtilisateur::select($_SESSION['login']);

        $controller = 'utilisateur';
        $view = 'detail';
        $pagetitle = 'Detail de l\'utilisateur';
        
        require File::build_path(array("view","view.php"));
    }

    public static function connect(){

        $view = 'connect';
        $pagetitle = "Connexion";

        $login = "";
        
        require File::build_path(array("view", "view.php"));
    }

    public static function connected(){

        $mdrHache = Security::hacher($_POST['mdp']);

        if (ModelUtilisateur::checkPassword($_POST["login"],$mdrHache)) {

            $u = ModelUtilisateur::select($_POST['login']);
            
            if ($u->get("nonce") == NULL){

                $_SESSION['login'] = $_POST["login"];
            
                $_SESSION['connected'] = true;

                if ($u->get('admin') == 1){
                    $_SESSION['admin'] = 1;
                }else{
                    $_SESSION['admin'] = 0;
                }
                
                $view='connected';
                $pagetitle='Connecté';
                require File::build_path(array("view","view.php"));

            }else {

                $message = "Email non validé";
                
                $view = 'connect';
                $pagetitle = "Connexion";

                $login = "";
                
                require File::build_path(array("view", "view.php"));

            }

        }else {

            $view = 'connect';
            $pagetitle = "login ou Mdp erroné";

            $login = $_POST["login"];

            $message = "Login/Mot de passe incorrect";
            $pagetitle='Mdp erroné';
            require File::build_path(array("view","view.php"));
        }
    }

    public static function logout(){

        unset($_SESSION['login']);
        unset($_SESSION['admin']);
        unset($_SESSION['connected']);
        unset($_SESSION['panier']);

        $login = "";

        $view = "deconnected";
        $pagetitle='Deconnecté';

        require File::build_path(array("view","view.php"));

    }


    public static function create(){
    	
        $view='update';
        $pagetitle = "Inscription";

        $inputLogin = "required";
        $action = "created";

        if (!isset($uLogin)) {
            $uLogin = "";
            $uEmail = "";
            $uNom = "";
            $uPrenom = "";
            $uPassword = "";
            $uPasswordConfirm = "";
        }
        
        require File::build_path(array("view", "view.php"));
    }

    public static function validate(){

        $login = ltrim($_GET['login'] , "\"");
        $nonce = ltrim($_GET['nonce'] , "\"");

        $loginTrim = trim($login , "\"");
        $nonceTrim = trim($nonce , "\"");

        ModelUtilisateur::changeNonce($loginTrim, $nonceTrim);

        $view='validated';
        $pagetitle='Email validé';

        require File::build_path(array("view","view.php"));

    }

        public static function created(){
    	
        if ($_POST["mdpConfirm"] == $_POST["mdp"] ) {
            if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false){

                $action = "created";
                $inputLogin = "required";

                $uLogin = $_POST["login"];
                $uEmail = $_POST["email"];
                $uNom = $_POST["nom"];
                $uPrenom = $_POST["prenom"];
                $uPassword = $_POST["mdp"];
                $uPasswordConfirm = $_POST["mdp"];

                $view='update';
                $message = "L'email n'est pas valide";
                $pagetitle='Email Invalide';
                require File::build_path(array("view","view.php")); 
            }else {
                $_POST['mdp'] = Security::hacher($_POST['mdp']);
                $errorInsert = ModelUtilisateur::searchLogin($_POST["login"]);

                if($errorInsert == true){

                            $view='update';
                            $pagetitle = "Login déjà utilisé";

                            $inputLogin = "required";
                            $action = "created";

                            $uLogin = "";
                            $uEmail = $_POST["email"];
                            $uNom = $_POST["nom"];
                            $uPrenom = $_POST["prenom"];
                            $uPassword = "";
                            $uPasswordConfirm = "";

                            $message = "Login déjà utilisé";
        
                            require File::build_path(array("view", "view.php"));
                }else {


                ModelUtilisateur::save(); 

                $login = $_POST["login"];
                $view='created';
                $pagetitle='Utilisateur Crée';

                mail($_POST['email'], 
                    "Validation Email",
                    'Ouvrez ce lien pour valider votre email : https://webinfo.iutmontp.univ-montp2.fr/~birembautm/ProjetPHP/index.php?controller=utilisateur&action=validate&login="'.rawurlencode($_POST['login']).'"&nonce="'.rawurlencode($_POST['nonce']).'');

                require File::build_path(array("view","view.php"));
                } 
            } 
        } else {

            $action = "created";
            $inputLogin = "required";

            $uLogin = $_POST["login"];
            $uEmail = $_POST["email"];
            $uNom = $_POST["nom"];
            $uPrenom = $_POST["prenom"];
            $uPassword = "";
            $uPasswordConfirm = "";

            $view='update';
            $message = "Mots de passes différents lors de l'Inscription";
            $pagetitle='Utilisateur erreur mdp';
            require File::build_path(array("view","view.php")); 
        }
    }

    public static function update() {

        if (Session::is_user($_GET["login"]) ){

            $inputLogin = "readonly";
            $action = "updated";

            $uLoginUpdate = $_GET["login"]; 

            $u = ModelUtilisateur::select($uLoginUpdate);

            $uNomUpdate = $u->get("nom");      
            $uPrenomUpdate = $u->get("prenom");
            $uPasswordUpdate = $u->get("mdp");
            $uEmailUpdate = $u->get("email");
            
            if(Session::is_admin()){
                $uAdmin = $u->get("admin");
            }

            $uLogin = htmlspecialchars($uLoginUpdate);
            $uEmail = htmlspecialchars($uEmailUpdate);
            $uNom = htmlspecialchars($uNomUpdate);
            $uPrenom = htmlspecialchars($uPrenomUpdate);
            $uPassword = "";
            
            $view='update';
            $pagetitle='Mise a jour utilisateur';
            require File::build_path(array("view","view.php"));
        
        }else {
            $view='error';
            $message = "Essaie de modifier un autre utilisateur";
            $pagetitle='error';
            require File::build_path(array("view","view.php"));
        }

    }

    public static function updated() {
        if (Session::is_user($_POST["login"]) || Session::is_admin() ){
            if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false){

                $inputLogin = "readonly";
                $action = "updated";

                $uLogin = $_POST["login"];
                $uEmail = $_POST["email"];
                $uNom = $_POST["nom"];
                $uPrenom = $_POST["prenom"];
                $uPassword = $_POST["mdp"];
                $uPasswordConfirm = $_POST["mdp"];

                $view='update';
                $message = "L'email n'est pas valide";
                $pagetitle='Email Invalide';

                require File::build_path(array("view","view.php")); 
            }
            else {
                if ($_POST["mdpConfirm"] == $_POST["mdp"] && ModelUtilisateur::checkPassword($_POST["login"],Security::hacher($_POST['mdp']))) {

                    $data = array(
                        "login"=>$_POST["login"],
                        "email"=>$_POST["email"],
                        "nom"=>$_POST["nom"],
                        "prenom"=>$_POST["prenom"],
                        "mdp"=>Security::hacher($_POST['mdp']),
                        "admin"=>$_SESSION["admin"],
                    );

                    ModelUtilisateur::update($data);

                    $view='updated';
                    $pagetitle='Utilisateur updated';

                    $u = ModelUtilisateur::select($_POST["login"]);

                    require File::build_path(array("view","view.php"));  

                }else {

                    $inputLogin = "readonly";
                    $action = "updated";

                    $uLogin = $_POST["login"];
                    $uEmail = $_POST["email"];
                    $uNom = $_POST["nom"];
                    $uPrenom = $_POST["prenom"];
                    $uPassword = "";
                    $uPasswordConfirm = "";

                    $view='update';
                    $message = "Mots de passes différents lors de la mise a jour";
                    $pagetitle='Mdp différents';
                    
                    require File::build_path(array("view","view.php")); 
                }
            }
        }
        else {
            $view='error';
            $message = "Essaie Modification autre Utilisateur";
            $pagetitle='Utilisateur erreur mdp';
            require File::build_path(array("view","view.php"));
        }
    }


    public static function delete() {

        if (Session::is_user($_GET["login"]) || Session::is_admin() ){
        
            if($_SESSION["login"] != $_GET["login"]){

                $uLoginDelete = $_GET["login"];

                ModelUtilisateur::delete($uLoginDelete);

                $view='list';
                $pagetitle='Utilisateur supprimé';

                $tab_u = ModelUtilisateur::selectAll();

                require File::build_path(array("view","view.php"));

            }else {



            $uLoginDelete = $_GET["login"];

            unset($_SESSION['login']);
            unset($_SESSION['admin']);
            unset($_SESSION['connected']);
            unset($_SESSION['panier']);

            ModelUtilisateur::delete($uLoginDelete);

            $view='deleted';
            $pagetitle='Utilisateur supprimé';

            require File::build_path(array("view","view.php"));
            }
        
        }else{
            $view='error';
            $message = "Essaie Supprimer autre Utilisateur";
            $pagetitle='Utilisateur erreur mdp';
            require File::build_path(array("view","view.php"));
        }
    }


}


?>