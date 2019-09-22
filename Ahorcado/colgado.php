<?php


class colgado extends partida{

    var $maxIntentos;                //int - maximum guesses per word
    var $letrasAdivinadas = array();        //array - letters guessed so far
    var $indicePalabra;                //int - index of the current word
    var $letrasPalabra = array();    //array - array of the letters in the word
    var $listaPalabras = array();    //array - list of words they can guess

    var $abecedario = array(        //array - all letters in the alphabet
        "a", "b", "c", "d", "e", "f", "g", "h",
        "i", "j", "k", "l", "m", "n", "o", "p",
        "q", "r", "s", "t", "u", "v", "w", "x",
        "y", "z");


    function colgado()
    {
        partida::principioJuego();
        
        
    }


    function setIntentos($cantidad = 0)
    {
        $this->maxIntentos += $cantidad;
    }
    function nuevaPartida()
    {
        $max_intentos = 5;
        //setup the game
        $this->principioJuego();

        //make sure we clear out the last letters they guessed
        $this->letrasPalabra = array();

        //set how many guesses they get before it's a game over
        if ($max_intentos)
            $this->setIntentos($max_intentos);

        //pick a word for them to try and guess
        $this->setPalabra();
    }
    function jugarPartida($letra){
        //player pressed the button to start a new game
        
        if (isset($_POST['nuevaPartida']) || empty($this->listaPalabras)){
            $this->nuevaPartida();
        }
        //player is trying to guess a letter
        if ((!$this->hasPerdido()) && isset($_POST['letra'])){
            echo $this->letrasAdivinadas(isset($_POST['letra']));
        }
        //display the game
        $this->mostrarJuego();
    }
    function mostrarJuego(){
        //while the game isn't over
        if (!$this->hasPerdido()) {
            echo "<div id=\"imagen\">" . $this->imagen() . "</div>
				  <div id=\"palabra_adivinada\">" . $this->palabraResuelta() . "</div>
				  <div id=\"seleccion_letra\">
					Enter A Letter:
						<input type=\"text\" name=\"letra\" value=\"\" size=\"2\" maxlength=\"1\" />
						<input type=\"submit\" name=\"submit\" value=\"Enviar\" />
				  </div>";

            if (!empty($this->letrasAdivinadas))
                echo "<div id=\"letras_adivinadas\">Letras Adivinadas: " . implode($this->letrasAdivinadas, ", ") . "</div>";
        } else {
            //they've won the game
            if ($this->ganar)
                echo exitosoMsg("Felicidades! Tu has ganado el juego.<br/>
								Tu puntuación final fué:: $this->puntuacion");
            else if ($this->vida < 0) {
                echo errorMsg("Game Over! Intentalo de nuevo.<br/>
								Tu puntuacion final ha sido: $this->puntuacion");
                echo "<div id=\"imagen\">" . $this->imagen() . "</div>";
            }

            echo "<div id=\"principio_juego\"><input type=\"submit\" name=\"nueva partida\" value=\"Nueva Partida\" /></div>";
        }
    }

    function adivinarLetra($letra){

        if ($this->hasPerdido())
            return;

        if (!is_string($letra) || strlen($letra) != 1 || !$this->esLetra($letra))
            return errorMsg("Te has equivocado, entra una letra por favor!");

        //check if they've already guessed the letter
        if (in_array($letra , $this->letrasAdivinadas))
            return errorMsg("Ya has adivinado esta letra.");

        //only allow lowercase letters
        $letra = strtolower($letra);

        //if the word contains this letter
        if (!(strpos($this->listaPalabras[$this->indicePalabra], $letra) === false)) {
            //increase their score based on how many guesses they've used so far
            if ($this->health > (100 / ceil($this->maxIntentos / 5)))
                $this->setPuntuacion(5);
            else if ($this->health > (100 / ceil($this->guesses / 4)))
                $this->setPuntuacion(4);
            else if ($this->health > (100 / ceil($this->guesses / 3)))
                $this->setPuntuacion(3);
            else if ($this->health > (100 / ceil($this->guesses / 2)))
                $this->setPuntuacion(2);
            else
                $this->setPuntuacion(1);

            //add the letter to the letters array
            array_push($this->letrasAdivinadas, $letra);

            //if they've found all the letters in this word
            if (implode(array_intersect($this->letrasPalabra, $this->letrasAdivinadas), "") ==
                str_replace( "", strtolower($this->listaPalabras[$this->indicePalabra]))
            )
                $this->ganar = true;


            else
                return exitosoMsg("Buena partida, eso es correcto!");
        } else{ //word doesn't contain the letter

            //reduce their health
            $this->setVida(ceil(100 / $this->maxIntentos) * -1);

            //add the letter to the letters array
            array_push($this->letrasAdivinadas, $letra);

            if ($this->hasPerdido())
                return;
            else
                return errorMsg("No hay esa $letra en la palabra.");
        }
    }

    function setPalabra()
    {
        //if the word list is empty we need to load it first
        if (empty($this->listaPalabras))
            $this->cargarPalabras();

        //reset the word index to a new word
        if (!empty($this->listaPalabras))
            $this->indicePalabra = rand(0, count($this->listaPalabras) - 1);

        //convert the string to an array we can use
        $this->palabra_Array();
    }

    function cargarPalabras($nombrearchivo = "palabras.txt")
    {
        if (file_exists($nombrearchivo)) {
            $abrirarchivo = fopen($nombrearchivo, "r");
            while ($palabra = fscanf($abrirarchivo, "%s %s %s %s %s %s %s %s %s %s\n")) {

                $phrase = "";

                if (is_string($palabra[0])) {
                    foreach ($palabra as $valor)
                        $phrase .= $valor . " ";

                    array_push($this->listaPalabras, trim($phrase));
                }
            }
        }
    }

    function imagen()
    {
        $count = 1;

        for ($i = 100; $i >= 0; $i -= ceil(100 / $this->maxIntentos)) {
            if ($this->vida == $i) {
                if (file_exists("" . ($count - 1) . ".jpg"))
                    return "<img src=\"" . ($count - 1) . ".jpg\" alt=\"Colgado\" title=\"Colgado\" />";

            }

            $count++;
        }

        return "<img src=\"" . ($count - 1) . ".jpg\" alt=\"Hangman\" title=\"Hangman\" />";
    }

    function palabraResuelta()
    {

        $result = "";

        for ($i = 0; $i < count($this->listaPalabras); $i++) {
            $encontrada = false;

            foreach ($this->letrasAdivinadas as $letra) {
                if ($letra == $this->letrasPalabra[$i]) {
                    $result .= $this->letrasPalabra[$i]; //they've guessed this letter
                    $encontrada = true;
                }
            }

            if (!$encontrada && $this->esLetra($this->letrasPalabra[$i]))
                $result .= "_"; //they haven't guessed this letter

            else if (!$encontrada) //this is a space or non-alpha character
            {
                //make spaces more noticable
                if ($this->letrasPalabra[$i] == " ")
                    $result .= "&nbsp;&nbsp;&nbsp;";
                else
                    $result .= $this->letrasPalabra[$i];
            }
        }

        return $result;
    }

    function palabra_Array()
    {
        $this->letrasPalabra = array();

        for ($i = 0; $i < strlen($this->listaPalabras[$this->indicePalabra]); $i++)
            array_push($this->letrasPalabra, $this->listaPalabras[$this->indicePalabra][$i]);
    }

    function esLetra($valor)
    {
        if (in_array($valor, $this->abecedario))
            return true;

        return false;

    }

}
