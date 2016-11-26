<?php

require_once __DIR__."/combinaison.php";

if(!isset($_SESSION)){
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
		$this->combine= new Combinaison(0);
		$this->creerCombin();
		$this->plateau= array();
		$this->tabVerif= array();
		for ($i=0; $i < $this->maxtour; $i++) {
			$this->plateau[$i]=new Combinaison(0);
			$this->tabVerif[$i]=new Combinaison(1);
		}
	}
	
	function __autoload($name){
		require_once __DIR__."/".$name.".php";
	}

	public function addCombin($combinaison){
		$this->plateau[$this->tourEnCour]->addAll($combinaison);
	}

	public function verifCombin($combinaison){
		$j=0;
		$fait=array();
		$fait2=array();
		//pion bien placer
		for($i=0; $i <4 ; $i++){
			if($combinaison[$i] == $this->combine->getIndice($i)){
				$fait[]=$i;
				$this->tabVerif[$this->tourEnCour]->add($j,-2);
				$j++;
			}
		}
		if($j==4){
			return true;
		}else{
			//pion male placer
			for($i=0; $i <4 ; $i++){
				if(!in_array($i,$fait)){
					for($k=0; $i<4; $i++){
						if(!in_array($k,$fait) && !in_array($k,$fait2)){
							if($combinaison[$i] == $this->combine->getIndice($k)){
								$fait2[]=$k;
								$this->tabVerif[$this->tourEnCour]->add($j,-1);
								$j++;
								$k=4;
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
				throw new Exception("probl�me avec le jeu");
			}
		}
		$this->tourEnCour=$this->tourEnCour+1;
		return array($this->plateau , $this->tabVerif, $this->tourEnCour);
	}

	public function creerCombin(){
		for($i=0; $i <=3 ; $i++){
			$this->combine->add($i,rand(1,8));
		}
	}

	/*public function creeJeu(){
		$this->creerCombin();
		return $this->jeu(null);
	}*/

	public function requp(){
		return array($this->plateau , $this->tabVerif, $this->tourEnCour);
	}
}
?>
