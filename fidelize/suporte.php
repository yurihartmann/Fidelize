<?php
include "include/header.php";
include "include/navbar.php";


?>






<div class="header">
	<div class="container">
		<div class="row center">
			<div class="col-lg-12 text-light text-center text-uppercase mt-5">
				<h1>SUPORTE</h1>
			</div>
		</div>
	</div>
</div>
<content>
	<div class="container-fluid">
		<div class="container my-5">
			<div class="row">
				<div class="col-md-6">
					<div class="card shadow p-3 mb-5 bg-white rounded">
						<div class="card-body">
							<p class="lead text-center">
								Deixe a sua dúvida aqui <i class="far fa-envelope mx-1"></i>
							</p>
							<form class="was-validated">
								<div class="form-group">
									<label for="email" class="">E-mail</label>
									<input type="email" class="form-control  rounded-0" id="email" name="email" aria-describedby="emailHelp" placeholder="fidelize@fidelize.com" required="">
									<small id="emailHelp" class="form-text text-muted">Entraremos em contato pelo e-mail digitado.</small>
								</div>
								<div class="form-group">
									<label for="nome" class="">Nome</label>
									<input type="text" class="form-control  rounded-0" id="nome" name="nome" placeholder="Digite seu nome..." required="">
								</div>
								<div class="form-group">
									<label for="mensagem" class="">Tire duvidas, sugestões e etc...</label>
									<textarea class="form-control rounded-0" id="mensagem" name="mensagem" rows="3" placeholder="Eu gostaria de saber..." required=""></textarea>
								</div>
								<div class="text-center">
									<input class="btn btn-orange btn-lg btn-block rounded-0" name="btnSalvar" id="btnSalvar" type="button" value="Enviar">
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-6 d-none d-lg-block">
					<div class="card shadow p-3 mb-5 bg-white rounded" style="max-width: 100%;
					height: 497px;">
						<div class="card-body">
							<p class="lead">
								Perguntas Frequentes
								<p class="card-text">Empresas pequenas podem adquirir o sistema?</p>

								<p><span class="text-muted"><strong>R: </strong>O sistema pode ser utilizado por todas as empresas.</span></p>

								<p>Como funciona a validez do cupom?</p>

								<p><span class="text-muted"><strong>R: </strong>A própria empresa pode decidir o tempo de validade de seu cupon e muitas outras informações.</span></p>

								<p>Como faço para adquirir o sistema Fidelize? </p>

								<p><span class="text-muted"><strong>R: </strong>Na parte superior da página temos a opção "Quero Fidelizar", clique nela, se cadastre e aproveite o nosso sistema!</span></p>
							</p>
							<div class="text-center">
								<i class="far fa-user fa-2x"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 d-block d-lg-none">
					<div class="card p-3 mb-5 rounded border-0">
						<div class="card-body text-center">
							<p class="lead">
								Perguntas Frequentes
								<p class="card-text">Empresas pequenas podem adiquirir o sistema?</p>

								<p><span class="text-muted"><strong>R: </strong>O sistema pode ser utilizado por todas as empresas.</span></p>

								<p>Como funciona a validez do cupom?</p>

								<p><span class="text-muted"><strong>R: </strong>A própria empresa pode decidir o tempo de validade de seu cupon e muitas outras informações.</span></p>

								<p>Como faço para adquirir o sistema Fidelize? </p>

								<p><span class="text-muted"><strong>R: </strong>Em nossa página inicial temos uma tabela de preços e também temos a opção <strong>GRATUITA</strong> para fazer o teste do sistema!</span></p>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
</content>
<?php include "include/footer.php" ?>