<?php

require_once __DIR__."/../vue/vueConection.php";
require_once __DIR__."/../modele/bd.php";
//require_once __DIR__."/controleurJeu.php";

session_start();

class ControleurAuthentification{

	private $vue;
	private $bd;
	private $jeu;

	public function __construct($ctrlJeu){
		//try{
		$this->vue=new Conection();
		$this->bd=new Bd();
		$this->jeu=$ctrlJeu;
		/*}catch(Exception $e){
			echo "ctrl";
		}*/
	}

	public function accueil(){
		$this->vue->afficher();
	}

	public function jeu(){
		$this->jeu->Jeu(null);
	}

	public function verifCo($pseudo, $mdp){
		try{
			if($this->bd->verifiMdp($pseudo, $mdp)){
				$_SESSION['pseudo']=$pseudo;
				$this->jeu();
			}else{
				$this->accueil();
			}
		}catch(Exception $e){
			echo "ctrl2";
		}
	}

}
?>
