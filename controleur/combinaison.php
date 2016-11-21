<?php
class Combinaison{
 private $combine; //tab

	public function __construct(){
    $this->combine= array(0,0,0,0);
	}

//$codeCouleur 1 a 8
	public function add($indice, $codeCouleur){
    $this->combine[$indice]=$codeCouleur;
	}

  public function addAll($array){
    if(count($array)==4){
      for ($i=0; $i < 4; $i++) {
        $this->add($i, $array[$i]);
      }
    }else{
      throw new $exeption("problème avec l'ajout dans combine");
    }
  }

}
?>
