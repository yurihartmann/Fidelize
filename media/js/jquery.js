$(document).ready(function () {


    // MASCARAS

    $('#inputNumberCupom').mask('(00) 00000-0000');

    // INICIA A VERIFICACAO
    if (typeof($("#inputNomeCupom")).val() !== "undefined"){
        let loopverifica = setInterval(verificaDadosCupom, 100);
    }

    function verificaDadosCupom() {
        let inputNomeCupom = $('#inputNomeCupom');
        let inputDescricaoCupom = $('#inputDescricaoCupom');
        let inputObjetivoCupom = $('#inputObjetivoCupom');
        let inputPremioCupom = $('#inputPremioCupom');
        let valid = true;


            if (inputNomeCupom.val().length == 0) {
                inputNomeCupom.removeClass('is-valid');
                inputNomeCupom.addClass('is-invalid');
                valid = false;
            } else {
                inputNomeCupom.removeClass('is-invalid');
                inputNomeCupom.addClass('is-valid');
            }
            if (inputDescricaoCupom.val().length == 0) {
                inputDescricaoCupom.removeClass('is-valid');
                inputDescricaoCupom.addClass('is-invalid');
                valid = false;
            } else {
                inputDescricaoCupom.removeClass('is-invalid');
                inputDescricaoCupom.addClass('is-valid');
            }
            if (inputObjetivoCupom.val().length == 0) {
                inputObjetivoCupom.removeClass('is-valid');
                inputObjetivoCupom.addClass('is-invalid');
                valid = false;
            } else {
                inputObjetivoCupom.removeClass('is-invalid');
                inputObjetivoCupom.addClass('is-valid');
            }
            if (inputPremioCupom.val().length == 0) {
                inputPremioCupom.removeClass('is-valid');
                inputPremioCupom.addClass('is-invalid');
                valid = false;
            } else {
                inputPremioCupom.removeClass('is-invalid');
                inputPremioCupom.addClass('is-valid');
            }

            console.log(valid)

        return valid;

    }


    $('#btnSalvarCupom').click(function (e) {
        let btnSalvarCupom = $('#btnSalvarCupom');
        e.preventDefault();

        if (verificaDadosCupom()) {
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