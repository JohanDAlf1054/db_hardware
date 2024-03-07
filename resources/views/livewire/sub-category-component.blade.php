<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-primary mx-2 rounded btn-lg" data-bs-toggle="modal" data-bs-target="#Modal">Crear Sub Categoria</button>
                                <input type="text" wire:model.live='search'  class="form-control" placeholder="Buscar...">
                            </div>
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
										<th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subCats as $subCat)
                                        <tr> 
                                            <td>{{ $subCat->id}}</td>
                                            <td>{{ $subCat->name}}</td>
											<td>{{ $subCat->description }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-sm btn-success mx-2 rounded"  data-bs-toggle="modal" data-bs-target="#Modal"  wire:click='edit("{{ $subCat->id }}")'><i class="fa fa-fw fa-edit"></i> </i> </button>
                                                    <button type="button" class="btn btn-danger btn-sm mx-2 rounded" wire:click='delete("{{ $subCat->id }}")'><i class="fa fa-fw fa-trash"></i></button>
                                                  </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $subCats->links() !!}
            </div>
        </div>
    </div>
    @include('components.modalheader')
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" wire:model.lazy='name' placeholder="Codigo">
        <label for="nombre" class="form-label">Description</label>
        <input type="text" class="form-control" id="description" wire:model.lazy='description' placeholder="Nombre">
    </div>
    @include('components.modalfooter')
</div>
