<?php

// Classe qui gère les accès à la base de données
class Bd{

private $connexion;

// Constructeur de la classe
	public function __construct(){
		$chaine="mysql:host=localhost;dbname=E155441H";
		$this->connexion = new PDO($chaine,"root","");
		$this->connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}

  // méthode qui permet de se deconnecter de la base
	public function deconnexion(){
		$this->connexion=null;
	}

	public function verifiMdp($pseudo, $mdp){//verifi si le joueur a rentrée les bonne information
		try{
			$statement = $this->connexion->prepare("SELECT `motDePasse` FROM `joueurs` WHERE `pseudo`=?");//requete
			$statement->bindParam(1, $pseudo);
			$statement->execute();
			$result=$statement->fetch(PDO::FETCH_ASSOC);

			if ($result["motDePasse"]!=NUll){//si il y a un valeur
				return (crypt($mdp, $result["motDePasse"]) == $result["motDePasse"]);//return true si les deux coresponde
			}else{
				return false;
			}
		}catch(PDOException $e){
			$this->deconnexion();
			throw new $exeption("problème avec la table joueur");
		}
	}
  
  public function addPartie($pseudo, $victoire, $nbCoup){//$victoire=0 si perdu et 1 si $victoire
  //ajoute la perti dans la bdd
    try{
	    $statement = $this->connexion->prepare("INSERT INTO `parties` (`pseudo`, `partieGagnee`, `nombreCoups`) VALUES (?,?,?)");
	    $statement->bindParam(1, $pseudo);
		$statement->bindParam(2, $victoire);
		$statement->bindParam(3, $nbCoup);
		$statement->execute();
    }catch(PDOException $e){
		$this->deconnexion();
		throw new $exeption("problème avec la table joueur");
    }
  }
  
	public function statPerso($pseudo){//recupération des stat personel
		try{
			//partie victoire
			$statement = $this->connexion->prepare("SELECT COUNT(*) FROM `parties` WHERE `pseudo` LIKE ? AND `partieGagnee` = 1");
			$statement->bindParam(1, $pseudo);
			$statement->execute();
			$result=$statement->fetch(PDO::FETCH_ASSOC);
			if($result==null){//si pas de résulta alor probème
				throw new $exeption("problème avec la table joueur");
			}
			
			//parti total
			$statement2 = $this->connexion->prepare("SELECT COUNT(*) FROM `parties` WHERE `pseudo` LIKE ?");
			$statement2->bindParam(1, $pseudo);
			$statement2->execute();
			$result2=$statement2->fetch(PDO::FETCH_ASSOC);
			if($result2==null){//si pas de résulta alor probème
				throw new $exeption("problème avec la table joueur");
			}
			
			return array($result["COUNT(*)"],$result2["COUNT(*)"]);
			
		}catch(PDOException $e){
			$this->deconnexion();
			throw new $exeption("problème avec la table joueur");
		}
	}
	
	public function getTop5(){//return le top 5 des partie
		$statement = $this->connexion->prepare("SELECT `pseudo`,`nombreCoups` FROM `parties` WHERE `partieGagnee` = 1 ORDER BY `nombreCoups` ASC LIMIT 0,5");
		$statement->execute();
		$result=$statement->fetchall();
		if($result==null){
			return array();
		}
		return $result;
	}

}
?>
