<?php
if(isset($_POST['number'])) {
   $number = $_POST['number'];
   $intentos = $_POST['intentos'] + 1;
} else {
   $intentos = 0;
   $number = rand(1,3000);
}
?>

<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title>Adivina</title>
      <link rel="stylesheet" href="css/strike.css" />
   </head>

<body>
<h1>Adivina!</h1>

<p>Intenta adivinar un n&uacute;mero entre 1 y 3000.</p>
<form action="<?=$_SERVER['PHP_SELF'] ?>" method="post" name="guess-a-number">
    <label>Ingresa un n&uacute;mero:</label><br/ >
    <input type="text" id="guess" name="guess" />
    <input name="number" type="hidden" value="<?= $number ?>" />
    <input name="intentos" type="hidden" value="<?= $intentos ?>" />
    <input name="submit" type="submit" value="Prueba suerte!" />
</form>

<form action="<?=$_SERVER['PHP_SELF'] ?>" method="post" name="new-number">
    <input name="submit" type="submit" value="Nuevo Juego" />
</form>

<?php
if($_POST["guess"]){

    // grab the user input guess
    $guess  = $_POST['guess'];
    $number  = $_POST['number'];
    $intentos = $_POST['intentos'];

	if (!is_numeric($guess)) {
		echo "Ey! Lo que ingresaste no es un n&uacute;mero.";
	}
	else
	{
		if ($guess < $number){ 
    		echo "Intenta con un n&uacute;mero m&aacute;s alto.";
		}elseif($guess > $number){       
    		echo "Intenta con un n&uacute;mero m&aacute;s bajo.";
		}elseif($guess == $number){      
    		echo "<p>Excelente!! Lo adivinaste!!</p>";
			echo "<p>Obtuviste ",round(1000/$intentos), " puntos!.</p>";
		}
	}
}
?>

</body>
</html>