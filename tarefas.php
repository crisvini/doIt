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
    <?php Componentes::head('Tarefas'); ?>
    <!-- Inclusão do Javascript da página -->
    <script src="./js/tarefas.js?<?= time(); ?>"></script>
</head>

<body>
    <!-- Navbar/Header -->
    <header>
        <!-- Inclusão do navbar/header -->
        <?php Componentes::header(); ?>
    </header>

    <main class="mt-3 mt-lg-4 container">
        <div class="px-4 py-3 rounded bg-light box-shadow-padrao">
            <!-- Header tabela -->
            <div class="row mt-2 mb-4">
                <div class="col">
                    <span class="fw-bolder fs-3 text-success"><i class="fa-solid fa-list-check"></i>&nbsp;Tarefas</span>
                </div>
                <!-- As ações (atualizar retorno de registros e imprimir relatório) são retornadas através da função na tarefas.js -->
                <div class="col-6 text-end align-self-end" id="acoes_registros">
                </div>
            </div>
            <!-- Tabela com os registros -->
            <div class="table-responsive">
                <!-- As tarefas são retornadas através da função retornaRegistros na tarefas.js -->
                <table class="table table-hover">
                </table>
            </div>
        </div>
        <!-- Floating Button (incluir nova tarefa) é retornado através da função retornaFloatingButton na tarefas.js -->
        <div id="div_floating_button">
        </div>
    </main>
</body>

</html>