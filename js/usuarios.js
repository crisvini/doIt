$(document).ready(function () {
    retornaUsuarios();
});

function retornaUsuarios() {
    var settings = {
        url: './ajax/retornaUsuarios.php',
        method: 'POST'
    }
    $.ajax(settings).done(function (result) {
        $("tbody").html(result);
    });
}

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