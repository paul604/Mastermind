<?php

require_once __DIR__."/../vue/vueJeu.php";
require_once __DIR__."/../vue/vueFin.php";
require_once __DIR__."/../vue/vueStat.php";
require_once __DIR__."/../modele/jeu.php";
require_once __DIR__."/../modele/bd.php";

// if(!isset($_SESSION)){
    // session_start();
// }

class ControleurJeu{

	private $vueJeu;
	private $vueFin;
	private $vueStat;
	private $bd;
	//private $modeleJeu;

	public function __construct(){
		if(!isset($_SESSION["jeu"]) || $_SESSION["jeu"]==null){
			$modeleJeu= new Jeu();
			$_SESSION["jeu"]=$modeleJeu;
			
			//print_r($_SESSION["jeu"]);
		}
		$this->vueJeu=new VueJeu();
		$this->vueFin=new VueFin();
		$this->vueStat=new VueStat();
		$this->bd=new Bd();
	}
	
	private function toStringPlateau($plateau){
		$plateau2=array(
			array(),//1
			array(),//2
			$plateau[2],
		);

		//transform en string
		for ($i=0; $i <=1; $i++) {
			$j=0;
			foreach ($plateau[$i] as $tab) {
				$plateau2[$i][$j]=array();
				foreach ($tab->get() as $val){
					$plateau2[$i][$j][]=$val;
				}
				$j++;
			}
		}
		return $plateau2;
	}

	public function jeu($tab){
		
		if($tab==null){
			$plateau=$_SESSION["jeu"]->Jeu(null);
		}else{
			if($tab[0]=="requp"){
				$plateau=$_SESSION["jeu"]->requp();
			}else{
				$plateau=$_SESSION["jeu"]->Jeu($tab);
			}
		}
		if(gettype($plateau)== "boolean"){//true => victoire
			$p=$_SESSION["jeu"]->requp();
			$solusion=$_SESSION["jeu"]->getSolution();
			if($plateau){
				$this->vueFin->afficher($this->toStringPlateau($p),$solusion);
				$this->bd->addPartie($_SESSION["pseudo"], 1, $p[2]);
			}else{
				$this->vueFin->afficher($this->toStringPlateau($p),$solusion);
				$this->bd->addPartie($_SESSION["pseudo"], 0, 0);
			}
			//session_destroy();
			$_SESSION["victoire"]=true;
		}else{
			$this->vueJeu->Jeu($this->toStringPlateau($plateau));
		}
	}
	
	public function victoire(){//util pour éviter le bug du F5
		$p=$_SESSION["jeu"]->requp();
		$solusion=$_SESSION["jeu"]->getSolution();
		$this->vueFin->afficher($this->toStringPlateau($p),$solusion);
	}

	
	public function stat(){
		$statPerso=$this->bd->statPerso($_SESSION["pseudo"]);
		$top=$this->bd->getTop5();
		$this->vueStat->afficher($statPerso,$top);
	}
}
?>
