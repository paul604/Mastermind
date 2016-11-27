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
			<h1>Mastermind <?php  echo $plateau[2] ?></h1>
			<div id="plateau">
				<?php
					$i=1;
					foreach($plateau[0] as $tab){
						if($i==$plateau[2]){
							echo "<ul class=\"courant\">";
						}else{
							echo "<ul>";
						}
						$indice=1;
						foreach($tab as $val){
							if($i==$plateau[2]){
								echo "<li id=\"".$indice."\" class=\"c".$val."\" onclick=\"unSet('".$indice."')\">".$val."</li>";
							}else{
								echo "<li id=\"".$indice."\" class=\"c".$val."\">".$val."</li>";
							}
							$indice++;
						}
						$i++;
						echo "</ul>";
					}
				?>
			</div>

			<div id="verif">
				<?php
					foreach($plateau[1] as $tab){
						echo "<ul>";
						foreach($tab as $val){
							echo "<li class=\"c".$val."\">".$val."</li>";
						}
						echo "</ul>";
					}
				?>
			</div>

			<div id="color">
				<ul>
					<li class="c1" onclick="set('1')"></li>
					<li class="c2" onclick="set('2')"></li>
					<li class="c3" onclick="set('3')"></li>
					<li class="c4" onclick="set('4')"></li>
					<li class="c5" onclick="set('5')"></li>
					<li class="c6" onclick="set('6')"></li>
					<li class="c7" onclick="set('7')"></li>
					<li class="c8" onclick="set('8')"></li>
				</ul>
			</div>

			<form method="post" action="index.php" name="choix">

				<input type="text" name="1" value="0" hidden="">
				<input type="text" name="2" value="0" hidden="">
				<input type="text" name="3" value="0" hidden="">
				<input type="text" name="4" value="0" hidden="">

				<input type="submit" id="submit" value="envoyer" disabled="disabled"/>
			</form>
			<br/>
			<br/>
		</body>
    </html>
    <?php
	}

}
?>