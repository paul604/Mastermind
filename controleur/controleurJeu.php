<?php

require_once __DIR__."/../vue/vueJeu.php";
require_once __DIR__."/../modele/jeu.php";

class ControleurJeu{

	private $vueJeu;
	private $modeleJeu;

	public function __construct(){
		$this->vueJeu=new VueJeu();
		$this->modeleJeu = new Jeu();
	}

	public function jeu($tab){
		if($tab==null){
			$plateau=$this->modeleJeu->creeJeu();
		}else{
			$plateau=$this->modeleJeu->Jeu($tab);
		}
		if(gettype($plateau)== "boolean"){
			echo "vue victoire";
		}else{
			$this->vueJeu->Jeu($plateau);
		}
	}

}
?>
