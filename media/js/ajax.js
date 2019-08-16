$(document).ready(function () {


    let view_badge = $('#badgeCuponsAtivos');
    badgeCuponsAtivos();


    function badgeCuponsAtivos() {
        $.ajax({
            url: 'ajax/numCartoesAtivos.php',
            type: 'POST',
            data: {
                id_loja: '1',
            },
            success: function (data) {
                view_badge.html(data);
            },
            beforeSend: function () {
                view_badge.html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>');
            }
        });
        console.log("badgeCuponsAtivos Carregado!")
    }

    let view_clientes_fidelizados = $('#painel_clientes_fidelizados');
    clientesFidelizados();
    setInterval(clientesFidelizados, 10000);

    function clientesFidelizados() {
        $.ajax({
            url: 'ajax/numClientesFidelizados.php',
            type: 'POST',
            data: {
                id_loja: '1',
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
        console.log("clientesFidelizados Carregado!")
    }

    let view_cupons_completados = $('#painel_cupons_completados');
    cuponsCompletados();
    setInterval(cuponsCompletados, 10000);

    function cuponsCompletados() {
        $.ajax({
            url: 'ajax/numCopunsCompletados.php',
            type: 'POST',
            data: {
                id_loja: '1',
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

    $('#btnSalvarCupom').click(function (e) {

        e.preventDefault();

        let inputNomeCupom = $('#inputNomeCupom');
        let inputDescricaoCupom = $('#inputDescricaoCupom');
        let inputObjetivoCupom = $('#inputObjetivoCupom');
        let inputPremioCupom = $('#inputPremioCupom');
        let valido = false;

        if (inputNomeCupom.val().length == 0 || inputDescricaoCupom.val().length == 0 || inputObjetivoCupom.val().length == 0 || inputPremioCupom.val().length == 0 ) {
            if (inputNomeCupom.val().length == 0){
                inputNomeCupom.removeClass('is-valid');
                inputNomeCupom.addClass('is-invalid');
            } else {
                inputNomeCupom.removeClass('is-invalid');
                inputNomeCupom.addClass('is-valid');
            }
            if (inputDescricaoCupom.val().length == 0){
                inputDescricaoCupom.removeClass('is-valid');
                inputDescricaoCupom.addClass('is-invalid');
            } else {
                inputDescricaoCupom.removeClass('is-invalid');
                inputDescricaoCupom.addClass('is-valid');
            }
            if (inputObjetivoCupom.val().length == 0){
                inputObjetivoCupom.removeClass('is-valid');
                inputObjetivoCupom.addClass('is-invalid');
            } else {
                inputObjetivoCupom.removeClass('is-invalid');
                inputObjetivoCupom.addClass('is-valid');
            }
            if (inputPremioCupom.val().length == 0){
                inputPremioCupom.removeClass('is-valid');
                inputPremioCupom.addClass('is-invalid');
            } else {
                inputPremioCupom.removeClass('is-invalid');
                inputPremioCupom.addClass('is-valid');
            }
        } else {
            let btnSalvarCupom = $('#btnSalvarCupom');
            btnSalvarCupom.removeClass('btn-success');
            btnSalvarCupom.addClass('btn-secondary');
            btnSalvarCupom.attr('disabled', true);
            btnSalvarCupom.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Carregando...');
            $('#formSalvarCupom').submit();
        }
    });


    $('#btnSalvarCarimbo').click(function () {

        let btnSalvarCarimbo = $('#btnSalvarCarimbo');
        btnSalvarCarimbo.removeClass('btn-success');
        btnSalvarCarimbo.addClass('btn-secondary');
        btnSalvarCarimbo.attr('disabled', true);
        btnSalvarCarimbo.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Carregando...');
        $('#formSalvarCarimbo').submit();
    });


});