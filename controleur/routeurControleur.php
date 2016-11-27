<?php

require_once 'controleurAuthentification.php';
require_once __DIR__."/controleurJeu.php";


class RouteurControleur {

	private $ctrlAuthentification;
	private $ctrlJeu;
	private $exeption;

	public function __construct() {
		try{
			$this->ctrlJeu=new ControleurJeu();
			$this->ctrlAuthentification = new ControleurAuthentification($this->ctrlJeu);
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
			}else if( array_key_exists("1",$_POST) && array_key_exists("2",$_POST) && array_key_exists("3",$_POST) && array_key_exists("4",$_POST)) {
				//print_r($_POST);
				//echo count($_POST);
				if(count($_POST)==5){
					$this->ctrlJeu->jeu(array($_POST["1"],
						$_POST["2"],
						$_POST["3"],
						$_POST["4"]));
				}else{
					throw new Exception("problème avec la requete");
				}
			}else if(array_key_exists("pseudo",$_SESSION)){
				$this->ctrlJeu->jeu(array("requp"));
			}else{
				$this->ctrlAuthentification->accueil();
			}
		}catch(Exception $e){
			echo "erreur";
		}
	}

}
?>
