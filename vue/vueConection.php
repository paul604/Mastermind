<?php
class Conection{

	function __construct(){
	}

	function afficher($fail){
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
					<input type="text" id="pseudo" name="pseudo" placeholder="pseudo" autofocus required/>
					<input type="password" id="mdp" name="mdp" placeholder="mdp" required/>
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
