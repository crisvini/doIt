// Mostra os campos que precisam ser preenchidos
function alertaPreenchimento(idCampo, idLabel) {
    if ($(idCampo).val() == "") {
        $(idLabel).addClass("alerta-label");
        $(idCampo).addClass("alerta-input");
    } else {
        $(idLabel).removeClass("alerta-label");
        $(idCampo).removeClass("alerta-input");
    }
}

// Valida e-mail
function validacaoEmail(email) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        if (isNaN(email.substr(email.length - 1, 1)))
            return (true);
        else
            return (false);
    }
    return (false);
}

// Esconde senha
function escondeSenha(closeId, openId, inputId) {
    $(openId).removeClass("d-block");
    $(openId).addClass("d-none");
    $(closeId).removeClass("d-none");
    $(closeId).addClass("d-block");
    $(inputId).attr("type", "password");
}

// Mostra senha
function mostraSenha(closeId, openId, inputId) {
    $(closeId).removeClass("d-block");
    $(closeId).addClass("d-none");
    $(openId).removeClass("d-none");
    $(openId).addClass("d-block");
    $(inputId).attr("type", "text");
}

// Logout
function logout() {
    Swal.fire({
        text: 'Tem certeza que deseja sair?',
        icon: 'warning',
        confirmButtonText: 'Sim',
        showDenyButton: true,
        denyButtonText: 'Não',
        background: '#edece6',
        customClass: {
            confirmButton: 'btn-success'
        }
    }).then(function (result) {
        if (result.isConfirmed)
            window.location.href = "./index.php";
    });
}

// Validação de celular
function validacaoCelular(celular) {
    if (celular != "") {
        // Armazena o 6º dígito do celular
        digito = celular.substring(5, 6);
        // Verifica se o celular possui o nono dígito
        if (celular.length == 15) {
            // Verifica se o dígito é válido
            if (digito != 9)
                return false;
            else
                return true;
        } else if (celular.length == 14) {
            // Verifica se o dígito é válido
            if (digito < 6)
                return false;
            else
                return true;
        } else {
            return false;
        }
    }
}