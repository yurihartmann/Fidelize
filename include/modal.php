
<!--MODAL-->

<!-- Button trigger modal -->
<button type="button" class="btn btn-info float-right mt-3" data-toggle="modal" data-target="#exampleModal" id="btnModal">
    Rever Cupom Anterior
</button>
<input type="hidden" id="showModal" value="<?=$modal['show']?>">

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col text-center">
                        <i class="far fa-check-circle fa-7x text-success"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center text-success mt-3">
                        <h2>Token Válido</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col px-5 py-3">
                        <h5 class="mb-3 font-weight-light"><strong>Nome do Cupom: </strong><?=$modal['nome_cartao']?></h5>
                        <h5 class="font-weight-light"><strong>Premio: </strong><?=$modal['premio']?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

