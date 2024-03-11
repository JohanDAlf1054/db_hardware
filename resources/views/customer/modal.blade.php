<!-- Modal -->
@foreach ( $clientes as $cliente )
<div class="modal fade" id="confirmationDestroy-{{$cliente->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar Accion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div>
                {{ $cliente->status == True ? '¿Seguro que quiere inactivar la persona?' : '¿Seguro que quiere activar la persona?' }}
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="{{ route('person.destroy',$cliente->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Confirmar</button>
        </form>

        </div>
    </div>
    </div>
</div>
@endforeach
