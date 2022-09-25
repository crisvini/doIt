function login() {
    // Valida os dados inseridos e faz login
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
        $.ajax(settings).done(function (result) {
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
        }).then(function () {
            if ($("#email").val() == "" || validacaoEmail($("#email").val())) alertaPreenchimento('#email', '#label_email');
            if ($("#senha").val() == "") alertaPreenchimento('#senha', '#label_senha');
        });
    }
}