<?php


class ahorcado
{

    var $random;
    var $imagen_error;
    var $lista_array;
    var $caracPalabra;
    var $arraypalabra;
    var $arrayguion;
    var $puntuacion = 0;
    var $intentos = 6;
    var $error = 0;
    var $letras;



    

    static function cargar($lista_array = "palabras.txt")
    {
        if (file_exists($lista_array)) {
            $this->lista_array = "palabras.txt";


        }
        $this->random();
    }

    static function random()
    {
        if (!isset($random)) {
            $random = lista_array[array_rand($lista_array)];

        }
        $caracPalabra = strlen(random) - 1; //contamos caracteres de la palabra
        $arraypalabra = str_split(random);

        $arraypalabravacia = Array(); //creamos un segundo array vacio

        for ($i = 0; $i < $caracPalabra; $i++) { //llenamos array 2 con _
            echo $arraypalabravacia[$i] = "_";


        }
    }

     function logicaJuego(){
        
         $this->random();

        if(!$_POST['letras']){
            $arrayguion = implode(" ",$arrayguion);
            echo'<div class="palabravacia">'.$arrayguion.'</div>';

        }

        if ($_POST['letras']) {
            $letras = $_POST['letras'];

                    for ($c = 0; $c < $caracPalabra - 1; $c++) {
                        if ($arraypalabra[$c] == $letras) {
                            echo $arraypalabra[$c] = $letras;

                        } else if ($_POST['letras'] != $letras) {
                            $error += 1;
                            echo $this->imagen();
                        }
                    }
        }
    }

    static function imagen()
    {

        $imagen_error = $this->error;
        if ($imagen_error > 6) {
            $this->imagen_error = 6;
        }

        return "<img src=\"" . $this->error . ".jpg\" alt=\"Ahorcado\" title=\"Ahorcado\" />";


    }
}
?>
<html>
    <head>
        <title>Joc del penjat</title>

    </head>
    <body>
        <form action= "" method="post">
            <div class="letradiv" name="letradiv">
                <p class="letratexto">LLetra</p>
                <input type="text" name="letra" id="letra" class="letra" maxlength="1" pattern="[a-z]{1}">
            </div>
            <div class="inputdiv" name="inputdiv">
                <input type="submit" class="input" value="Jugar">
            </div>
        </form>
    </body>
</html>
