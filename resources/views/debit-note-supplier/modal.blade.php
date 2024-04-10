<!-- Modal -->
@foreach ($debitNoteSuppliers as $debitNoteSupplier)
<div class="modal fade" id="confirmationDestroy-{{$debitNoteSupplier->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar Accion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div>
                {{ $debitNoteSupplier->status == 1 ? '¿Seguro que quiere inactivar la nota de débito?' : '¿Seguro que quiere activar la nota de débito?' }}
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="{{ route('debit-note-supplier.destroy',$debitNoteSupplier->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Confirmar</button>
        </form>
        
        </div>
    </div>
    </div>
</div>
@endforeach
