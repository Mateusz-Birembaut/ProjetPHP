<?php
require_once File::build_path(array("model","Model.php"));
  
class ModelProduit extends Model {
    private $idProduit;
    private $nomProduit;
    private $descProduit;
    private $prixProduit;
    private $imageProduit;
    private $couleurProduit;

    protected static $object = 'produit';
    protected static $primary='idProduit';
    
    public function get($nom_attribut) {
        if (property_exists($this, $nom_attribut)) {
            return $this->$nom_attribut;
        }
        return false;
    }

    public function set($nom_attribut, $valeur) {
        if (property_exists($this, $nom_attribut)) {
            $this->$nom_attribut = $valeur;
        }
        return false;
    }
    
    public function __construct($data = array()) {
        if (!empty($data)) {
            $this->idProduit = $data['idProduit'];
            $this->nomProduit = $data['nomProduit'];
            $this->descProduit = $data['descProduit'];
            $this->prix = $date['prix'];
            $this->imageProduit = $data['imageProduit'];
            $this->couleurProduit = $data['couleurProduit'];
        }
    }


    public static function getAllColors(){

        $sql = "SELECT DISTINCT couleurProduit FROM p_produit";

        $req_prep = Model::getPDO()->prepare($sql);

        $req_prep->execute();
        
        $array = $req_prep->fetchAll(PDO::FETCH_COLUMN);

        if (empty($array))
            return false;
        return $array;

    }


   public static function getProduitByColor($couleurFiltre){
        try {
            $table_name = "p_".static::$object;
            $class_name = "Model".ucfirst(static::$object);


            $sql = "Select * from $table_name Where couleurProduit=:couleurP";

            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "couleurP" => $couleurFiltre,   
            );

            $req_prep->execute($values);

            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);

            return $tab = $req_prep->fetchAll();

        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function getAllId(){

        $sql = "SELECT DISTINCT idProduit FROM p_produit";

        $req_prep = Model::getPDO()->prepare($sql);

        $req_prep->execute();
        
        $array = $req_prep->fetchAll(PDO::FETCH_COLUMN);

        if (empty($array))
            return false;
        return $array;
    }

}

?>