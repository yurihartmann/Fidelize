<?php

include "include/header.php";
include "include/navbar.php";
include "include/painel.php";

?>


<content class="container-fluid" style=overflow-x: hidden;>
	<div class="container">
		<div class="row">

			<div class="col-sm-12" id="precos">
				<div class="card bg-light shadow-sm p-3 bg-white rounded mt-5 mb-1">
					<!-- Modal pequeno -->
					<a href="#"><i class="far fa-question-circle fa-sm float-right" data-toggle="modal" data-target=".free"></i></a>

					<div class="modal fade free" tabindex="-1" role="dialog" aria-labelledby="free" aria-hidden="true">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<span class=" text font-weight-bold text-muted">GRATUITO <i class="fas fa-check text-green"></i></span>
									<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body text-muted">
									Os primeiros 10 clientes a completar o cupom é gratuito. Tenha o direito de testar no primeiro mês os beneficios sem nenhum custo!
								</div>
							</div>
						</div>
					</div>
					<!-- CARD -->
					<div class="card-body">
						<h5 class="card-title text-orange"><strong>GRATUITO</strong></h5>
						<p class="card-text text-muted">Os primeiros 10 clientes a completar o cupom é gratuito sem válidade única, aproveite para testar!</p>
						<hr>

						<span class="font-weight-normal" style="font-size: 10px"><strong>PREÇO:</strong></span>
						<div>
							<a href="#" class="text-decoration-none h2"><strong>R$ 0,00</strong></a>
						</div>

						<a class="btn btn-orange float-right d-none d-lg-block	" href="fidelizar.php?plano=gratuito" role="button">QUERO TESTAR</a>


					</div>
					<a class="btn btn-orange btn-block float-right d-block d-lg-none" href="fidelizar.php?plano=gratuito" role="button">QUERO TESTAR</a>

				</div>
			</div>

			<div class="col-lg-4 col-sm-12">
				<div class="card bg-light shadow-sm p-3 bg-white rounded mt-5 mb-1">
					<!-- Modal pequeno -->
					<a href="#"><i class="far fa-question-circle fa-sm float-right" data-toggle="modal" data-target=".basic"></i></a>

					<div class="modal fade basic" tabindex="-1" role="dialog" aria-labelledby="basico" aria-hidden="true">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<span class="text font-weight-bold text-muted">BÁSICO <i class="fas fa-check text-green"></i></span>
									<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body text-muted">
									A partir do 11° cliente a completar o cupom, será cobrado R$ 1,5 para cada novo cupom completado.
								</div>
							</div>
						</div>
					</div>
					<!-- CARD -->
					<div class="card-body">
						<h5 class="card-title text-orange"><strong>BÁSICO</strong></h5>
						<p class="card-text text-muted">A partir do 11° cliente a completar o cupom, será cobrado R$ 1,5 para cada novo cupom completado.</p>
						<hr>
						<span class="font-weight-normal" style="font-size: 10px"><strong>PREÇO:</strong></span>
						<div>
							<a href="#" class="text-decoration-none h2"><strong>R$ 1,50</strong></a>
						</div>
					</div>
					<!-- <div class="container"> -->


					<small><a class="btn btn-orange d-none d-lg-block float-right" href="fidelizar.php?plano=basico" name="basico" role="button">Fidelizar</a></small>

					<a class="btn btn-orange btn-block float-right d-block d-lg-none" href="fidelizar.php?plano=basico" name="basico" role="button">Fidelizar</a>

				</div>
			</div>
			<div class="col-lg-4 col-sm-12">
				<div class="card bg-light shadow-sm p-3 bg-white rounded mt-5 mb-1">
					<!-- Modal pequeno -->
					<a href="#"><i class="far fa-question-circle fa-sm float-right" data-toggle="modal" data-target=".intermediary"></i></a>

					<div class="modal fade intermediary" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<span class=" text font-weight-bold text-muted">INTERMEDIÁRIO <i class="fas fa-check text-green"></i></span>
									<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body text-muted">
									R$ 15,90 + R$ 1,5 para cada cupom completado.
									Além do básico, terá acesso a respostas de satisfação , sms marketing básico para até 100 clientes/mês e 1000 e-mail marketing/mês.
								</div>
							</div>
						</div>
					</div>
					<!-- CARD -->
					<div class="card-body">
						<h5 class="card-title text-orange"><strong> INTERMEDIÁRIO</strong></h5>
						<p class="card-text text-muted">Acesso a respostas de satisfação, sms básico para até 100 clientes/mês e 1000 e-mail marketing/mês!</p>
						<hr>

						<span class="font-weight-normal" style="font-size: 10px"><strong>PREÇO:</strong></span>
						<div>
							<a href="#" class="text-decoration-none h2"><strong>R$ 15,90</strong> <span class="h6"> + R$ 1,50</span></a>
						</div>
					</div>
					<small><a class="btn btn-orange d-none d-lg-block float-right" href="fidelizar.php?plano=intermediario" name="intermediario" role="button">Fidelizar</a></small>

					<a class="btn btn-orange btn-block float-right d-block d-lg-none" href="fidelizar.php?plano=intermediario" name="intermediario" role="button">Fidelizar</a>
				</div>
			</div>
			<div class="col-lg-4 col-sm-12">
				<div class="card bg-light shadow-sm p-3 bg-white rounded mt-5 mb-1">
					<!-- Modal pequeno -->
					<a href="#"><i class="far fa-question-circle fa-sm float-right" data-toggle="modal" data-target=".advanced"></i></a>

					<div class="modal fade advanced" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<span class=" text font-weight-bold text-muted">AVANÇADO <i class="fas fa-check text-green"></i></span>
									<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body text-muted">
									R$ 199,90 + R$ 1,5 para cada cupom completado.
									Terá acesso a respostas de satisfação , sms marketing para até 1000 clientes/mês e 10000 e-mail marketing/mês, sms de "Sentimos sua falta", e sms para chamar o cliente pois um cupom novo foi criado pela empresa.
								</div>
							</div>
						</div>
					</div>
					<!-- CARD -->
					<div class="card-body">
						<h5 class="card-title text-orange"><strong>AVANÇADO</strong></h5>
						<p class="card-text text-muted">Acesso a respostas de satisfação, sms marketing até 1000 clientes/mês e 10000 e-mail marketing/mês.</p>
						<hr>
						<span class="font-weight-normal" style="font-size: 10px"><strong>PREÇO:</strong></span>
						<div>
							<a href="#" class="text-decoration-none h2"><strong>R$ 199,90</strong> <span class="h6"> + R$ 1,50</span></a>
						</div>
					</div>
					<small><a class="btn btn-orange d-none d-lg-block float-right" href="fidelizar.php?plano=avancado" role="button">Fidelizar</a></small>

					<a class="btn btn-orange btn-block float-right d-block d-lg-none" href="fidelizar.php?plano=avancado" role="button">Fidelizar</a>
				</div>
			</div>
		</div>
	</div>

	<section>
		<div class="bg-orange mt-3">
			<div class="container pt-5">
				<div class="row pb-5">
					<div class="col-md-4 col-12 card bg-orange border-0 text-white" style="width: 18rem;">
						<span class="text-center pt-3">
							<i class="fas fa-user-check fa-5x ml-4"></i>
						</span>
						<div class="card-body pb-3">
							<h4 class="card-title text-center" id="cliente" style="font-weight: bold;"></h4>
							<p class="card-text text-center	">CLIENTES CADASTRADOS.</p>
						</div>
					</div>
					<div class="col-md-4 col-12 card bg-orange border-0 text-white" style="width: 18rem;">
						<span class="text-center pt-3">
							<i class="fas fa-ticket-alt fa-5x ml-1"></i>
						</span>
						<div class="card-body pb-3">
							<h4 class="card-title text-center" id="cupons" style="font-weight: bold;"></h4>
							<p class="card-text text-center">CUPONS VALIDADOS.</p>
						</div>
					</div>
					<div class="col-md-4 col-12 card bg-orange border-0 text-white" style="width: 18rem;">
						<span class="text-center pt-3">
							<i class="fas fa-handshake fa-5x"></i>
						</span>
						<div class="card-body pb-3">
							<h4 class="card-title text-center" id="empresas" style="font-weight: bold;"></h4>
							<p class="card-text text-center	">EMPRESAS FIDELIZADAS.</p>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- TESTIMONIAL -->


		<div class="testimonial-section">
			<div class="inner-widht">
				<h1>O que empresas Fidelizadas dizem</h1>
				<div class="testimonial-pics">
					<img src="../media/images/emp1.png" alt="test-1" class="active my-1" />
					<img src="../media/images/emp2.png" alt="test-2" class="my-1" />
					<img src="../media/images/emp3.png" alt="test-3" class="my-1" />
					<img src="../media/images/emp4.png" alt="test-4" class="my-1" />
					<img src="../media/images/emp5.png" alt="test-5" class="my-1" />
					<img src="../media/images/emp6.png" alt="test-6" class="my-1" />

				</div>

				<div class="testimonial-contents">
					<div class="testimonial active" id="test-1">
						<p>
							Ótimo negócio a se fazer! Super prático em nossas vendas, estamos
							muito satisfeitos com o resultado adquirido e recomendamos muito a
							todos.
						</p>
						<hr />
						<span class="description">THE BURGER SHACK</span>
					</div>

					<div class="testimonial" id="test-2">
						<p>
							Vendemos uma quantia surpreendente de pães em uma semana graças ao
							FIDELIZE! Estamos pensando em aumentar nossa fidelidade.
						</p>
						<hr />
						<span class="description">Padoca do Juca</span>
					</div>

					<div class="testimonial" id="test-3">
						<p>
							Meu negócio subiu muito sem muito esforço, apenas me fidelizei e
							em tão pouco tempo pude ter todo controle de cliente e buscar
							novos consumidores!
						</p>
						<hr />
						<span class="description">Roupas Maria</span>
					</div>

					<div class="testimonial" id="test-4">
						<p>
							Nossos pet's estão alegres demais com o FIDELIZE, nunca vimos
							tantos clientes movimentando nosso ambiente com agora!
						</p>
						<hr />
						<span class="description">AuAmigos</span>
					</div>

					<div class="testimonial" id="test-5">
						<p>
							Nossa clientela vem tendo muitas notificações de nossas ofertas, a cada dia conseguimos bater nossas metas de vendas e tudo isso graças ao FIDELIZE!
						</p>
						<hr />
						<span class="description">Donizete-Móveis</span>
					</div>

					<div class="testimonial" id="test-6">
						<p>
							Nossas vendas cresceram muito com o sistema FIDELIZE, nossa clienta veio a crescer muito. Obrigado FIDELIZE!
						</p>
						<hr />
						<span class="description">Bassos</span>
					</div>
				</div>
			</div>
		</div>

	</section>
</content>
<?php include "include/footer.php" ?>