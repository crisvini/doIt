$(document).ready(function () {
    // Máscara de telefone
    $("#telefone").mask("(00) 00000-0000");
});

// Cadasta novo usuário
function cadastrarUsuario() {
    if ($("#nome").val() != "" && $("#telefone").val() != "" && validacaoCelular($("#telefone").val()) == true && $("#email").val() != "" && validacaoEmail($("#email").val()) == true && $("#senha").val() != "") {
        // Faz o cadastro se os dados forem válidos e estiverem preenchidos
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
        $.ajax(settings).done(function (result) {
            if (result == "Ok") {
                Swal.fire({
                    text: 'Usuário criado com sucesso!',
                    icon: 'success',
                    confirmButtonText: 'Ok',
                    background: '#edece6',
                    customClass: {
                        confirmButton: 'btn-success'
                    }
                }).then(function () {
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
                }).then(function () {
                    if (result == 'Telefone e e-mail já cadastrados') {
                        $("#telefone").val("");
                        alertaPreenchimento('#telefone', '#label_telefone');
                        $("#email").val("");
                        alertaPreenchimento('#email', '#label_email');
                    } else if (result == 'Telefone já cadastrado') {
                        $("#telefone").val("");
                        alertaPreenchimento('#telefone', '#label_telefone');
                    } else if (result == 'E-mail já cadastrado') {
                        $("#email").val("");
                        alertaPreenchimento('#email', '#label_email');
                    }
                });
            }
        });
        // Valida o celular
    } else if (validacaoCelular($("#telefone").val()) == false) {
        Swal.fire({
            title: 'Ops!',
            text: 'Insira um celular válido',
            icon: 'error',
            confirmButtonText: 'Ok',
            background: '#edece6',
            customClass: {
                confirmButton: 'btn-success'
            }
        }).then(function () {
            $("#telefone").val("");
            alertaPreenchimento('#telefone', '#label_telefone');
        });
        // Valida o e-mail
    } else if (validacaoEmail($("#email").val()) == false) {
        Swal.fire({
            title: 'Ops!',
            text: 'Insira um e-mail válido',
            icon: 'error',
            confirmButtonText: 'Ok',
            background: '#edece6',
            customClass: {
                confirmButton: 'btn-success'
            }
        }).then(function () {
            $("#email").val("");
            alertaPreenchimento('#email', '#label_email');
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
        }).then(function () {
            if ($("#nome").val() == "") alertaPreenchimento('#nome', '#label_nome');
            if ($("#telefone").val() == "") alertaPreenchimento('#telefone', '#label_telefone');
            if ($("#email").val() == "" || validacaoEmail($("#email").val())) alertaPreenchimento('#email', '#label_email');
            if ($("#senha").val() == "") alertaPreenchimento('#senha', '#label_senha');
        });
    }
}