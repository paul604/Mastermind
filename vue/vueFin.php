<?php
class VueFin{

	public function __construct(){
	}

	public function afficher($plateau,$victoire ,$solusion){
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
			<div id="solusJeuChoix">
				<div id="name">
					<h1>Mastermind <?php  echo $plateau[2] ?>/10</h1>
				</div>
				<div id="solution">
					<ul id="tabSolus">
						<li id=indice></li>
						<li class="c<?php echo $solusion[0]?>"></li>
						<li class="c<?php echo $solusion[1]?>"></li>
						<li class="c<?php echo $solusion[2]?>"></li>
						<li class="c<?php echo $solusion[3]?>"></li>
					</ul>
				</div>
				<div id="jeu">
					<div id="plateau">
						<?php
							$i=1;
							foreach($plateau[0] as $tab){
								echo "<ul>";
								$indice=1;
								echo "<li id=indice>".$i."</li>";
								foreach($tab as $val){
									echo "<li id=\"".$indice."\" class=\"c".$val."\"></li>";
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
									echo "<li class=\"c".$val."\"></li>";
								}
								echo "</ul>";
							}
						?>
					</div>
				</div>
				<div id="choix">
					<div id="color">
						<ul>
							<li class="c1" ></li>
							<li class="c2" ></li>
							<li class="c3" ></li>
							<li class="c4" ></li>
							<li class="c5" ></li>
							<li class="c6" ></li>
							<li class="c7" ></li>
							<li class="c8" ></li>
						</ul>
					</div>

					<div id="bouton">
						<form method="post" action="index.php" name="choix">
							<input type="submit" id="rejouer" value="rejouer"/>
						</form>
						<form method="post" action="index.php">
							<input type="submit" name="deLog" value="deconection" hidden=""/>
						</form>
					</div>
				</div>
			</div>
			<br/>
			<br/>
		</body>
    </html>
    <?php
	}

}
?>
