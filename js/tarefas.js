$(document).ready(function () {
    retornaAcoesRegistros();
    retornaRegistros();
    retornaFloatingButton();
});

// Retorna as tarefas
function retornaRegistros(click = null) {
    // Se o click (parâmetro) for verdadeiro, retorna as tarefas e um swal positivo
    if (click == true) {
        var settings = {
            url: './ajax/retornaTarefas.php',
            method: 'POST'
        }
        $.ajax(settings).done(function (result) {
            $("table").html(result);
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
        // Caso contrário, retorna somente as tarefas 
        var settings = {
            url: './ajax/retornaTarefas.php',
            method: 'POST'
        }
        $.ajax(settings).done(function (result) {
            $("table").html(result);
        });
    }
}

// Retorna os botões de ação da tabela (botão de baixar excel, baixar pdf e recarregar registros)
function retornaAcoesRegistros() {
    var settings = {
        url: './ajax/retornaPermissaoImprimir.php',
        method: 'POST'
    }
    $.ajax(settings).done(function (result) {
        $("#acoes_registros").html(result);
    });
}

// Retorna o botão de inserção de tarefas
function retornaFloatingButton() {
    var settings = {
        url: './ajax/retornaPermissaoCadastrar.php',
        method: 'POST'
    }
    $.ajax(settings).done(function (result) {
        $("#div_floating_button").html(result);
    });
}

// Insere uma nova tarefa
function insereTarefa() {
    Swal.fire({
        title: 'Incluir nova tarefa',
        confirmButtonText: 'Incluir',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        html: '<div class="row w-100 mx-auto mt-3">' +
            '<div class="col-12">' +
            '<div class="form-floating">' +
            '<input type="text" class="form-control" id="nomeTarefa" placeholder="nomeTarefa" onchange="alertaPreenchimento(' + "'#nomeTarefa', '#label_nomeTarefa'" + ');">' +
            '<label id="label_nomeTarefa" for="nomeTarefa">Nome</label>' +
            '</div>' +
            '</div>' +
            '<div class="col-12 mt-3">' +
            '<div class="form-floating">' +
            '<textarea type="text" class="form-control" id="descricaoTarefa" placeholder="descricaoTarefa" onchange="alertaPreenchimento(' + "'#descricaoTarefa', '#label_descricaoTarefa'" + ');"></textarea>' +
            '<label id="label_descricaoTarefa" for="descricaoTarefa">Descricao</label>' +
            '</div>' +
            ' </div>' +
            '</div>',
        preConfirm: () => {
            // Verifica o preenchimento correto dos dados
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
                // Se os dados tiverem sido digitados corretamente, insere a nova tarefa 
                var settings = {
                    url: './ajax/insereTarefa.php',
                    method: 'POST',
                    data: {
                        nome: $("#nomeTarefa").val(),
                        descricao: $("#descricaoTarefa").val()
                    },
                }
                $.ajax(settings).done(function (result) {
                    // Se a tarefa for inserida com sucesso, retorna os registros novamente
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

// Edita tarefa
function editarTarefa(idEdicao) {
    // Busca os dados da tarefa
    var settings = {
        url: './ajax/retornaDadosTarefa.php',
        method: 'POST',
        data: {
            id: idEdicao.split("_")[1]
        }
    }
    $.ajax(settings).done(function (result) {
        var dadosTarefa = result;
        var status;
        // Busca o status da tarefa
        var settings = {
            url: './ajax/retornaStatus.php',
            method: 'POST',
            data: {
                "id": idEdicao.split("_")[1]
            }
        }
        $.ajax(settings).done(function (result) {
            status = result;
            Swal.fire({
                title: 'Atualizar tarefa',
                confirmButtonText: 'Atualizar',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                html: '<div class="row w-100 mx-auto mt-3">' +
                    '<div class="col-12">' +
                    '<div class="form-floating">' +
                    '<input type="text" class="form-control" id="nomeTarefa" placeholder="nomeTarefa" onchange="alertaPreenchimento(' + "'#nomeTarefa', '#label_nomeTarefa'" + ');" value="' + JSON.parse(dadosTarefa)["nome"] + '">' +
                    '<label id="label_nomeTarefa" for="nomeTarefa">Nome</label>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-12 mt-3">' +
                    '<div class="form-floating">' +
                    '<textarea type="text" class="form-control" id="descricaoTarefa" placeholder="descricaoTarefa" onchange="alertaPreenchimento(' + "'#descricaoTarefa', '#label_descricaoTarefa'" + ');">' + JSON.parse(dadosTarefa)["descricao"] + '</textarea>' +
                    '<label id="label_descricaoTarefa" for="descricaoTarefa">Descricao</label>' +
                    '</div>' +
                    ' </div>' +
                    '<div class="col-12 mt-3">' +
                    '<div class="form-floating">' +
                    '<select class="form-select" id="status">' +
                    status +
                    '</select>' +
                    '<label for="status" id="label_status">Status</label>' +
                    '</div>' +
                    '</div>' +
                    '</div>',
                preConfirm: () => {
                    if ($("#nomeTarefa").val() == "" && $("#descricaoTarefa").val() == "" && $("#status").val() == "") {
                        alertaPreenchimento("#nomeTarefa", "#label_nomeTarefa");
                        alertaPreenchimento("#descricaoTarefa", "#label_descricaoTarefa");
                        alertaPreenchimento("#status", "#label_status");
                        return false;
                    } else if ($("#nomeTarefa").val() == "") {
                        alertaPreenchimento("#nomeTarefa", "#label_nomeTarefa");
                        return false;
                    } else if ($("#descricaoTarefa").val() == "") {
                        alertaPreenchimento("#descricaoTarefa", "#label_descricaoTarefa");
                        return false;
                    } else if ($("#status").val() == "") {
                        alertaPreenchimento("#status", "#label_status");
                        return false;
                    } else {
                        // Atualiza a tarefa
                        var settings = {
                            url: './ajax/editarTarefa.php',
                            method: 'POST',
                            data: {
                                nome: $("#nomeTarefa").val(),
                                descricao: $("#descricaoTarefa").val(),
                                status: $("#status").val(),
                                id_tarefa: idEdicao.split("_")[1]
                            },
                        }
                        $.ajax(settings).done(function (result) {
                            if (result == 'Ok') {
                                Swal.fire({
                                    text: 'Tarefa atualizada com sucesso!',
                                    icon: 'success',
                                    confirmButtonText: 'Ok',
                                    background: '#edece6',
                                    customClass: {
                                        confirmButton: 'btn-success'
                                    }
                                }).then(() => {
                                    // Retorna os registros novamente
                                    retornaRegistros();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Ops!',
                                    text: 'Não foi possível atualizar a tarefa, tente novamente mais tarde',
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
        });
    });
}

// Função que exibe um swal de erro
function erroPermissao(erro) {
    Swal.fire({
        title: 'Ops!',
        text: erro,
        icon: 'error',
        confirmButtonText: 'Ok',
        background: '#edece6',
        customClass: {
            confirmButton: 'btn-success'
        }
    });
}

// Exclui tarefas
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
            // Apaga a tarefa selecionada
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

// Baixa o relatório de tarefas em formato .xls
function baixarExcel() {
    window.location.href = "./ajax/relatorioTarefasExcel.php";
}

// Baixa o relatório de tarefas em formato .pdf
function baixarPdf() {
    window.open("./ajax/relatorioTarefasPdf.php");
}