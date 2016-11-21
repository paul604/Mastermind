<?php
class Conection{

	function __construct(){
	}

	function afficher(){
    header("Content-type: text/html; charset=utf-8");
    ?>
    <html>
      <body>
        <br/>
        <br/>
        <form method="post" action="index.php">
		  Le site utilise les cookie ! </br>
          Entrer votre pseudo  <input type="text" name="pseudo"/>
          Entrer votre mdp  <input type="text" name="mdp"/>
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
