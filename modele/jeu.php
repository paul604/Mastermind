<?php

require_once __DIR__."/combinaison.php";

if(!isset($_SESSION)){
	//démarage session
    session_start();
}

class Jeu{

	private $combine;
	private $plateau;
	private $tourEnCour;
	private $maxtour;
	private $tabVerif;

	public function __construct(){
		$this->tourEnCour=0;
		$this->maxtour=10;
		$this->combine= new Combinaison(0);//combinaison à trouver
		$this->creerCombin();
		$this->plateau= array();
		$this->tabVerif= array();//les pion blanc et noir
		for ($i=0; $i < $this->maxtour; $i++) {//init plateau à zéro
			$this->plateau[$i]=new Combinaison(0);
			$this->tabVerif[$i]=new Combinaison(1);
		}
	}

	public function addCombin($combinaison){//ajouter une combinaison
		$this->plateau[$this->tourEnCour-1]->addAll($combinaison);
	}

	public function verifCombin($combinaison){
		$j=0;//nb pion bien placé
		$fait=array();//tableau des indice de $combinaison où les couleur son bien placer
		$fait2=array();//tableau des indice de $combinaison où les couleur son mal bien placer
		//pion bien placé
		for($i=0; $i <4 ; $i++){//boucle sur la $combinaison proposé
			if($combinaison[$i] == $this->combine->getIndice($i)){
				$fait[]=$i;
				$this->tabVerif[$this->tourEnCour-1]->add($j,-2);
				$j++;
			}
		}
		if($j==4){
			return true;
		}else{
			//pion mal placé
			for($i=0; $i <4 ; $i++){//boucle sur la $combinaison proposé
				if(!in_array($i,$fait)){
					for($k=0; $k<4; $k++){//boucle sur la combinaison a trouver
						if(!in_array($k,$fait) && !in_array($k,$fait2)){
							if($combinaison[$i] == $this->combine->getIndice($k)){
								$fait2[]=$k;
								$this->tabVerif[$this->tourEnCour-1]->add($j,-1);
								$j++;
								$k=8;
							}
						}
					}
				}
			}
		}
		return false;
	}

	public function jeu($tab){//main
		if(isset($tab)){// si $tab est un tableau alor c'est une proposition
			$this->addCombin($tab);//ajou
			if($this->verifCombin($tab)){//test
				return true;//victoire
			}
		}else{//sinon créer le jeux
			if ($this->tourEnCour!=0) {//si créer le jeux et tourEnCour est différent de 0 alor il y a un problème
				throw new Exception("problème avec le jeu");
			}
		}
		$this->tourEnCour=$this->tourEnCour+1;//incrémentation des tour
		if($this->tourEnCour>$this->maxtour){//fail le nombre de coup a dépasser la limite
			$this->tourEnCour=$this->maxtour;//évite des problème d'affichage et de sauvegarde
			return false;
		}else{
			//retourn le plateau, la table de vérification et le tour en cour
			return array($this->plateau , $this->tabVerif, $this->tourEnCour);
		}
	}

	public function creerCombin(){//créer la combinaison à trouver
		for($i=0; $i <=3 ; $i++){
			$this->combine->add($i,rand(1,8));
		}
	}

	public function getSolution(){//getter Solution
		return $this->combine->getall();
	}

	public function requp(){//récupère le plateau, la table de vérification et le tour en cour
		return array($this->plateau , $this->tabVerif, $this->tourEnCour);
	}
}
?>
