<?php
require_once File::build_path(array("model", "ModelProduit.php"));

require_once File::build_path(array("lib","Security.php"));

require_once File::build_path(array("lib","Session.php"));

class ControllerProduit {

    protected static $object = "produit";

    public static function readAll() {
        if(isset($_GET["couleurProduit"]) || !empty($_GET["couleurProduit"])) {
            
            $tab_c=ModelProduit::getAllColors();
            $couleurFiltre = $_GET["couleurProduit"];

            if (in_array($couleurFiltre, $tab_c)) {

                $tab_p = ModelProduit::getProduitByColor($couleurFiltre);

                $view = 'list';
                $pagetitle = 'Liste de produits';
                
                require File::build_path(array("view","view.php"));
            }else {
                $tab_p = ModelProduit::selectAll(); 

                $message = "Aucun produit de cette couleur";

                $view = 'list';
                $pagetitle = 'Liste de produits';
                
                require File::build_path(array("view","view.php"));
            }

        }else {
            $tab_p = ModelProduit::selectAll(); 
            
            $tab_c=ModelProduit::getAllColors();
            
            $view = 'list';
            $pagetitle = 'Liste de produits';
            
            require File::build_path(array("view","view.php"));
        }
    }



    public static function read() {
            
        $idProduit = $_GET["idProduit"];

        $tab_idP = ModelProduit::getAllId();

        if(in_array($idProduit,$tab_idP)){

            $p = ModelProduit::select($idProduit);  

            $view='detail';
            $pagetitle = 'Détails du produit';
            $controller = 'produit';

            require File::build_path(array("view","view.php"));  //
        }else {
            $view='error';
            $pagetitle = 'produit inconnu';
            $message = "aucun produits avec cet id";

            require File::build_path(array("view","view.php"));  //
        }
        
    }


    public static function ajouterProduit(){
        
        $view='update';
        $pagetitle = "Creation Produit";

        $action = "created";

        $idP = "";
        $nomP = "";
        $descP ="";
        $prixP ="";
        $imageP = "";
        $couleurP = "";
        
        require File::build_path(array("view", "view.php"));
    }

    public static function created(){

        if (Session::is_admin() ) {

            if ( $_POST['prixProduit'] > 0){

                $_POST['couleurProduit'] = ucfirst($_POST["couleurProduit"]);
                
                ModelProduit::save(); 

                $tab_c=ModelProduit::getAllColors();

                $view='created';
                $pagetitle='Produit Crée';

                $tab_p = ModelProduit::selectAll(); 

                require File::build_path(array("view","view.php"));
            }else {

                $message = "Prix inférieur ou égal à 0";
                $view='update';
                $pagetitle = "Creation Produit";

                $action = "created";

                $idP = "";
                $nomP = $_POST['nomProduit'];
                $descP =$_POST['descProduit'];
                $prixP ="";
                $imageP = $_POST['imageProduit'];
                $couleurP = $_POST['couleurProduit'];
                
                require File::build_path(array("view", "view.php"));

            }
              
        } else {
            $view='error';
            $message = "Essaie ajouter un produit";
            $pagetitle='';
            require File::build_path(array("view","view.php")); 
        }
        
    }


    public static function update() {

        if (Session::is_admin() ){

            $inputLogin = "readonly";
            $action = "updated";

            $pIdUpdate = $_GET["idProduit"]; 

            $p = ModelProduit::select($pIdUpdate);

            $idP = htmlspecialchars($p->get("idProduit"));
            $nomP = htmlspecialchars($p->get("nomProduit"));
            $descP = htmlspecialchars($p->get("descProduit"));
            $prixP = htmlspecialchars($p->get("prixProduit"));
            $imageP = htmlspecialchars($p->get("imageProduit"));
            $couleurP = htmlspecialchars($p->get("couleurProduit"));
            
            $view='update';
            $pagetitle='Mise a jour produit';
            require File::build_path(array("view","view.php"));
        
        }else {
            $view='error';
            $message = "Essaie de modifier un produit";
            $pagetitle='';
            require File::build_path(array("view","view.php"));
        }

    }

    public static function updated() {
        if ( Session::is_admin() ){
            if( $_POST["prixProduit"] > 0 ){
                $data = array(
                    "idProduit"=>$_POST["idProduit"],
                    "nomProduit"=>$_POST["nomProduit"],
                    "descProduit"=>$_POST["descProduit"],
                    "prixProduit"=>$_POST["prixProduit"],
                    "imageProduit"=>$_POST["imageProduit"],
                    "couleurProduit"=>ucfirst($_POST["couleurProduit"]),
                );

                ModelProduit::update($data);

                $tab_c=ModelProduit::getAllColors();

                $view='updated';
                $pagetitle='Utilisateur updated';

                $p = ModelProduit::select($_POST["idProduit"]);

                require File::build_path(array("view","view.php")); 
            }else {

                $message = "Prix Inférieur ou égal à 0";

                $inputLogin = "readonly";
                $action = "updated";

                $pIdUpdate = $_POST["idProduit"]; 

                $p = ModelProduit::select($pIdUpdate);

                $idP = htmlspecialchars($_POST["idProduit"]);
                $nomP = htmlspecialchars($_POST["nomProduit"]);
                $descP = htmlspecialchars($_POST["descProduit"]);
                $prixP = "";
                $imageP = htmlspecialchars($_POST["imageProduit"]);
                $couleurP = htmlspecialchars($_POST["couleurProduit"]);
                
                $view='update';
                $pagetitle='Mise a jour produit';
                require File::build_path(array("view","view.php"));
            }

        }else {
            $view='error';
            $message = "Essaie de modifier produit";
            $pagetitle='';
            require File::build_path(array("view","view.php"));
        }
        
    }

    public static function delete() {

        if (Session::is_admin() ){
        
            $pIdDelete = $_GET["idProduit"];

            ModelProduit::delete($pIdDelete);

            unset($_SESSION["panier"][$pIdDelete]);
            if (empty($_SESSION["panier"])){
                unset($_SESSION["panier"]);
            }

            $view='deleted';
            $pagetitle='produit supprimé';

            $tab_c=ModelProduit::getAllColors();

            $tab_p = ModelProduit::selectAll(); 

            require File::build_path(array("view","view.php"));
        
        }else{
            $view='error';
            $message = "Essaie Supprimer produit";
            $pagetitle='';
            require File::build_path(array("view","view.php"));
        }

    }





}

?>