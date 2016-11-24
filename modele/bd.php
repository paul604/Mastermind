<?php

require_once 'exeptionBd.php';

// Classe qui gère les accès à la base de données
class Bd{

private $connexion;

	private $exeption;

// Constructeur de la classe
	public function __construct(){
		//try{
			$chaine="mysql:host=localhost;dbname=E155441H";
			$this->connexion = new PDO($chaine,"root","");
			$this->connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		/*}catch(PDOException $e){
			echo "bd";
			$this->exeption = new ExceptionBd("problème de connection à la base");
			echo "bd";
			throw $exeption;
		}*/
	}

  // méthode qui permet de se deconnecter de la base
	public function deconnexion(){
		$this->connexion=null;
	}

  public function verifiMdp($pseudo, $mdp){
    try{
	    $statement = $this->connexion->prepare("SELECT `motDePasse` FROM `joueurs` WHERE `pseudo`=?");
	    $statement->bindParam(1, $pseudo);
  	  $statement->execute();
      $result=$statement->fetch(PDO::FETCH_ASSOC);

      if ($result["motDePasse"]!=NUll){
        if (crypt($pseudo, $result["motDePasse"])== $result["motDePasse"]) {
          return true;
        }
  	    return false;
	    }else{
	      return false;
      }
    }catch(PDOException $e){
      $this->deconnexion();
      throw new $exeption("problème avec la table joueur");
    }
  }

}
?>
