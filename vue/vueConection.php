<?php
class Conection{

	function __construct(){
	}

	function afficher($fail){//afichage 
    header("Content-type: text/html; charset=utf-8");
    ?>
    <html>
		<head>
			<meta charset="UTF-8">
			<title>Mastermind</title>
			<link rel="stylesheet" href="vue/reset.css">
			<link rel="stylesheet" href="vue/css.css">
		</head>
		<body>
			<div id="log">
				<p>Le site utilise les cookie ! </p>
				<?php 
					if(gettype($fail)== "boolean"){
						if($fail){//si il y a déjà eu une connection on affiche le message:
							?><p id="erreur"> mot de passe ou login incorecte </p><?php
						}else{
							?></br><?php
						}
					}else{
						throw new Exception("problème avec le log");
					}
				?>
				<form method="post" action="index.php">
					<fieldset>
						<legend>login</legend>
						<input type="text" id="pseudo" name="pseudo" placeholder="pseudo" autofocus required/>
						<input type="password" id="mdp" name="mdp" placeholder="mdp" required/>
						<input type="submit" id="connection" name="soumettre" value="connection"/>
		  
					</fieldset>
				</form>
			</div>
		</body>
    </html>
    <?php
	}

}
?>
