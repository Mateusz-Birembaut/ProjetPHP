<?php

require_once File::build_path(array("model","ModelCommandeDetail.php"));

require_once File::build_path(array("model","Model.php"));

class ModelCommande extends Model{
   
    private $idCommande;
    private $pUserLogin;
    private $date;
    private $adresse;

    protected static $object = 'commande';
    protected static $primary='idCommande';

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
            $this->idCommande = $data['idCommande'];
            $this->pUserLogin = $data['pUserLogin'];
            $this->date = $data['date'];
            $this->adresse = $data['adresse'];
        }
    }

    public static function saveId(){
        $table_name = "p_".static::$object;
        $primary_key = static::$primary;

        $sql ="INSERT INTO $table_name (p_utilisateur_login, dateC, adresse) 
        VALUES (:p_utilisateur_login, :dateC, :adresse);";


        $values = array(
            "p_utilisateur_login" => $_SESSION["login"],  
            "dateC" => $_SESSION["date"],    
            "adresse" =>$_POST["adresse"],    
        );

        $req_prep = Model::getPDO()->prepare($sql);

        try{

        $req_prep->execute($values);

        $lastId = Model::getPDO()->lastInsertId();

        } catch(PDOException $e){
            if($e->errorInfo[1] == 1062) {
                return false;
            }
        }
        return $lastId ;
    }

    public static function saveCommande() {

        $last_id = ModelCommande::saveId();

        $idDejaPanier = array();  

        foreach ( $_SESSION['panier'] as $produitID => $quantite ) {
                ModelCommandeDetail::saveAllProduit($last_id,$produitID,$quantite);
        }
    }

    public static function selectAllCommandesUtilisateur(){
        try {
            $table_name = "p_".static::$object;
            $class_name = "Model".ucfirst(static::$object);
  

            $sql ="Select * from $table_name where p_utilisateur_login=:login";

            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "login" => $_SESSION["login"],   
            );


            $req_prep->execute($values);

            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);

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