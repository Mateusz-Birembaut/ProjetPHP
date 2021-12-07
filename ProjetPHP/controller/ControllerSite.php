<?php

class ControllerSite {
    
    protected static $object = "site";


    public static function accueil() {

        $view = "accueil";
        $pagetitle = "Accueil";
        
        require File::build_path(array("view","view.php"));
    }

    public static function propos() {

        $view = "Apropos";
        $pagetitle = "A propos de nous";

        require File::build_path(array("view","view.php"));
    }

    public static function errorRequete() {

        $view = 'error';
        $pagetitle = 'Erreur de Requête';
        $message = "erreur de requete";
        
        require File::build_path(array("view","view.php")); 
    }

        public static function getTotalPanier() {

            $total = 0;
            $idDejaPanier = array();   
            
            if (isset($_SESSION['panier'])) {
                foreach ($_SESSION['panier'] as $quantite){

                    $total += $quantite;

                }
            }      
            else {

            }

            return $total;

    }
}

?>