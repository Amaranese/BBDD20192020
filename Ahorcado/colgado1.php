<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
      
<?php


    if(isset($_GET["random"])) {
        $random=$_GET["random"];
    }
    if(isset($_GET["letras"])) {
        $letras=$_GET["letras"];
    }
    if(!isset($letras)){
        $letras="";
    }
    if(isset($PHP_SELF)){ 
        $self=$PHP_SELF;
    }else{ 
        $self=$_SERVER["PHP_SELF"];
    }

    $lista_array = file("palabra.txt");
    $lista = implode("", $lista_array);
    $abecedario = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $recorrer_abecedario= strlen($abecedario);
    $links="";
    $max=6;					
    $mayus = strtoupper($lista);
    $palabras = explode("\n",$lista);
    $error = 0;
    $puntuacion = 0;
    echo "<P><B>Juego del Ahorcado</B></P>";

    if (!isset($random)) { 
        $random = rand(1,count($palabras)) - 1;     
    }

    $linia_palabra="";
    $palabra = trim($palabras[$random]);
    $correcto = 1;

    //recorre la palabra con un bucle y hace un strstr para buscar si la letra seleccionada la encuentra en el string
    for ($x=0; $x < strlen($palabra); $x++){
                if (strstr($letras, $palabra[$x])){
                            $linia_palabra.=$palabra[$x];           
                } 
                else { $linia_palabra.="_<font size=13>&nbsp;</font>"; 
                      $correcto = 0; 
                }
    }

    if (!$correcto){
                    for ($c=0; $c<$recorrer_abecedario; $c++){
                                if (strstr($letras, $abecedario[$c])){
                                  if (strstr($palabras[$random], $abecedario[$c])) {
                                        $links .= "\n<B>$abecedario[$c]</B> "; 
                                  }else{ 
                                        $links .= "\n<font color=\"red\">$abecedario[$c] </font>"; 
                                        $error++; }
                                }else{
                                 $links .= "\n<a href=\"$self?letras=$abecedario[$c]$letras&random=$random\">$abecedario[$c]</a>";   
                                }
                                }

              $imagen_error=$error; 

              if ($imagen_error>6){
                  $imagen_error=6;
              }
              echo "\n<p><br>\n<img src=\" colgado_$imagen_error.gif\" ALIGN=\"MIDDLE\" BORDER=0 WIDTH=100 HEIGHT=100 ALT=\"Error: "."$error fuera de $max\">\n";

              if ($error >= $max){
                    $random = rand(1,count($palabras)) - 1;
                    $puntuacion;   
                              echo "<p><B>Puntuacion: $puntuacion</p>\n";  
                              echo "$linia_palabra\n";
                              echo "<p><font color=\"red\">HAS PERDIDO!<br>";
                                    
                              echo "<a href=$self?random=$random>Jugar otra vez.</a>\n\n";

               }else{
                   
                                echo " &nbsp; -Intentos: ".($max-$error)."\n";
                                echo "<H1><font size=5>\n$linia_palabra</font></H1>\n";
                                echo "<P><BR>Escoge una letra:<BR><BR>\n";
                                echo "$links\n";                
               }
    }else{
        $random = rand(1,count($palabras)) - 1;
        $puntuacion=$puntuacion+100;
        
       echo "<p><B>Puntuacion: $puntuacion</p>\n"; 
      echo "<font size=5>\n$linia_palabra</font>\n";
      echo "<p><B>Felicidadeeees!!! Has ganado!!!</p>\n";
      echo "<a href=$self?random=$random>Jugar otra vez</A>\n\n";
    }
?>
 </body>
</html>
