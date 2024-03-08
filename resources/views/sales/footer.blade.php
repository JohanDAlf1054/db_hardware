</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
  <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @if($id==0) wire:click="store()" @else wire:click="update({{$sale->id}})" @endif >Guardar</button>
</div>
</div>
</div>
</div>