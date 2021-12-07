<?php
require_once File::build_path(array("config","Conf.php"));

class Model {

	private static $pdo = NULL;

	public static function init(){

		$hostname = Conf::getHostname();
		$database_name = Conf::getDatabase();
		$login = Conf::getLogin();
		$password = Conf::getPassword();

		try{

		self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name",$login,$password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		} catch (PDOException $e) {
  		  if (Conf::getDebug()) {
    		echo $e->getMessage();
  		  } else {
    		echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
  		  }
  		  die();
		}
	}

	public static function getPDO() {
		if (is_null(self::$pdo)) {
			self::init();
		}	
		return self::$pdo;	
	}


   public static function selectAll(){
        try {
        	$table_name = "p_".static::$object;
        	$class_name = "Model".ucfirst(static::$object);
            $pdo = Model::getPDO();
            $rep = $pdo->query("Select * from ".$table_name);
            $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            return $tab = $rep->fetchAll();
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


    public static function select($primary_value) {

    	$table_name = "p_".static::$object;
    	$primary_key = static::$primary;
        $class_name = "Model".ucfirst(static::$object);

        $sql = "SELECT * from ". $table_name ." WHERE ". $primary_key ."= :keyValue ";

        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "keyValue" => $primary_value,            
        );
   
        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);

        $tab = $req_prep->fetchAll();

        if (empty($tab))
            return false;
        return $tab[0];

    }

    public static function delete($primary_value){

    	$table_name = "p_".static::$object;
    	$primary_key = static::$primary;
        $class_name = "Model".ucfirst(static::$object);

        $sql = "DELETE FROM ". $table_name  . " WHERE ". $primary_key . "=:keyValue";

        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "keyValue" => $primary_value,            
        );
        $req_prep->execute($values);
    }

    public static function update($data){
    	$table_name = "p_".static::$object;
    	$primary_key = static::$primary;

        $values = array();

		$sql ="UPDATE $table_name SET ";

		foreach( $data as $champ => $value){
    		if($champ == $primary_key ){
        		$values["primary_key_value"] = $value;
        	}
    		else {
    			$sql = $sql . "$champ=:$champ, "; 
    			$values["$champ"] = $value;
    		}
    	}  
    	$sql = rtrim($sql,", ");  	
 	
		$sql = $sql . ' WHERE '.$primary_key.'=:primary_key_value';

        $req_prep = Model::getPDO()->prepare($sql);

        $req_prep->execute($values);

    }    
    

    public static function save(){

        try{

        	$table_name = "p_".static::$object;
        	$primary_key = static::$primary;

            $values = array();


    		$sql ="INSERT INTO $table_name (";

    		foreach ($_POST as $champ => $value) {
    			if( $champ != "action" && $champ != "controller" && $champ != "idProduit" && $champ != "mdpConfirm"){
        		$sql = $sql . "$champ, "; 
        		$values["$champ"] = $value;
        		}
    		}
    		$sql = rtrim($sql,", ");
        	
        	$sql = $sql . ") VALUES (";
        	
        	foreach ($_POST as $champ => $value) {
        		if( $champ != "action" && $champ != "controller" && $champ != "idProduit" && $champ != "mdpConfirm"){
        		$sql = $sql . ":$champ, "; 
        	    }
    		}
    		$sql = rtrim($sql,", ");
        		
        	$sql = $sql . ")";

        	$req_prep = Model::getPDO()->prepare($sql);


            $req_prep->execute($values);

        } catch(PDOException $e){
            var_dump("eazeazeazeaz");
            var_dump($e->errorInfo[1]);
            if($e->errorInfo[1] == 1062) {
                return false;
            }
        }
    }
    



}

?>