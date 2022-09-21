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