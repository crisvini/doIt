$(document).ready(function () {
    retornaUsuarios();
});

// Retorna os usuários
function retornaUsuarios(click = null) {
    // Se o parâmetro click for true, executa o retorno de usuários e exibe um swal
    if (click == true) {
        var settings = {
            url: './ajax/retornaUsuarios.php',
            method: 'POST'
        }
        $.ajax(settings).done(function (result) {
            $("tbody").html(result);
            Swal.fire({
                text: 'Usuários retornados com sucesso!',
                icon: 'success',
                confirmButtonText: 'Ok',
                background: '#edece6',
                customClass: {
                    confirmButton: 'btn-success'
                }
            });
        });
    } else {
        // Caso contrário, somente executa o retorno de usuários
        var settings = {
            url: './ajax/retornaUsuarios.php',
            method: 'POST'
        }
        $.ajax(settings).done(function (result) {
            $("tbody").html(result);
        });
    }
}

// Exclui usuário
function excluirUsuario(idExclusao) {
    Swal.fire({
        text: 'Tem certeza que deseja excluir este usuário?',
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
            // Apaga o usuário
            var settings = {
                url: './ajax/excluirUsuario.php',
                method: 'POST',
                data: {
                    id: idExclusao.split("_")[1]
                },
            }
            $.ajax(settings).done(function (result) {
                if (result == "Ok") {
                    Swal.fire({
                        text: 'Usuário excluido com sucesso!',
                        icon: 'success',
                        confirmButtonText: 'Ok',
                        background: '#edece6',
                        customClass: {
                            confirmButton: 'btn-success'
                        }
                    }).then(() => {
                        retornaUsuarios();
                    });
                }
            });
        }
    });
}

// Editar as permissões do usuário
function editarPermissoesUsuarios(idUsuario) {
    var settings = {
        url: './ajax/retornaDadosUsuario.php',
        method: 'POST',
        data: {
            id: idUsuario.split("_")[1]
        }
    }
    $.ajax(settings).done(function (result) {
        var dadosUsuario = result;
        console.log(dadosUsuario);
        Swal.fire({
            title: 'Atualizar permissões',
            confirmButtonText: 'Atualizar',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            html: '<div class="row w-100 mx-auto mt-3">' +
                '<div class="col-12 mt-3">' +
                '<div class="form-floating">' +
                '<select class="form-select" id="permissao_visualizar">' +
                JSON.parse(dadosUsuario)["permissao_visualizar"] +
                '</select>' +
                '<label for="permissao_visualizar" id="label_permissao_visualizar">Visualização</label>' +
                '</div>' +
                '</div>' +
                '<div class="col-12 mt-3">' +
                '<div class="form-floating">' +
                '<select class="form-select" id="permissao_editar">' +
                JSON.parse(dadosUsuario)["permissao_editar"] +
                '</select>' +
                '<label for="permissao_editar" id="permissao_editar">Edição</label>' +
                '</div>' +
                '</div>' +
                '<div class="col-12 mt-3">' +
                '<div class="form-floating">' +
                '<select class="form-select" id="permissao_cadastrar">' +
                JSON.parse(dadosUsuario)["permissao_cadastrar"] +
                '</select>' +
                '<label for="permissao_cadastrar" id="permissao_cadastrar">Cadastro</label>' +
                '</div>' +
                '</div>' +
                '<div class="col-12 mt-3">' +
                '<div class="form-floating">' +
                '<select class="form-select" id="permissao_excluir">' +
                JSON.parse(dadosUsuario)["permissao_excluir"] +
                '</select>' +
                '<label for="permissao_excluir" id="permissao_excluir">Exclusão</label>' +
                '</div>' +
                '</div>' +
                '<div class="col-12 mt-3">' +
                '<div class="form-floating">' +
                '<select class="form-select" id="permissao_imprimir">' +
                JSON.parse(dadosUsuario)["permissao_imprimir"] +
                '</select>' +
                '<label for="permissao_imprimir" id="permissao_imprimir">Impressão</label>' +
                '</div>' +
                '</div>' +
                '</div>',
            preConfirm: () => {
                var settings = {
                    url: './ajax/editarPermissaoUsuario.php',
                    method: 'POST',
                    data: {
                        permissao_visualizar: $("#permissao_visualizar").val(),
                        permissao_editar: $("#permissao_editar").val(),
                        permissao_cadastrar: $("#permissao_cadastrar").val(),
                        permissao_excluir: $("#permissao_excluir").val(),
                        permissao_imprimir: $("#permissao_imprimir").val(),
                        id_usuario: idUsuario.split("_")[1]
                    },
                }
                $.ajax(settings).done(function (result) {
                    if (result == 'Ok') {
                        Swal.fire({
                            text: 'Permissões atualizadas com sucesso!',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                            background: '#edece6',
                            customClass: {
                                confirmButton: 'btn-success'
                            }
                        }).then(() => {
                            retornaUsuarios();
                        });
                    } else {
                        Swal.fire({
                            title: 'Ops!',
                            text: 'Não foi possível atualizar as permissões, tente novamente mais tarde',
                            icon: 'error',
                            confirmButtonText: 'Ok',
                            background: '#edece6',
                            customClass: {
                                confirmButton: 'btn-success'
                            }
                        });
                    }
                });
            },
            background: '#edece6',
            customClass: {
                confirmButton: 'btn-success'
            }
        });
    });
}