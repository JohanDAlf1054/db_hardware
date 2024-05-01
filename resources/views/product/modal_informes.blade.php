<!-- Modal -->
@foreach ( $productos as $producto )
<div class="modal fade" id="informes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Informes Productos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col" style="margin-bottom: 1rem">
                        <a class="btn btn-info" href="">Informe General de Productos</a>
                    </div>
                    <div class="col" style="margin-bottom: 1rem">
                        <a class="btn btn-info" href="">Informe General de Productos</a>
                    </div>
                    <div class="col" style="margin-bottom: 1rem">
                        <a class="btn btn-info" href="">Informe General de Productos</a>
                    </div>
                    <div class="col" style="margin-bottom: 1rem">
                        <a class="btn btn-info" href="">Informe General de Productos</a>
                    </div>
                    <div class="col" style="margin-bottom: 1rem">
                        <a class="btn btn-info" href="">Informe General de Productos</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>
@endforeach