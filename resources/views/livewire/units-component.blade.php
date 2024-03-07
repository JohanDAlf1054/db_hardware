<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-primary mx-2 rounded btn-lg" data-bs-toggle="modal" data-bs-target="#Modal">Crear Marca</button>
                                <input type="text" wire:model.live='search'  class="form-control" placeholder="Buscar...">
                            </div>
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
										<th>Nombre</th>
                                        <th>Codigo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($units as $unit)
                                        <tr> 
                                            <td>{{ $unit->id}}</td>
                                            <td>{{ $unit->code}}</td>
											<td>{{ $unit->name }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-sm btn-success mx-2 rounded"  data-bs-toggle="modal" data-bs-target="#Modal"  wire:click='edit("{{ $unit->id }}")'><i class="fa fa-fw fa-edit"></i> </i> </button>
                                                    <button type="button" class="btn btn-danger btn-sm mx-2 rounded" wire:click='delete("{{ $unit->id }}")'><i class="fa fa-fw fa-trash"></i></button>
                                                  </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $units->links() !!}
            </div>
        </div>
    </div>
    @include('components.modalheader')
    <div class="mb-3">
        <label for="nombre" class="form-label">Codigo</label>
        <input type="text" class="form-control" id="code" wire:model.lazy='code' placeholder="Codigo">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" wire:model.lazy='name' placeholder="Nombre">
    </div>
    @include('components.modalfooter')
</div>
