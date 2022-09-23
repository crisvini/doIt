<?php
include_once("./includes/includes.php");
$_SESSION = array(); // Limpa a session
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
                <span class="fs-1 text-success fw-bold">Login</span>
            </div>
        </div>
        <div class="row mt-4">
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
                <button class="w-100 btn btn-lg btn-success rounded" id="login_btn">Entrar</button>
            </div>
        </div>
        <div class="row mt-3">
            <span>Não tem uma conta? <a href="./cadastro.php" class="link-success">Cadastre-se</a></span>
        </div>
    </main>

    <script>
        // Valida os dados inseridos e faz login
        $("#login_btn").click(function() {
            if ($("#email").val() != "" && validacaoEmail($("#email").val()) == true && $("#senha").val() != "") {
                // Faz o login se os dados forem válidos
                var settings = {
                    url: './ajax/login.php',
                    method: 'POST',
                    data: {
                        email: $("#email").val(),
                        senha: $("#senha").val()
                    },
                }
                $.ajax(settings).done(function(result) {
                    if (result == true) {
                        window.location.href = "./home.php"
                    } else {
                        Swal.fire({
                            title: 'Ops!',
                            text: 'E-mail e/ou senha inválida',
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
                    text: 'Insira seu e-mail e/ou senha',
                    icon: 'error',
                    confirmButtonText: 'Ok',
                    background: '#edece6',
                    customClass: {
                        confirmButton: 'btn-success'
                    }
                }).then(function() {
                    if ($("#email").val() == "" || validacaoEmail($("#email").val())) alertaPreenchimento('#email', '#label_email');
                    if ($("#senha").val() == "") alertaPreenchimento('#senha', '#label_senha');
                });
            }
        });
    </script>
</body>

</html>