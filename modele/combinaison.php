<?php
class Combinaison{
	private $combine; //tab
	private $minim;
	private $maxi;

	public function __construct($verif){
		$this->combine= array(0,0,0,0);
		if($verif==1){//o=>rien -1=>blan -2=>noir
			$this->minim=-2;
			$this->maxi=0;
		}else if($verif==0){//1 a 8
			$this->minim=1;
			$this->maxi=8;
		}else{
			throw new Exception("problème avec la création de combine");
		}
	}

//$codeCouleur 1 a 8 ou 0 a 2
	public function add($indice, $codeCouleur){
		if($codeCouleur < $this->minim or $codeCouleur>$this->maxi){
			throw new Exception("problème avec l'ajout dans combine");
		}
		$this->combine[$indice]=$codeCouleur;
	}

	public function addAll($array){
		if(count($array)==4){
			for ($i=0; $i < 4; $i++) {
				if($array[$i] < $this->minim or $array[$i]>$this->maxi){
					throw new Exception("problème avec l'ajout dans combine");
				}
				$this->add($i, $array[$i]);
			}
		}else{
			throw new Exception("problème avec l'ajout dans combine");
		}
	}
	
	public function getIndice($indice){
		return $this->combine[$indice];
	}

	public function get(){
		return $this->combine;
	}
}
?>
