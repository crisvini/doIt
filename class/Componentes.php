<?php

// Classe com componentes para agilizar no desenvolvimento
class Componentes
{

    // Componente de head
    public static function head($title)
    {
        echo '<head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <!-- JS -->
                <script src="./style/bootstrap5/node_modules/bootstrap/dist/js/bootstrap.min.js?' . time() . '"></script>
                <script src="./lib/jquery/node_modules/jquery/dist/jquery.min.js?' . time() . '"></script>
                <script src="./lib/jqueryMask/jquery.mask.js?' . time() . '"></script>
                <script src="./lib/swal2/node_modules/sweetalert2/dist/sweetalert2.all.min.js?' . time() . '"></script>
                <script src="./js/commomFunctions.js?' . time() . '"></script>
                <!-- CSS -->
                <link rel="stylesheet" href="./style/bootstrap5/node_modules/bootstrap/dist/css/bootstrap.min.css?' . time() . '">
                <link rel="stylesheet" href="./style/styles.css?' . time() . '">
                <link rel="stylesheet" href="./lib/swal2/node_modules/sweetalert2/dist/sweetalert2.min.css?' . time() . '">
                <link rel="stylesheet" href="./style/fontAwesome/node_modules/@fortawesome/fontawesome-free/css/all.min.css?' . time() . '">
                <title>DoIt > ' . $title . '</title>
                <link rel="icon" type="image/x-icon" href="./assets/favicon.ico">
              </head>';
    }

    // Componente de header
    public static function header()
    {
        include_once("./connection/conexao.php");
        $sql = "SELECT
                    admin
                FROM
                    usuarios
                WHERE
                    email = '" . $_SESSION["email"] . "'";
        // Se o perfil do usuário for de admin, exibe o navlink para a tela de usuários
        if (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["admin"] == 1) {
            $navLinks = '<li class="nav-item">
                            <a class="nav-link text-success fs-6 fw-bolder success-hover" href="./tarefas.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-success fs-6 fw-bolder success-hover" href="./usuarios.php">Usuários</a>
                        </li>';
        } else {
            $navLinks = '<li class="nav-item">
                            <a class="nav-link text-success fs-6 fw-bolder success-hover" href="./tarefas.php">Home</a>
                        </li>';
        }
        echo '  <nav class="navbar navbar-expand-lg bg-light box-shadow-padrao">
                    <div class="container-fluid px-lg-4">
                        <a class="navbar-brand" href="./tarefas.php"><span class="pointer success-hover fs-2 text-success fw-bold">DoIt <i class="fa-solid fa-list-check"></i></span></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="navbar-toggler-icon fa-solid fa-bars h-100 fs-2 text-success"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarScroll">
                            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                            ' . $navLinks . '
                            </ul>
                            <div class="d-flex">
                                <span class="pointer success-hover text-success fw-bold" style="font-size: 110%;" onclick="logout();">Sair&nbsp;<i class="fa-solid fa-right-from-bracket"></i></span>
                            </div>
                        </div>
                    </div>
                </nav>';
    }
}
