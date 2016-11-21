<?php
class VueJeu{

	public function __construct(){
	}

	public function Jeu(){
		header("Content-type: text/html; charset=utf-8");
    ?>
    <html>
      <body>
        <br/>
        <br/>
        <form method="post" action="index.php">
          jeu :) !!!!!!!!!!!!!
          </br>
          </br>
          <input type="submit" name="soumettre" value="envoyer"/>
        </form>
        <br/>
        <br/>
      </body>
    </html>
    <?php
	}

}
?>
