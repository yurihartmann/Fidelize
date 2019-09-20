$(document).ready(function () {

    bsCustomFileInput.init();

    $('.counter').each(function() {
        var $this = $(this),
            countTo = $this.attr('data-count');
        
        $({ countNum: $this.text()}).animate({
                countNum: countTo
            },
            {
                duration: 2500,
                easing:'swing',
                step: function() {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function() {
                    $this.text(this.countNum);
                }

            });

    });

    // MASCARAS

    $('#inputNumberCupom').mask('(00) 00000-0000');
    $('#inputDataInicio').mask('00/00/0000 00:00');
    $('#inputDataFinal').mask('00/00/0000 00:00');
    $('#inputValorPremio').mask('000.000.000.000.000,00', {
        reverse: true
    });

    // INICIA A VERIFICACAO
    if (typeof ($("#inputNomeCupom")).val() !== "undefined") {
        let loopverifica = setInterval(verificaDadosCupom, 100);
    }

    function verificaDadosCupom() {
        let inputNomeCupom = $('#inputNomeCupom');
        let inputDescricaoCupom = $('#inputDescricaoCupom');
        let inputObjetivoCupom = $('#inputObjetivoCupom');
        let inputPremioCupom = $('#inputPremioCupom');
        let inputValorPremio = $('#inputValorPremio');
        let inputDataInicio = $('#inputDataInicio');
        let inputDataFinal = $('#inputDataFinal');

        let inputDataInicioFeedback = $('#inputDataInicioFeedback');
        let inputDataFinalFeedback = $('#inputDataFinalFeedback');
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
        if (inputObjetivoCupom.val() < 1) {
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
        if (inputValorPremio.val().length == 0) {
            inputValorPremio.removeClass('is-valid');
            inputValorPremio.addClass('is-invalid');
        } else {
            inputValorPremio.removeClass('is-invalid');
            inputValorPremio.addClass('is-valid');
        }
        if (inputDataInicio.val().length < 16) {
            inputDataInicio.removeClass('is-valid');
            inputDataInicio.addClass('is-invalid');
            inputDataInicioFeedback.html("A data de inicio deve ser maior que a data atual!");
            valid = false;
        } else {
            if (inputDataInicio.val().length == 16) {
                let entradaDataInicio = inputDataInicio.val();
                entradaDataInicio = entradaDataInicio.split(" ");
                let dataInicio = entradaDataInicio[0].split("/");
                let horaInicio = entradaDataInicio[1].split(":");
                var dateInicio = new Date(dataInicio[2], (dataInicio[1] - 1), dataInicio[0], horaInicio[0], dataInicio[1]);
                var dateAtual = new Date();

                console.log(dateInicio);

                if (dateAtual.getTime() < dateInicio.getTime()) {
                    inputDataInicio.removeClass('is-invalid');
                    inputDataInicio.addClass('is-valid');
                    inputDataInicioFeedback.html("A data de inicio deve ser maior que a data atual!");
                } else {
                    valid = false;
                    inputDataInicioFeedback.html("");
                }
            }
        }
        if (inputDataFinal.val().length < 16) {
            inputDataFinal.removeClass('is-valid');
            inputDataFinal.addClass('is-invalid');
            valid = false;
            inputDataFinalFeedback.html("A data final deve ser maior que a data de inicio!");
        } else {
            if (inputDataFinal.val().length == 16) {
                let entradaDataFinal = inputDataFinal.val();
                entradaDataFinal = entradaDataFinal.split(" ");
                let dataFinal = entradaDataFinal[0].split("/");
                let horaFinal = entradaDataFinal[1].split(":");
                var dateFinal = new Date(dataFinal[2], (dataFinal[1] - 1), dataFinal[0], horaFinal[0], horaFinal[1]);

                if (dateFinal.getTime() > dateInicio.getTime() + 10000000) {
                    inputDataFinal.removeClass('is-invalid');
                    inputDataFinal.addClass('is-valid');
                    inputDataFinalFeedback.html("");
                }
            } else {
                valid = false;
                inputDataFinalFeedback.html("A data final deve ser maior que a data de inicio!");
            }
        }

        return valid;

    }


    $('#btnSalvarCupom').click(function (e) {
        let btnSalvarCupom = $('#btnSalvarCupom');
        e.preventDefault();

        if (verificaDadosCupom()) {
            btnSalvarCupom.removeClass('btn-orange');
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


    // INICIA A VERIFICACAO

    if (typeof ($("#inputNomeLoja")).val() !== "undefined") {
        let loopverificaConfig = setInterval(verificaDadosConfig, 100);
    }

    function verificaDadosConfig() {
        let inputNome = $('#inputNomeLoja');
        let inputSenha = $('#inputSenha');
        let inputSenhaNova = $('#inputSenhaNova');
        let valid = true;

        if (inputNome.val().length < 2) {
            inputNome.removeClass('is-valid');
            inputNome.addClass('is-invalid');
            valid = false;
        } else {
            inputNome.removeClass('is-invalid');
            inputNome.addClass('is-valid');
        }

        if (inputSenha.val().length == 0) {
            inputSenha.removeClass('is-valid');
            inputSenha.addClass('is-invalid');
            valid = false;
        } else {
            inputSenha.removeClass('is-invalid');
            inputSenha.addClass('is-valid');
        }

        if (inputSenhaNova.val().length < 8 && inputSenhaNova.val().length > 0) {
            inputSenhaNova.removeClass('is-valid');
            inputSenhaNova.addClass('is-invalid');
            valid = false;
        } else if (inputSenhaNova.val().length == 0) {
            inputSenhaNova.removeClass('is-invalid');
            inputSenhaNova.removeClass('is-valid');
        } else {
            inputSenhaNova.removeClass('is-invalid');
            inputSenhaNova.addClass('is-valid');
        }

        return valid;

    }

    $('#btnSalvarConfig').click(function (e) {
        let btnSalvarConfig = $('#btnSalvarConfig');
        e.preventDefault();

        if (verificaDadosConfig()) {
            btnSalvarConfig.removeClass('btn-success');
            btnSalvarConfig.addClass('btn-secondary');
            btnSalvarConfig.attr('disabled', true);
            btnSalvarConfig.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Carregando...');
            $('#formSalvarConfig').submit();
        }


    });

    if ($("#showModal").val() == "true") {
        $('#exampleModal').modal('show')
    }


});