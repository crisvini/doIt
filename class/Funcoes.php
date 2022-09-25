<?php

// Classe de funções comuns entre diversas páginas
class Funcoes
{
    public static function verificaLogin()
    {
        if (!isset($_SESSION["email"]))
            header("Location: ./index.php");
    }
}
