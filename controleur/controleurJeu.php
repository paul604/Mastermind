<?php

require_once __DIR__."/../vue/vueJeu.php";
require_once __DIR__."/../modele/jeu.php";

// if(!isset($_SESSION)){
    // session_start();
// }

class ControleurJeu{

	private $vueJeu;
	private $modeleJeu;

	public function __construct(){
		if(!isset($_SESSION["jeu"])){
			$this->modeleJeu= new Jeu();
			$_SESSION["jeu"]=$this->modeleJeu;
			
			//print_r($_SESSION["jeu"]);
		}else{
			$this->modeleJeu=$_SESSION["jeu"];
		}
		$this->vueJeu=new VueJeu();
	}

	public function jeu($tab){
		
		if($tab==null){
			$plateau=$this->modeleJeu->Jeu(null);
		}else{
			if($tab[0]=="requp"){
				$plateau=$this->modeleJeu->requp();
			}else{
				$plateau=$this->modeleJeu->Jeu($tab);
			}
		}
		if(gettype($plateau)== "boolean"){
			echo "vue victoire";
		}else{
			
			if($tab[0]=="requp"){
				$this->vueJeu->Jeu($plateau);
			}else{
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
				$_SESSION["jeu"]=$this->modeleJeu;
				$this->vueJeu->Jeu($plateau2);
			}
		}
	}

}
?>
