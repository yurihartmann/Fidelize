$(document).ready(function () {


	// AJAX CLIENTE
	var cliente = $('#cliente');
	var totalcliente = 0;
	$.ajax({
		url: 'ajax/clientes_cadastrados.php',
		type: 'POST',
		data: {},
		success: function (resultado) {
			totalcliente = resultado;
		}
	});

	var icliente = 0;
	var loopCliente = setInterval(loopCliente, 65);



	function loopCliente() {
		if (icliente <= totalcliente) {
			cliente.text(icliente);
			icliente += 1;
		} else {
			clearInterval(loopCliente);
		}
	}

	// AJAX CUPOM
	var totalcupons = 0;

	var cupons = $('#cupons');

	$.ajax({

		url: 'ajax/cupons_validos.php',
		type: 'POST',
		data: {},
		success: function (result) {
			totalcupons = result;
		}
	});


	var icupons = 0;
	var loopCupom = setInterval(loopCupom, 85);



	function loopCupom() {
		if (icupons <= totalcupons) {
			cupons.text(icupons);
			icupons += 1;
		} else {
			clearInterval(loopCupom);
		}
	}

	// AJAX EMPRESAS
	var totalempresas = 0;

	var empresas = $('#empresas');

	$.ajax({

		url: 'ajax/empresas_fidelizadas.php',
		type: 'POST',
		data: {},
		success: function (resultado) {
			totalempresas = resultado;
		}
	});


	var iempresas = 0;
	var loopEmpresas = setInterval(loopEmpresas, 95);



	function loopEmpresas() {
		if (iempresas <= totalempresas) {
			empresas.text(iempresas);
			iempresas += 1;
		} else {
			clearInterval(loopEmpresas);
		}
	}

	// NARUTO É GOTICO
	$('#btnSalvarFidelizar').click(function () {

		var email = document.getElementById('email').value;
		var nome = document.getElementById('nome').value;
		var mensagem = document.getElementById('mensagem').value;
		var segmento = document.getElementById('segmento').value;


		if (email.length > 0 && nome.length > 0 && mensagem.length > 0) {

			$.ajax({
				//Alert de sucesso
				url: 'ajax/querofidelizar.php',
				type: 'POST',
				data: {
					'email': email,
					'nome': nome,
					'mensagem': mensagem,
					'segmento': segmento,

				},
				success: function (resultado) {
					swal({
						title: "Enviado com sucesso!",
						text: "Obrigado, entraremos em contato via email!",
						icon: "success",
						button: "Confirmar!",
					});

		// DEIXA O VALUE VAZIO
		document.getElementById('email').value = "";
		document.getElementById('nome').value = "";
		document.getElementById('mensagem').value = "";
	}
})
		} else {
			// Alert de error 
			swal({
				title: "Houve um problema!",
				text: "Todos os campos precisam serem preenchidos",
				icon: "error",
				button: "Confirmar!",
			});
		}


	});
	//SUPORTE
	$('#btnSalvar').click(function () {

		var email = document.getElementById('email').value;
		var nome = document.getElementById('nome').value;
		var mensagem = document.getElementById('mensagem').value;



		if (email.length > 0 && nome.length > 0 && mensagem.length > 0) {

			$.ajax({
				//Alert de sucesso
				url: 'ajax/suporte_bd.php',
				type: 'POST',
				data: {
					'email': email,
					'nome': nome,
					'mensagem': mensagem,
				},
				success: function (resultado) {
					swal({
						title: "Enviado com sucesso!",
						text: "Obrigado, responderemos o mais rápido possível!",
						icon: "success",
						button: "Confirmar!",
					});
				}
			})
		} else {
			// Alert de error 
			swal({
				title: "Houve um problema!",
				text: "Todos os campos precisam serem preenchidos",
				icon: "error",
				button: "Confirmar!",
			});
		}
		// DEIXA O VALUE VAZIO
		document.getElementById('email').value = "";
		document.getElementById('nome').value = "";
		document.getElementById('mensagem').value = "";


	});



	$('.custom-control-label').click(function () {
		if ($(this).is(":checked")) {
			$('.custom-control-label').attr('disabled', true);
			$(this).removeAttr('disabled');
		} else {
			$('.custom-control-label').removeAttr('disabled');
		}
	})

	//    FEEDBACK
	$('.testimonial-pics img').click(function () {
		// Selecionando elementos ativos
		$(".testimonial-pics img").removeClass("active");
		$(this).addClass("active");

		// Conteudo do Elemento
		$(".testimonial").removeClass("active");
		$("#" + $(this).attr("alt")).addClass("active");
	});



	

});


