$(document).ready(function () {

    $('.counter').each(function () {
        var $this = $(this),
            countTo = $this.attr('data-count');

        $({
            countNum: $this.text()
        }).animate({
            countNum: countTo
        }, {
            duration: 1500,
            easing: 'swing',
            step: function () {
                $this.text("R$ " + Math.floor(this.countNum).toFixed(2).toString().replace('.', ','));
            },
            complete: function () {
                $this.text("R$ " + this.countNum.toFixed(2).toString().replace('.', ','));
            }

        });

    });

    $('#inputPhone').mask('(00) 00000-0000');
    $('#inputTelefoneCliente').mask('(00) 00000-0000');
    $('#telefoneRecuperacao').mask('(00) 00000-0000');

    bsCustomFileInput.init();

    // INICIA A VERIFICACAO
    if (typeof ($("#inputPhone")).val() !== "undefined") {
        let loopcadastro = setInterval(verificaCadastro, 300);
    }

    function verificaCadastro() {

        let inputPhone = $('#inputPhone');
        let inputNome = $('#inputNome');
        let inputEmail = $('#inputEmail');
        let inputSenha = $('#inputSenha');
        let inputConfirmaSenha = $('#inputCSenha');


        let valid = true;

        if (inputPhone.val().length < 15) {
            inputPhone.removeClass('is-valid');
            inputPhone.addClass('is-invalid');
            valid = false;
        } else {
            inputPhone.removeClass('is-invalid');
            inputPhone.addClass('is-valid');
        }


        if (inputNome.val().length < 2 || inputNome.val().indexOf(" ") == 0 || inputNome.val().indexOf(" ") == 1) {
            inputNome.removeClass('is-valid');
            inputNome.addClass('is-invalid');
            valid = false;
        } else {

            inputNome.removeClass('is-invalid');
            inputNome.addClass('is-valid');
        }


        if (inputEmail.val().length == 0 || inputEmail.val().indexOf('@') == -1 || inputEmail.val().indexOf('.') == -1 || inputEmail.val().search(/\s/g) > -1) {
            inputEmail.removeClass('is-valid');
            inputEmail.addClass('is-invalid');
            valid = false;
        } else {
            inputEmail.removeClass('is-invalid');
            inputEmail.addClass('is-valid');
        }

        if (inputSenha.val().length < 8) {
            inputSenha.removeClass('is-valid');
            inputSenha.addClass('is-invalid');
            valid = false;
        } else {
            inputSenha.removeClass('is-invalid');
            inputSenha.addClass('is-valid');
        }

        if (inputConfirmaSenha.val() !== inputSenha.val() || inputConfirmaSenha.val().length < 8) {
            inputConfirmaSenha.removeClass('is-valid');
            inputConfirmaSenha.addClass('is-invalid');
            valid = false;
        } else {
            inputConfirmaSenha.removeClass('is-invalid');
            inputConfirmaSenha.addClass('is-valid');
        }


        return valid;

    }

    $('#btnCadastrar').click(function (e) {
        let btnCadastrar = $('#btnCadastrar');
        e.preventDefault();
        let inputNome = $('#inputNome');
        let inputEmail = $('#inputEmail');

        if (verificaCadastro()) {
            inputNome.val(inputNome.val().trim());
            inputEmail.val(inputEmail.val().trim());

            btnCadastrar.removeClass('btn-orange');
            btnCadastrar.addClass('btn-secondary');
            btnCadastrar.attr('disabled', true);
            btnCadastrar.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Carregando...');
            $('#formCadastrar').submit();
        }

    })


    // INICIA A VERIFICACAO
    if (typeof ($("#inputSenhaNova")).val() !== "undefined") {
        let loopsenhanova = setInterval(verificaSenhaNova, 300);
    }

    function verificaSenhaNova() {
        let inputSenhaNova = $('#inputSenhaNova');
        let valid = true;

        if (inputSenhaNova.val().length == 0) {
            inputSenhaNova.removeClass('is-valid');
            inputSenhaNova.removeClass('is-invalid');
        } else if (inputSenhaNova.val().length < 8) {
            inputSenhaNova.removeClass('is-valid');
            inputSenhaNova.addClass('is-invalid');
            valid = false;
        } else {
            inputSenhaNova.removeClass('is-invalid');
            inputSenhaNova.addClass('is-valid');
        }

        return valid;

    }

    if (typeof ($("#inputNomeCliente")).val() !== "undefined") {
        let loopnome = setInterval(verificaNomeConfig, 300);
    }

    function verificaNomeConfig() {
        let inputNome = $('#inputNomeCliente');
        let inputSenha = $('#inputSenhaConfig');
        let valid = true;

        if (inputNome.val().length > 3) {
            inputNome.addClass('is-valid');
            inputNome.removeClass('is-invalid');
        } else {
            valid = false;
            inputNome.addClass('is-invalid');
            inputNome.removeClass('is-valid');
        }
        if (inputSenha.val().length > 0){
            inputSenha.removeClass('is-invalid');
        } else {
            valid = false;
            inputSenha.addClass('is-invalid');
        }

        return valid;
    }

    $('#btnSalvarConfig').click(function (e) {
        let btnSalvarConfig = $('#btnSalvarConfig');
        e.preventDefault();

        if (verificaSenhaNova() && verificaNomeConfig()) {
            btnSalvarConfig.removeClass('btn-orange');
            btnSalvarConfig.addClass('btn-secondary');
            btnSalvarConfig.attr('disabled', true);
            btnSalvarConfig.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Carregando...');
            $('#formSalvarConfig').submit();
        }


    });


    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('a[href="#top"]').fadeIn();
        } else {
            $('a[href="#top"]').fadeOut();
        }
    });

    $('a[href="#top"]').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
        return false;
    });





});


function alternaDescricao(id) {

    let descricaoCurta = $('#descricao-curta-' + id);
    let descricaoLonga = $('#descricao-longa-' + id);
    let btnDescricao = $('#btn-descricao-' + id);

    if (btnDescricao.attr('data-action') === "Mostrar menos"){

        // esconde descricao curta
        descricaoCurta.removeClass("d-none");
        descricaoCurta.addClass('d-block');

        // mostra descricao longa
        descricaoLonga.removeClass("d-block");
        descricaoLonga.addClass("d-none");

        btnDescricao.attr('data-action', "Mostrar mais");
        btnDescricao.html('mais');

    } else {

        // esconde descricao curta
        descricaoCurta.addClass("d-none");
        descricaoCurta.removeClass('d-block');

        // mostra descricao longa
        descricaoLonga.addClass("d-block");
        descricaoLonga.removeClass("d-none");

        btnDescricao.attr('data-action', "Mostrar menos");
        btnDescricao.html('menos');
    }

}