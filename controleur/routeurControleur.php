<?php

require_once 'controleurAuthentification.php';
require_once __DIR__."/controleurJeu.php";
require_once __DIR__."/../vue/vueErreur.php";


class RouteurControleur {

	private $ctrlAuthentification;
	private $ctrlJeu;
	private $exeption;
	private $vueErreur;

	public function __construct() {
		try{
			$this->vueErreur=new VueErreur();
			$this->ctrlJeu=new ControleurJeu();
			$this->ctrlAuthentification = new ControleurAuthentification($this->ctrlJeu);
		}catch(Exception $e){
			$this->vueErreur->Erreur($e);
			session_destroy();
			exit;
		}
	}

	// Traite une requête entrante
	public function routerRequete() {
		try{
			if (array_key_exists("pseudo",$_POST) && array_key_exists("mdp",$_POST)) {
				//le client ce connecte
				
				if($this->ctrlAuthentification->verifCo($_POST["pseudo"],$_POST["mdp"])){
					//verifi dans la bdd
					header("Location: index.php");//empèche le bug F5
					$this->ctrlJeu->jeu();
					exit();
				}
				
			}else if(array_key_exists("pseudo",$_SESSION) && array_key_exists("deLog",$_POST)){
				//demande de déconection: destruction session et retour page de log
				session_destroy();
				$this->ctrlAuthentification->accueil(false);
				
			}else if(array_key_exists("pseudo",$_SESSION) &&  array_key_exists("1",$_POST) && array_key_exists("2",$_POST) && array_key_exists("3",$_POST) && array_key_exists("4",$_POST)) {
				//le joueur vien de faire une proposition
				//vérification du $_POST
				if(count($_POST)==4){
					$_SESSION["choix"]=array($_POST["1"],
						$_POST["2"],
						$_POST["3"],
						$_POST["4"]);
					header("Location: index.php");//empèche le bug F5
					exit();
				}else{
					throw new Exception("problème avec la requete");
				}
				
			}else if(array_key_exists("pseudo",$_SESSION) && array_key_exists("rejouer",$_POST)){
				//le joueur demande de rejouer
				//remise a 0 d'une partie de la session
				$_SESSION["jeu"]=null;
				$_SESSION["victoire"]=false;
				$_POST=null;//si il y a quelleque chose dans le POST
				$this->ctrlJeu=new ControleurJeu();
				header("Location: index.php");//empèche le bug F5
				$this->ctrlJeu->jeu();
				exit();
				
			}else if(array_key_exists("pseudo",$_SESSION) && array_key_exists("stat",$_POST)){
				//demande d'afichage des stat
				$this->ctrlJeu->stat();
				
			}else if(array_key_exists("pseudo",$_SESSION) && array_key_exists("victoire",$_SESSION) && $_SESSION["victoire"]==true){
				//le joueur a fini la partie
				$this->ctrlJeu->victoire();
				
			}else if(array_key_exists("pseudo",$_SESSION) && array_key_exists("choix",$_SESSION) && isset($_SESSION["choix"])){//empèche le bug F5
				//suite du 3em if (ici il y a pas de post donc pas de probème avec le F5)
				$this->ctrlJeu->jeu($_SESSION["choix"]);
				$_SESSION["choix"]=null;
				exit();
				
			}else if(isset($_SESSION) && array_key_exists("pseudo",$_SESSION)){
				//le joueur a quiter la page et veu reprendre la partie
				//ou le joueur vien d'être rediriger appret sa conection
				$this->ctrlJeu->jeu(array("requp"));
				
			}else{
				//on afiche la page de connection
				$this->ctrlAuthentification->accueil(false);
			}
		}catch(Exception $e){
			$this->vueErreur->Erreur($e);
			session_destroy();
			exit;
		}
	}

}
?>
