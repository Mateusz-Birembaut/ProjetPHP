<?php

require_once File::build_path(array("controller", "ControllerProduit.php"));
require_once File::build_path(array("controller", "ControllerUtilisateur.php"));
require_once File::build_path(array("controller", "ControllerCommande.php"));
require_once File::build_path(array("controller","ControllerSite.php"));
require_once File::build_path(array("controller","ControllerPanier.php"));

$controller = 'produit';


if(isset($_POST["controller"])){

    $controller = $_POST["controller"];

    $controller_class = "Controller" . ucfirst($controller) . "";

    if (!class_exists($controller_class) || !in_array($_POST['action'], get_class_methods($controller_class))) {

        ControllerSite::errorRequete();
        
    } else {
        $action = $_POST['action'];
        $controller_class::$action();
    }

} else if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];

    if (isset($_GET['action'])) {
        $controller_class ="Controller" . ucfirst($controller);
    }
    
    if (!class_exists($controller_class) || !in_array($_GET['action'], get_class_methods($controller_class))) {

        ControllerSite::errorRequete();
        
    } else {
        $action = $_GET['action'];
        $controller_class::$action();
    }
        
} else {
    ControllerSite::accueil();
}



?>