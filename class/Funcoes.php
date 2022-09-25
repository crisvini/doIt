<?php

// Classe de funções comuns entre diversas páginas
class Funcoes
{
    public static function verificaLogin()
    {
        if (!isset($_SESSION["email"]))
            header("Location: ./index.php");
    }

    public static function verificaAdmin()
    {
        if ($_SESSION["admin"] == 0)
            header("Location: ./home.php");
    }

    public static function tirarAcentos($string)
    {
        return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string);
    }
}
