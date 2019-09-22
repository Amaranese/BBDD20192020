<?php
//include the required files
include('ahorcado.php');


//this will keep the game data as they refresh the page
session_start();

//if they haven't started a game yet let's load one
if (!$_SESSION['ahorcado']){
	$_SESSION['ahorcado'] = new ahorcado();
       
}
$ahorcado= new ahorcado();
?>
<html>
	<head>
		<title>Colgado</title>

	</head>
	<body>
		<div id="content">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<h2>Juguemos al Colgado!</h2>
		<?php
		$_SESSION['ahorcado'] = $ahorcado->logicaJuego(isset($_POST));
                         
		?>
		</form>
		</div>
	</body>
</html>