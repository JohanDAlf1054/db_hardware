<!-- Modal -->
@foreach ( $units as $unit )
<div class="modal fade" id="confirmationDestroy-{{$unit->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar Acción</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div>
                {{ $unit->status == 1 ? '¿Seguro que quiere inactivar el registro?' : '¿Seguro que quiere activar el registro?' }}
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
        {{-- <form action="{{ route('delete',$unit->id) }}" method="POST"> --}}
            {{-- @csrf
            @method('DELETE') --}}
            <button type="submit" class="btn btn-primary" wire:click='delete("{{ $unit->id }}")'>Confirmar</button>
        {{-- </form> --}}
        
        </div>
    </div>
    </div>
</div>
@endforeach