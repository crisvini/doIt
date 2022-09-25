$(document).ready(function () {
    retornaBotoes();
});

function retornaBotoes() {
    var settings = {
        url: './ajax/retornaBotoesHome.php',
        method: 'POST'
    }
    $.ajax(settings).done(function (result) {
        $("#home_buttons").html(result);
    });
}