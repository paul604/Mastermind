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
			<script src="vue/script.js" type="text/javascript"></script>
		</head>
		<body>
			<h1>Mastermind</h1>
			<div id="plateau">
				<?php
					$i=1;
					foreach($plateau[0] as $tab){
						echo "<ul>";
						$indice=1;
						foreach($tab as $val){
							if($i==$plateau[2]){
								echo "<li id=\"c".$val."\" classe=\"courant\" classe=\"".$indice."\">".$val."</li>";
							}else{
								echo "<li id=\"c".$val."\">".$val."</li>";
							}
							$indice++;
						}
						echo "</ul>";
						$i++;
					}
				?>
			</div>

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

			<div id="color">
				<ul>
					<li id="c1" onclick="set('1')"></li>
					<li id="c2" onclick="set('2')"></li>
					<li id="c3" onclick="set('3')"></li>
					<li id="c4" onclick="set('4')"></li>
					<li id="c5" onclick="set('5')"></li>
					<li id="c6" onclick="set('6')"></li>
					<li id="c7" onclick="set('7')"></li>
					<li id="c8" onclick="set('8')"></li>
				</ul>
			</div>

			<form method="post" action="index.php">

				<input type="text" name="1" value="0" hidden="">
				<input type="text" name="2" value="0" hidden="">
				<input type="text" name="3" value="0" hidden="">
				<input type="text" name="4" value="0" hidden="">

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
