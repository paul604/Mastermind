<?php
class VueJeu{

	public function __construct(){
	}

	public function Jeu($plateau){//$plateau[0]=> le jeu $plateau[1]=> le tabl verif
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
			<h1>Mastermind</h1>
			<div id="plateau">
				<?php
					$i=1;
					foreach($plateau[0] as $tab){
						echo "<ul>";
						foreach($tab as $val){
							if($i==$plateau[2]){
								echo "<li id=\"c".$val."\" classe=\"courant\">".$val."</li>";
							}else{
								echo "<li id=\"c".$val."\">".$val."</li>";
							}
						}
						echo "</ul>";
						$i++;
					}
				?>
			</div>
			ttttttttt
			<div id="verif">
				<?php
					foreach($plateau[0] as $tab){
						echo "<ul>";
						foreach($tab as $val){
							echo "<li>".$val."</li>";
						}
						echo "</ul>";
					}
				?>
			</div>
			ttttttttt
			<div id="color">
				<ul>
					<li id="c1"></li>
					<li id="c2"></li>
					<li id="c3"></li>
					<li id="c4"></li>
					<li id="c5"></li>
					<li id="c6"></li>
					<li id="c7"></li>
					<li id="c8"></li>
				</ul>
			</div>

			<form method="post" action="index.php">

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
