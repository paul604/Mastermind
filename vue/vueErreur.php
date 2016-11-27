<?php
class VueErreur{

	public function __construct(){
	}

	public function Erreur($msg){
		session_destroy();
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
			<?php echo $msg;?>
		</body>
    </html>
    <?php
	}

}
?>