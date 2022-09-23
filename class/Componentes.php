<?php

class Componentes
{

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
                <script src="./js/functions.js?' . time() . '"></script>
                <!-- CSS -->
                <link rel="stylesheet" href="./style/bootstrap5/node_modules/bootstrap/dist/css/bootstrap.min.css?' . time() . '">
                <link rel="stylesheet" href="./style/styles.css?' . time() . '">
                <link rel="stylesheet" href="./lib/swal2/node_modules/sweetalert2/dist/sweetalert2.min.css?' . time() . '">
                <link rel="stylesheet" href="./style/fontAwesome/node_modules/@fortawesome/fontawesome-free/css/all.min.css?' . time() . '">
                <title>DoIt > ' . $title . '</title>
              </head>';
    }

    public static function header($activePage)
    {
        $activeClass1 = '';
        $activeClass2 = '';
        $activeClass3 = '';
        $activeClass4 = '';
        $activeClass5 = '';
        if ($activePage == 'index.php') $activeClass1 = 'active-menu';
        else if ($activePage == 'metas.php') $activeClass2 = 'active-menu';
        else if ($activePage == 'objetivos.php') $activeClass3 = 'active-menu';
        else if ($activePage == 'fichas.php') $activeClass4 = 'active-menu';
        else if ($activePage == 'exercicios.php') $activeClass5 = 'active-menu';
        echo '  <header class="bg-gray sticky-top">
                    <nav class="container navbar navbar-expand-lg bg-gray">
                        <div class="container-fluid">
                            <a class="navbar-brand color-pink fw-bold fs-3 logo-font" href="./home.php">ADM
                                Workout&nbsp;<i class="fa-solid fa-dumbbell"></i></a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 ms-5 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link color-pink fw-semibold ' . $activeClass1 . '" href="./home.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link color-pink fw-semibold ' . $activeClass2 . '" href="./metas.php">Metas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link color-pink fw-semibold ' . $activeClass3 . '" href="./objetivos.php">Objetivos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link color-pink fw-semibold ' . $activeClass4 . '" href="./fichas.php">Fichas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link color-pink fw-semibold ' . $activeClass5 . '" href="./exercicios.php">Exercícios</a>
                                    </li>
                                </ul>
                                <span class="color-pink fw-semibold pink-hover cursor-pointer" onclick="logout();">Sair&nbsp;<i class="fa-solid fa-right-from-bracket"></i></span>
                            </div>
                        </div>
                    </nav>
                </header>';
    }
}
