<?php
// Inclusão do arquivo de includes
include_once("./includes/includes.php");
// Função que verifica se o usuário está autenticado
Funcoes::verificaLogin();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Inclusão do head -->
    <?php Componentes::head('Home'); ?>
    <!-- Inclusão do Javascript da página -->
    <script src="./js/home.js?<?= time(); ?>"></script>
</head>

<body>
    <!-- Navbar/Header -->
    <header>
        <!-- Inclusão do navbar/header -->
        <?php Componentes::header(); ?>
    </header>

    <main class="container text-center">
        <div class="row">
            <div class="col-12 col-lg-6">
                <img src="./assets/Task-cuate.svg">
            </div>
            <div class="col-12 col-lg-6 m-auto" id="home_buttons">
                <!-- <a href="./tarefas.php"><button class="mt-3 mt-lg-0 w-100 w-lg-50 btn btn-lg btn-success rounded"><i class="fa-solid fa-list-check"></i> Tarefas</button></a>
                <a href="./usuarios.php"><button class="mt-3 w-100 w-lg-50 btn btn-lg btn-success rounded"><i class="fa-solid fa-user"></i> Usuários</button></a> -->
            </div>
        </div>
    </main>
</body>

</html>