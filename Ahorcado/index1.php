<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
        // put your code here
        include 'Partida.php';

        $partida = new partida();
        $partida->ejecutar();
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <section id="letras">
            <?php echo "<P><B>Juego del Ahorcado</B></P>";?>
            <?php echo $partida->imagen_error;?>
            <?php echo $partida->linea_palabra;?>
            <?php echo $partida->links;?>
           
            
                 
    </body>
</html>
