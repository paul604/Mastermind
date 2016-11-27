<?php

require_once __DIR__."/../vue/vueConection.php";
require_once __DIR__."/../modele/bd.php";
//require_once __DIR__."/controleurJeu.php";

// if(!isset($_SESSION)){
    // session_start();
// }

class ControleurAuthentification{

	private $vue;
	private $bd;

	public function __construct(){
		//try{
		$this->vue=new Conection();
		$this->bd=new Bd();
		/*}catch(Exception $e){
			echo "ctrl";
		}*/
	}

	public function accueil($bool){
		$this->vue->afficher($bool);
	}

	public function verifCo($pseudo, $mdp){
		if($this->bd->verifiMdp($pseudo, $mdp)){
			$_SESSION['pseudo']=$pseudo;
			return true;
		}else{
			$this->accueil(true);
			return false;
		}
	}

}
?>
