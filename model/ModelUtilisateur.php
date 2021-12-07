<?php

require_once File::build_path(array("model","Model.php"));

class ModelUtilisateur extends Model{
   
    private $login;
    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $admin;

    protected static $object = 'utilisateur';
    protected static $primary='login';

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
            $this->login = $data['login'];
            $this->nom = $data['nom'];
            $this->prenom = $data['prenom'];
            $this->email = $data['email'];
            $this->mdp = $data['mdp'];
            $this->admin = $data['admin'];
        }
    }

    public static function checkPassword($login,$mot_de_passe_hache){

        $sql = "SELECT * FROM p_utilisateur WHERE p_utilisateur.login=:login AND p_utilisateur.mdp=:mdp";

        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "login"=>$login,
            "mdp"=>$mot_de_passe_hache
        );
        
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
        $util = $req_prep->fetchAll();

        if (empty($util)){
            return false;
        }else {
            return true;
        }

    }

    public static function changeNonce($login, $nonce){

        $sql = "UPDATE p_utilisateur
        SET p_utilisateur.nonce=NULL
        WHERE p_utilisateur.login=:login AND p_utilisateur.nonce=:nonce";

        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "login"=>$login,
            "nonce"=>$nonce,
        );
        
        $req_prep->execute($values);

    }

        public static function searchLogin($login){

            $sql = "select login from p_utilisateur WHERE p_utilisateur.login=:login";

            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "login"=>$login,
            );
            
            $req_prep->execute($values);

            $util = $req_prep->fetchAll();

            if (empty($util)){
                return false;
            }else {
                return true;
            }

        }

}