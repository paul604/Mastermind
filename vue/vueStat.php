<?php
class VueStat{

	public function __construct(){
	}

	function afficher($perso,$top){//$perso => stat perso / $top => top 5
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
			<div class="stat">
				<div id="name">
					<h1>Mastermind</h1>
				</div>
				<div class="perso">
					<?php
						echo "nb victoire  : ".$perso[0]."</br>";
						echo "nb de partie : ".$perso[1]."</br>";
					?>
				</div>
				<div class="top">
					Top 5</br>
					<table><!-- créer un tableau pour le top5 -->
						<thead>
							<th>Pseudo</th>
							<th>nb coups</th>
						</thead>
						<tbody>
							<?php
								foreach($top as $val){//parcour du tableau $top
									echo "<tr>";
									echo "<td>".$val[0]."</td>";
									echo "<td>".$val[1]."</td>";
									echo "</tr>";
								}
							?>
						</tbody>
					</table>
				</div>
				
				<form method="post" action="index.php">
					<input type="submit" id="retour" name="retour" value="retour"/>
				</form>
				<form method="post" action="index.php">
					<input type="submit" id="deLog" name="deLog" value="déconnexion"/>
				</form>
			</div>
		</body>
    </html>
    <?php
	}

}
?>
