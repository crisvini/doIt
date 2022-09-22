<?php
session_start();
$_SESSION = array(); // Limpa a session
include_once("./class/Componentes.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <?php Componentes::head('Login'); ?>
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
                <button class="w-100 btn btn-lg btn-success rounded" id="cadastrar_btn">Cadastrar</button>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $("#telefone").mask("(00) 00000-0000");
        });

        // Realiza o cadastro
        $("#cadastrar_btn").click(function() {
            if ($("#nome").val() != "" && $("#telefone").val() != "" && $("#email").val() != "" && validacaoEmail($("#email").val()) == true && $("#senha").val() != "") {
                // Faz o cadastro se os dados forem válidos
                var settings = {
                    url: './ajax/cadastroUsuario.php',
                    method: 'POST',
                    data: {
                        nome: $("#nome").val(),
                        telefone: $("#telefone").val(),
                        email: $("#email").val(),
                        senha: $("#senha").val()
                    },
                }
                $.ajax(settings).done(function(result) {
                    if (result == "Ok") {
                        Swal.fire({
                            text: 'Usuário criado com sucesso!',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                            background: '#edece6',
                            customClass: {
                                confirmButton: 'btn-success'
                            }
                        }).then(function() {
                            window.location.href = "./home.php";
                        });
                    } else {
                        Swal.fire({
                            title: 'Ops!',
                            text: result,
                            icon: 'error',
                            confirmButtonText: 'Ok',
                            background: '#edece6',
                            customClass: {
                                confirmButton: 'btn-success'
                            }
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: 'Ops!',
                    text: 'Insira seus dados corretamente',
                    icon: 'error',
                    confirmButtonText: 'Ok',
                    background: '#edece6',
                    customClass: {
                        confirmButton: 'btn-success'
                    }
                }).then(function() {
                    if ($("#nome").val() == "") alertaPreenchimento('#nome', '#label_nome');
                    if ($("#telefone").val() == "") alertaPreenchimento('#telefone', '#label_telefone');
                    if ($("#email").val() == "" || validacaoEmail($("#email").val())) alertaPreenchimento('#email', '#label_email');
                    if ($("#senha").val() == "") alertaPreenchimento('#senha', '#label_senha');
                });
            }
        });
    </script>
</body>

</html>