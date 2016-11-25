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
			$plateau2=array(
				array(
				),//1
				array(
				),//2
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

			$this->vueJeu->Jeu($plateau2);
		}

	}	

}
?>
