<?php

require_once 'controleurAuthentification.php';
require_once __DIR__."/controleurJeu.php";


class RouteurControleur {

	private $ctrlAuthentification;
	private $ctrlJeu;
  // private $ctrlMsg;

	public function __construct() {
		try{
			$this->jeu=new ControleurJeu();
			$this->ctrlAuthentification = new ControleurAuthentification($this->jeu);
		}catch(Exception $e){
			echo "erreur1";
			throw $e;
		}
	}

	// Traite une requête entrante
	public function routerRequete() {
		try{
			if ( array_key_exists("pseudo",$_POST) && array_key_exists("mdp",$_POST) ) {
				$this->ctrlAuthentification->verifCo($_POST["pseudo"],$_POST["mdp"]);
			}else if( array_key_exists("jeu",$_POST) ||array_key_exists("pseudo",$_SESSION) ) {
				//jeux(post[])
			}else{
				$this->ctrlAuthentification->accueil();
			}
		}catch(Exception $e){
			echo "erreur";
		}
	}

}
?>
