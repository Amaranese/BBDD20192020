<?php


class partida{
    var $vida;	//int - player's health
    var $perder;		//bool - toggle game over
    var $puntuacion;		//int - player's score
    var $ganar;		//bool - toggle game won


    function principioJuego()
    {
        $this->puntuacion = 0;
        $this->vida = 100;
        $this->perder = false;
        $this->ganar = false;
    }

    function fin()
    {
        $this->perder = true;
    }


    function setPuntuacion($amount = 0)
    {
        return $this->puntuacion += $amount;
    }

    function setVida($amount = 0)
    {
        return ceil($this->vida += $amount);
    }

    function hasPerdido()
    {
        if ($this->ganar)
            return true;

        if ($this->perder)
            return true;

        if ($this->vida)
            return true;

        return false;
    }


}


function debug($objecto = NULL, $msg = "")
{
    if (isset($object) || isset($msg))
    {
        echo "<pre>";

        if (isset($objecto))
            print_r($objecto);

        if (isset($msg))
            echo "\n\t$msg\n";

        echo "\n</pre>";
    }
}


function errorMsg($msg)
{
    return "<div class=\"errorMsg\">$msg</div>";
}

function correctoMsg($msg)
{
    return "<div class=\"correctoMsg\">$msg</div>";

}
