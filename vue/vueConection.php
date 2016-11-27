<?php
class Conection{

	function __construct(){
	}

	function afficher($fail){
    header("Content-type: text/html; charset=utf-8");
    ?>
    <html>
      <body>
        <br/>
        <br/>
		Le site utilise les cookie ! </br>
		<?php 
			if(gettype($fail)== "boolean"){
				if($fail){
					?> mdp ou login incorecte<?php
				}
			}else{
				throw new Exception("problème avec le log");
			}
		?>
        <form method="post" action="index.php">
			<fieldset>
				<legend>login</legend>
				Entrer votre pseudo  <input type="text" name="pseudo"/>
				Entrer votre mdp  <input type="text" name="mdp"/>
				<input type="submit" name="soumettre" value="log"/>
		  
			</fieldset>
        </form>
        <br/>
        <br/>
      </body>
    </html>
    <?php
	}

}
?>
