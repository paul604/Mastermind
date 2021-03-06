<?php
class VueJeu{

	public function __construct(){
	}

	public function Jeu($plateau){//$plateau[0]=> le plateau /$plateau[1]=> le tabl verif / $plateau[2] tour en cour
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
					<h1>Mastermind</h1>
				</div>
				<div id="solution">
					<ul id="tabSolus"><!-- corespond au solution -->
						<li id="indice"></li><!-- permet d'avoire une casse vide pour remplacer les indice du plateur-->
						<li></li>
						<li></li>
						<li></li>
						<li></li>
					</ul>
				</div>
				<div id="jeu">
					<div id="plateau">
						<?php
							$i=1;
							foreach($plateau[0] as $tab){
								if($i==$plateau[2]){/*si la ligne traiter est avant /pendant/ apprèt le coup courant*/
									echo "<ul class=\"courant\">";
								}else if($i<$plateau[2]){
									echo "<ul class=\"befor\">";
								}else{
									echo "<ul>";
								}
								$indice=1;
								echo "<li id=indice>".$i."</li>";/* corespond indice des coups 1 a 10*/
								foreach($tab as $val){
									if($i==$plateau[2]){/*affecte les couleur déjà jouer par le joueur et verifi si la casse est dans une ligne avant /pendant/ apprèt le coup courant*/
										echo "<li id=\"".$indice."\" class=\"c".$val."\" onclick=\"unSet('".$indice."')\"></li>";
									}else if($i<$plateau[2]){
										echo "<li id=\"".$indice."\" class=\"c".$val."\" onclick=\"up('".$indice."','".$val."')\"></li>";
									}else{
										echo "<li id=\"".$indice."\" class=\"c".$val."\"></li>";
									}
									$indice++;
								}
								$i++;
								echo "</ul>";
							}
						?>
					</div>

					<div id="verif"><!-- tableau de vérification -->
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
					<div id="color"><!-- choix des couleur -->
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

					<div id="bouton">
						<!-- formulaire de choix -->
						<form method="post" action="index.php" name="choix">

							<input type="text" name="1" value="0" hidden="">
							<input type="text" name="2" value="0" hidden="">
							<input type="text" name="3" value="0" hidden="">
							<input type="text" name="4" value="0" hidden="">

							<input type="submit" id="submit" value="envoyer" disabled="disabled"/>
						</form>
						<!-- déconnexion -->
						<form method="post" action="index.php">
							<input type="submit" id="deLog" name="deLog" value="déconnexion"/>
						</form>
						<!-- statistiques -->
						<form method="post" action="index.php">
							<input type="submit" id="stat" name="stat" value="stat"/>
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
