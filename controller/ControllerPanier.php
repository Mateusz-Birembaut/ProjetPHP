<?php

require_once File::build_path(array("lib","Security.php"));

require_once File::build_path(array("lib","Session.php"));


class ControllerPanier {

    protected static $object = 'panier';

    public static function panier() {

        $view = 'panier';
        $pagetitle = 'Panier';
        
        require File::build_path(array("view","view.php"));
        
    }

    public static function viderPanier(){

        unset( $_SESSION["panier"]);

        $view = 'panier';
        $pagetitle = 'Panier Vidé';

        require File::build_path(array("view","view.php"));

    }

    public static function supprimerProduitPanier(){

        unset($_SESSION["panier"][$_GET["idProduit"]]);

        if(empty($_SESSION["panier"])){
            unset($_SESSION["panier"]);
        }

        $view = 'panier';
        $pagetitle = 'Panier';
        
        require File::build_path(array("view","view.php")); 

    }

    public static function updateQuantite() {

        if(array_key_exists($_GET["idProduit"],$_SESSION["panier"])){

            $p = ModelProduit::select($_GET["idProduit"]);

            $nomProduit = htmlspecialchars($p->get("nomProduit"));

            $nomImage = htmlspecialchars($p->get("imageProduit"));

            $prix = htmlspecialchars($p->get("prixProduit"));

            $imageP  = "<img class=\"imagePDetail\" src=\"images/produit/".$nomImage."\" alt=\"imageProduit\">";


            $view = 'updateQuantite';
            $pagetitle = 'Panier';
            
            require File::build_path(array("view","view.php")); 
        }else {
            $view = 'panier';
            $pagetitle = 'Panier';
            
            require File::build_path(array("view","view.php")); 
        }
    }

    public static function quantiteUpdated(){
        $tab_idP = ModelProduit::getAllId();



        if(in_array($_POST["idProduit"],$tab_idP)){
            $newquantié = $_POST["newQuantite"];

            if ($newquantié >= 0){

                if($newquantié == 0){

                    ControllerPanier::supprimerProduitPanier();

                }else {

                    $_SESSION["panier"][$_POST["idProduit"]] = $newquantié;

                    $view = 'panier';
                    $pagetitle = 'Panier';
                    
                    require File::build_path(array("view","view.php")); 
                }
            }else {

                $message = "Quantité inférieur a 0";

                $p = ModelProduit::select($_POST["idProduit"]);

                $nomProduit = htmlspecialchars($p->get("nomProduit"));

                $nomImage = htmlspecialchars($p->get("imageProduit"));

                $prix = htmlspecialchars($p->get("prixProduit"));

                $imageP  = "<img class=\"imagePDetail\" src=\"images/produit/".$nomImage."\" alt=\"imageProduit\">";


                $view = 'updateQuantite';
                $pagetitle = 'Panier';
                
                require File::build_path(array("view","view.php")); 

            }
        }else {

            $view = 'panier';
            $pagetitle = 'Panier';
                    
            require File::build_path(array("view","view.php")); 
        }
    }


    public static function ajouterPanier(){

        $tab_p = ModelProduit::selectAll(); 

        $tab_c=ModelProduit::getAllColors();

        $tab_idP = ModelProduit::getAllId();



        if(in_array($_GET["idProduit"],$tab_idP)){

            $view = 'panierAdd';
            $pagetitle = 'Produit ajouté';

            if (isset($_SESSION["panier"])){
                if(isset($_SESSION["panier"][$_GET["idProduit"]])){

                    $_SESSION["panier"][$_GET["idProduit"]] +=1;

                }else {
                $_SESSION["panier"][$_GET["idProduit"]] = 1;
                //array_push($_SESSION["panier"], $_GET["idProduit"]);
                }
            }else {
                $_SESSION["panier"]=array();
                $_SESSION["panier"][$_GET["idProduit"]] = 1;
                //array_push($_SESSION["panier"], $_GET["idProduit"]);
            }

            $produit = ModelProduit::select($_GET["idProduit"]);
            $nomProduit = htmlspecialchars($produit->get("nomProduit"));
            
            require File::build_path(array("view","view.php"));
        }else {

            $view = 'panierAdd';
            $pagetitle = 'Produit inconnu';   

            require File::build_path(array("view","view.php")); 

        }

    }





}









