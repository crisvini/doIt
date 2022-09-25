<?php
// Inclusão do arquivo de includes
include_once("./includes/includes.php");
// Função que verifica se o usuário está autenticado
Funcoes::verificaLogin();
// Função que verifica se o usuário é admin
Funcoes::verificaAdmin();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Inclusão do head -->
    <?php Componentes::head('Usuários'); ?>
    <!-- Inclusão do Javascript da página -->
    <script src="./js/usuarios.js?<?= time(); ?>"></script>
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
                    <span class="fw-bolder fs-3 text-success"><i class="fa-solid fa-user"></i>&nbsp;Usuários</span>
                </div>
                <div class="col-6 text-end align-self-end">
                    <i class="pointer success-hover fa-solid fa-rotate-right text-success fs-4 me-3 me-lg-4" onclick="retornaUsuarios(true);"></i>
                </div>
            </div>
            <!-- Tabela com os registros -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-success" scope="col">Id</th>
                            <th class="text-success" scope="col">Nome</th>
                            <th class="text-success" scope="col">Telefone</th>
                            <th class="text-success" scope="col">E-mail</th>
                            <th class="text-success" scope="col">Visualização</th>
                            <th class="text-success" scope="col">Edição</th>
                            <th class="text-success" scope="col">Cadastro</th>
                            <th class="text-success" scope="col">Exclusão</th>
                            <th class="text-success" scope="col">Impressão</th>
                            <th class="text-success text-center" scope="col">Editar Permissões</th>
                            <th class="text-success text-center" scope="col">Excluir Usuário</th>
                        </tr>
                    </thead>
                    <!-- Os usuários são retornadas através da função retornaUsuarios na usuarios.js -->
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>