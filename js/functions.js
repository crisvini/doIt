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
        if (isNaN(email.substr(email.length - 1, 1))) return (true);
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