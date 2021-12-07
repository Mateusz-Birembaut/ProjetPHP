<?php

require_once File::build_path(array("model","Model.php"));

class ModelCommandeDEtail extends Model{
   
    private $commandeID;
    private $produitID;
    private $quantite;

    protected static $object = 'commandedetail';
    protected static $primary='idCommande';
    protected static $primary2 ='produitID';

    // Getter générique
    public function get($nom_attribut) {
        if (property_exists($this, $nom_attribut)) {
            return $this->$nom_attribut;
        }
        return false;
    }

    // Setter générique
    public function set($nom_attribut, $valeur) {
        if (property_exists($this, $nom_attribut)) {
            $this->$nom_attribut = $valeur;
        }
        return false;
    }
      
    // un constructeur
    public function __construct($data = array())  {
        if (!empty($data)){
            $this->commandeID = $data['commandeID'];
            $this->produitID = $data['produitID'];
            $this->quantite = $data['quantite'];
        }
    }

    public static function saveAllProduit($commandeID,$produitID,$quantite){

        $table_name = "p_commande_detail";

        $sql ="INSERT INTO $table_name (commandeID, produitID, quantite) 
        VALUES (:commandeID, :produitID, :quantite)";

        $values = array(
            "commandeID" => $commandeID,  
            "produitID" => $produitID,    
            "quantite" => $quantite,    
        );

        $req_prep = Model::getPDO()->prepare($sql);

        try{

        $req_prep->execute($values);

        } catch(PDOException $e){
            if($e->errorInfo[1] == 1062) {
                return false;
            }
        }

    }

    public static function selectAllDetail(){
        try {
            $class_name = "Model".ucfirst(static::$object);
            $pdo = Model::getPDO();

            $sql = "SELECT produitID,quantite from p_commande_detail WHERE commandeID = :idCommande ";

            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "idCommande" => $_GET['idCommande'],            
            );
       
            $req_prep->execute($values);

            return $tab = $req_prep->fetchAll();

        }

        catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }


}