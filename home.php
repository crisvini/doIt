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

    <main class="mt-3 mt-lg-4 container">
        <div class="px-4 py-3 rounded bg-light box-shadow-padrao">
            <!-- Header tabela -->
            <div class="row mt-2 mb-4">
                <div class="col">
                    <span class="fw-bolder fs-3 text-success"><i class="fa-solid fa-list-check"></i>&nbsp;Tarefas</span>
                </div>
                <div class="col-6 text-end align-self-end">
                    <i class="pointer success-hover fa-solid fa-rotate-right text-success fs-4 me-3 me-lg-4" onclick="retornaRegistros(true);"></i>
                    <i class="pointer success-hover fa-solid fa-file-excel text-success fs-4 me-3 me-lg-4"></i>
                    <i class="pointer success-hover fa-solid fa-file-pdf text-success fs-4"></i>
                </div>
            </div>
            <!-- Tabela com os registros -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-success" scope="col">Nome</th>
                            <th class="text-success" scope="col">Descrição</th>
                            <th class="text-success" scope="col">Criação</th>
                            <th class="text-success" scope="col">Conclusão</th>
                            <th class="text-success" scope="col">Status</th>
                            <th class="text-success text-center" scope="col">Editar</th>
                            <th class="text-success text-center" scope="col">Excluir</th>
                        </tr>
                    </thead>
                    <!-- Os registros são inseridos no tbody através do arquivo ./js/home.js -->
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Floating Button (incluir nova tarefa) -->
        <div class="floating-btn pointer success-hover-background box-shadow-padrao" onclick="insereTarefa();">
            <i class="fa fa-plus plus"></i>
        </div>
    </main>
</body>

</html>