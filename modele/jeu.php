<?php

require_once __DIR__."/combinaison.php";

class Jeu{

	private $combine;
	private $plateau;
	private $tourEnCour;
	private $maxtour;
	private $tabVerif;

	public function __construct(){
		$this->tourEnCour=0;
		$this->maxtour=10;
		$this->combine= new Combinaison(0);
		$this->plateau= array();
		$this->tabVerif= array();
		for ($i=0; $i < $this->maxtour; $i++) {
			$this->plateau[$i]=new Combinaison(0);
			$this->tabVerif[$i]=new Combinaison(1);
		}
	}

	public function addCombin($combinaison){
		$this->plateau[$this->tourEnCour]->addAll($combinaison);
	}
	
	public function verifCombin($combinaison){
		$j=0;
		$fait=array();
		//pion bien placer
		for($i=0; $i <4 ; $i++){
			if($combinaison[$i] == $this->combine->getIndice($i)){
				$fait[]=$i;
				$this->tabVerif[tourEnCour]->add($j,-2);
				$j++;
			}
		}
		if($j==4){
			return true;
		}else{
			//pion male placer
			for($i=0; $i <4 ; $i++){
				if(!in_array($i,$fait)){
					for($k=$i+1; $i<4; $i++){
						if(!in_array($k,$fait)){
							if($combinaison[$i] == $this->combine->getIndice($k)){
								$this->tabVerif[tourEnCour]->add($j,-2);
								$j++;
							}
						}
					}
				}
			}
		}
		return false;
	}

	public function jeu($tab){
		if(isset($tab)){
			$this->addCombin($tab);
			if($this->verifCombin($tab)){
				return true;
			}
		}else{
			if ($this->tourEnCour!=0) {
				throw new $exeption("problème avec le jeu");
			}
		}
		$this->tourEnCour++;
		//$this->jeu->jeu($this->plateau[]);
		return array($this->plateau , $this->tabVerif);
		//return $this->plateau;
	}

	public function creerCombin(){
		for($i=0; $i <=4 ; $i++){
			$this->combine->add($i,rand(1,8));
		}
	}
  
	public function creeJeu(){
		$this->creerCombin();
		return $this->jeu(null);
	}

}
?>
