<?php
// Inclusão do arquivo de includes
include_once("./includes/includes.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Inclusão do head -->
    <?php Componentes::head('Cadastro'); ?>
    <!-- Inclusão do Javascript da página -->
    <script src="./js/cadastro.js?<?= time(); ?>"></script>
</head>

<body class="text-center body-login overflow-hidden">
    <main class="m-auto overflow-hidden w-100 form-login">
        <div class="row">
            <div class="col-10 col-md-5 col-lg-3 mx-auto">
                <span class="fs-1 text-success fw-bold">Cadastro</span>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-10 col-md-5 col-lg-3 mx-auto">
                <div class="form-floating">
                    <input type="text" class="form-control" id="nome" placeholder="nome" onchange="alertaPreenchimento('#nome', '#label_nome');">
                    <label id="label_nome" for="nome">Nome</label>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-10 col-md-5 col-lg-3 mx-auto">
                <div class="form-floating">
                    <input type="text" class="form-control" id="telefone" placeholder="telefone" onchange="alertaPreenchimento('#telefone', '#label_telefone');">
                    <label id="label_telefone" for="telefone">Telefone</label>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-10 col-md-5 col-lg-3 mx-auto">
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" placeholder="email@email.com" onchange="alertaPreenchimento('#email', '#label_email');">
                    <label id="label_email" for="email">E-mail</label>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-10 col-md-5 col-lg-3 mx-auto">
                <div class=" form-floating">
                    <i class="fa-solid fa-eye icon-eye d-none fs-5 text-success" id="open_eye" onclick="escondeSenha('#closed_eye', '#open_eye', '#senha');"></i>
                    <i class="fa-solid fa-eye-slash icon-eye d-block fs-5 text-success" id="closed_eye" onclick="mostraSenha('#closed_eye', '#open_eye', '#senha');"></i>
                    <input type="password" class="form-control" id="senha" placeholder="Senha" onchange="alertaPreenchimento('#senha', '#label_senha');">
                    <label id="label_senha" for="senha">Senha</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-10 col-md-5 col-lg-3 mx-auto">
                <button class="w-100 btn btn-lg btn-success rounded" onclick="cadastrarUsuario()">Cadastrar</button>
            </div>
        </div>
    </main>
</body>

</html>