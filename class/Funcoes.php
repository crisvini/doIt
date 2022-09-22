<?php

class Funcoes
{
    public static function verificaLogin()
    {
        if (!isset($_SESSION["cpf"]))
            header("Location: ./index.php");
    }
}
