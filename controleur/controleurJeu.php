<?php

require_once __DIR__."/../vue/vueJeu.php";
require_once __DIR__."/combinaison.php";

class ControleurJeu{

  private $jeu;
  private $combine;
  private $plateau;
  private $tourEnCour;

  const MAXTOUR = 10;

  public function __construct(){
    $this->tourEnCour=0;
    $this->jeu=new VueJeu();
    $this->combine= array();
    $this->plateau= array();
    for ($i=0; $i < 9; $i++) {
      $this->plateau[$i]=new Combinaison();
    }
  }

  public function addCombin($combinaison){
    $this->plateau[$this->tourEnCour]->addAll($combinaison);
  }


  public function jeu($combinaison){
    if(isset($combinaison)){
      $this->addCombin($combinaison);
    }else{
      if ($this->tourEnCour!=0) {
        throw new $exeption("problème avec le jeu");
      }
    }
    $this->tourEnCour++;
    $this->jeu->jeu();
  }

  public function creerCombin(){
    for ($i=0; $i <=4 ; $i++) {
      $this->combine[$i]=rand(1,8);
    }
  }
  public function creeJeu(){
    $this->creerCombin();
    $this->jeu(null);
  }

}
?>
