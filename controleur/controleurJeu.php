<?php

require_once __DIR__."/../vue/vueJeu.php";
require_once __DIR__."/../vue/vueFin.php";
require_once __DIR__."/../vue/vueStat.php";
require_once __DIR__."/../modele/jeu.php";
require_once __DIR__."/../modele/bd.php";

class ControleurJeu{

	private $vueJeu;
	private $vueFin;
	private $vueStat;
	private $bd;

	public function __construct(){
		if(!isset($_SESSION["jeu"]) || $_SESSION["jeu"]==null){
			$modeleJeu= new Jeu();
			$_SESSION["jeu"]=$modeleJeu;
		}
		$this->vueJeu=new VueJeu();
		$this->vueFin=new VueFin();
		$this->vueStat=new VueStat();
		$this->bd=new Bd();
	}
	
	private function toStringPlateau($plateau){
		//permet l'envoi à la vue sans probème
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
		//main
		
		if($tab==null){//création du jeu
			$plateau=$_SESSION["jeu"]->Jeu(null);
		}else{
			if($tab[0]=="requp"){//demande de récupération
				$plateau=$_SESSION["jeu"]->requp();
			}else{
				//coup normale
				$plateau=$_SESSION["jeu"]->Jeu($tab);
			}
		}
		if(gettype($plateau)== "boolean"){//true => victoire
			$p=$_SESSION["jeu"]->requp();
			$solusion=$_SESSION["jeu"]->getSolution();
			//save partie en fonction de victroire ou defaite
			if($plateau){
				$this->bd->addPartie($_SESSION["pseudo"], 1, $p[2]);
			}else{
				$this->bd->addPartie($_SESSION["pseudo"], 0, 0);
			}
			$this->vueFin->afficher($this->toStringPlateau($p),$solusion); //afichage
			$_SESSION["victoire"]=true;//pour informer le routeur que le joueur a fini la pertie
		}else{
			//coup normale
			$this->vueJeu->Jeu($this->toStringPlateau($plateau));
		}
	}
	
	public function victoire(){//utile pour éviter le bug du F5
		$p=$_SESSION["jeu"]->requp();
		$solusion=$_SESSION["jeu"]->getSolution();
		$this->vueFin->afficher($this->toStringPlateau($p),$solusion);
	}

	
	public function stat(){//afichage des stet
		$statPerso=$this->bd->statPerso($_SESSION["pseudo"]);
		$top=$this->bd->getTop5();
		$this->vueStat->afficher($statPerso,$top);
	}
}
?>
