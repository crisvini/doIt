$(document).ready(function () {
    retornaRegistros();
});

function insereTarefa() {
    Swal.fire({
        title: 'Incluir nova tarefa',
        confirmButtonText: 'Incluir',
        html: '<div class="row w-100 mx-auto mt-3">' +
            '<div class="col-12">' +
            '<div class="form-floating">' +
            '<input type="text" class="form-control" id="nomeTarefa" placeholder="nomeTarefa" onchange="alertaPreenchimento(' + "'#nomeTarefa', '#label_nomeTarefa'" + ');">' +
            '<label id="label_nomeTarefa" for="nomeTarefa">Nome</label>' +
            '</div>' +
            '</div>' +
            '<div class="col-12 mt-3">' +
            '<div class="form-floating">' +
            '<input type="text" class="form-control" id="descricaoTarefa" placeholder="descricaoTarefa" onchange="alertaPreenchimento(' + "'#descricaoTarefa', '#label_descricaoTarefa'" + ');">' +
            '<label id="label_descricaoTarefa" for="descricaoTarefa">Descricao</label>' +
            '</div>' +
            ' </div>' +
            '</div>',
        preConfirm: () => {
            if ($("#nomeTarefa").val() == "" && $("#descricaoTarefa").val() == "") {
                alertaPreenchimento("#nomeTarefa", "#label_nomeTarefa");
                alertaPreenchimento("#descricaoTarefa", "#label_descricaoTarefa");
                return false;
            } else if ($("#nomeTarefa").val() == "") {
                alertaPreenchimento("#nomeTarefa", "#label_nomeTarefa");
                return false;
            } else if ($("#descricaoTarefa").val() == "") {
                alertaPreenchimento("#descricaoTarefa", "#label_descricaoTarefa");
                return false;
            } else {
                var settings = {
                    url: './ajax/insereTarefa.php',
                    method: 'POST',
                    data: {
                        nome: $("#nomeTarefa").val(),
                        descricao: $("#descricaoTarefa").val()
                    },
                }
                $.ajax(settings).done(function (result) {
                    if (result == 'Ok') {
                        Swal.fire({
                            text: 'Tarefa inclusa com sucesso!',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                            background: '#edece6',
                            customClass: {
                                confirmButton: 'btn-success'
                            }
                        }).then(() => {
                            retornaRegistros();
                        });
                    } else {
                        Swal.fire({
                            title: 'Ops!',
                            text: 'Não foi possível incluir a tarefa, tente novamente mais tarde',
                            icon: 'error',
                            confirmButtonText: 'Ok',
                            background: '#edece6',
                            customClass: {
                                confirmButton: 'btn-success'
                            }
                        });
                    }
                });
            }
        },
        background: '#edece6',
        customClass: {
            confirmButton: 'btn-success'
        }
    });
}

function excluirTarefa(idExclusao) {
    Swal.fire({
        text: 'Tem certeza que deseja apagar esta tarefa?',
        icon: 'warning',
        confirmButtonText: 'Sim',
        denyButtonText: 'Não',
        showDenyButton: true,
        background: '#edece6',
        customClass: {
            confirmButton: 'btn-success'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            var settings = {
                url: './ajax/excluirTarefa.php',
                method: 'POST',
                data: {
                    id: idExclusao.split("_")[1]
                },
            }
            $.ajax(settings).done(function (result) {
                if (result == "Ok") {
                    Swal.fire({
                        text: 'Tarefa excluída com sucesso!',
                        icon: 'success',
                        confirmButtonText: 'Ok',
                        background: '#edece6',
                        customClass: {
                            confirmButton: 'btn-success'
                        }
                    }).then(() => {
                        retornaRegistros();
                    });
                }
            });
        }
    });
}

function retornaRegistros(click = null) {
    if (click == true) {
        var settings = {
            url: './ajax/retornaRegistros.php',
            method: 'POST'
        }
        $.ajax(settings).done(function (result) {
            $("tbody").html(result);
            Swal.fire({
                text: 'Registros retornados com sucesso!',
                icon: 'success',
                confirmButtonText: 'Ok',
                background: '#edece6',
                customClass: {
                    confirmButton: 'btn-success'
                }
            });
        });
    } else {
        var settings = {
            url: './ajax/retornaRegistros.php',
            method: 'POST'
        }
        $.ajax(settings).done(function (result) {
            $("tbody").html(result);
        });
    }
}