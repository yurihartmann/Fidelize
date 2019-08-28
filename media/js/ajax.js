$(document).ready(function () {


    let view_badge = $('#badgeCuponsAtivos');
    badgeCuponsAtivos();


    function badgeCuponsAtivos() {
        $.ajax({
            url: 'ajax/numCartoesAtivos.php',
            type: 'POST',
            data: {

            },
            success: function (data) {
                view_badge.html(data);
            },
            beforeSend: function () {
                view_badge.html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>');
            }
        });
    }

    let view_clientes_fidelizados = $('#painel_clientes_fidelizados');
    clientesFidelizados();
    setInterval(clientesFidelizados, 10000);

    function clientesFidelizados() {
        $.ajax({
            url: 'ajax/numClientesFidelizados.php',
            type: 'POST',
            data: {
            },
            success: function (data) {
                view_clientes_fidelizados.html(data);
                view_clientes_fidelizados.addClass('h2');
            },
            beforeSend: function () {
                view_clientes_fidelizados.removeClass('h2');
                view_clientes_fidelizados.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            }
        });
    }

    let view_cupons_completados = $('#painel_cupons_completados');
    cuponsCompletados();
    setInterval(cuponsCompletados, 10000);

    function cuponsCompletados() {
        $.ajax({
            url: 'ajax/numCopunsCompletados.php',
            type: 'POST',
            data: {
            },
            success: function (data) {
                view_cupons_completados.html(data);
                view_cupons_completados.addClass('h2');
            },
            beforeSend: function () {
                view_cupons_completados.removeClass('h2');
                view_cupons_completados.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            }
        });
    }


    let view_cupons_ativos = $('#painel_cupons_ativos');
    cuponsAtivos();
    setInterval(cuponsAtivos, 10000);

    function cuponsAtivos() {
        $.ajax({
            url: 'ajax/numCartoesAtivos.php',
            type: 'POST',
            data: {

            },
            success: function (data) {
                view_cupons_ativos.html(data);
                view_cupons_ativos.addClass('h2');
            },
            beforeSend: function () {
                view_cupons_ativos.removeClass('h2');
                view_cupons_ativos.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            }
        });
    }

});