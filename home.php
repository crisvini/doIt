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
            <!-- Os botões são retornados da função retornaBotoes no arquivo home.js -->
            <div class="col-12 col-lg-6 m-auto" id="home_buttons">
            </div>
        </div>
    </main>
</body>

</html>