<?php
require_once File::build_path(array("model", "ModelCommande.php"));

require_once File::build_path(array("lib","Security.php"));

require_once File::build_path(array("lib","Session.php"));

class ControllerCommande {

    protected static $object = "commande";

    public static function readAll() {
        
        $tab_c = ModelCommande::selectAllCommandesUtilisateur(); 
        
        $view = 'list';
        $pagetitle = 'Liste des commandes';
        
        require File::build_path(array("view","view.php"));
    }


    // peut etre faut gérer les cas ou t pas co sinon un mec qui a l'url peut annuler ta commande
    public static function read() {



        $c = ModelCommande::select($_GET["idCommande"]); 

        if (Session::is_user($c->get("p_utilisateur_login"))) {
        
            $tab_d = ModelCommandeDetail::selectAllDetail();
            
            $view = 'detail';
            $pagetitle = 'Detail de la commande '. $_GET["idCommande"] .'';
            
            require File::build_path(array("view","view.php"));
        }else  {

            $view='error';
            $message = "Essaie consulter commande autre utilisateur";
            $pagetitle='Essaie consulter commande autre utilisateur';
            
            require File::build_path(array("view","view.php"));

        }

    }


    public static function create(){

    	$view = 'create';

        $pagetitle = 'Validation Commande';

        $_SESSION["date"] = date("Y-m-d");
        
        require File::build_path(array("view","view.php"));

    }

    public static function created(){

    	ModelCommande::saveCommande();

        $view = 'list';
        $pagetitle = 'Commande terminé';

        $tab_c = ModelCommande::selectAllCommandesUtilisateur(); 

        unset($_SESSION['panier']);
        unset($_SESSION["date"]);

        require File::build_path(array("view","view.php")); 

    }

    public static function delete(){
//modifier le if et faire un get id util dans le model commande pour trouver l'id de l'utilisateur et la comparer avec le session login
        if (Session::is_user($_SESSION['login'])) {

            ModelCommande::delete($_GET['idCommande']);
            $view = 'deleted';
            $pagetitle = 'Commande annulé';
            $tab_c = ModelCommande::selectAllCommandesUtilisateur(); 

            require File::build_path(array("view","view.php")); 
        }else {
            $view='error';
            $message = "Essaie Supprimer commande autre utilisateur";
            $pagetitle='Essaie Supprimer commande autre utilisateur';
            require File::build_path(array("view","view.php"));
        }
    }


    public static function detail(){

        $view = 'facture';

        $pagetitle = 'Facture Commande';
        
        require File::build_path(array("view","view.php"));   
    }

}

