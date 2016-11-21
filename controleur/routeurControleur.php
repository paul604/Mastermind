<?php

require_once 'controleurAuthentification.php';


class RouteurControleur {

	private $ctrlAuthentification;
  // private $ctrlMsg;

	public function __construct() {
		try{
			$this->ctrlAuthentification = new ControleurAuthentification();
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
			}else{
				$this->ctrlAuthentification->accueil();
			}
		}catch(Exception $e){
			echo "erreur";
		}
	}

}
?>
