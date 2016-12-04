<?php

require_once __DIR__."/../vue/vueConection.php";
require_once __DIR__."/../modele/bd.php";

class ControleurAuthentification{

	private $vue;
	private $bd;

	public function __construct(){
		$this->vue=new Conection();
		$this->bd=new Bd();
	}

	public function accueil($bool){
		//afichage de la page de connection, bool=>boolean true si il y a déjat eu une tentative
		$this->vue->afficher($bool);
	}

	public function verifCo($pseudo, $mdp){
		//verifi la validiter du pseudo et du mot de passe
		if($this->bd->verifiMdp($pseudo, $mdp)){
			//si tout est bon
			$_SESSION['pseudo']=$pseudo;
			return true;//conection ok
		}else{
			$this->accueil(true);
			return false;//conection fail
		}
	}

}
?>
