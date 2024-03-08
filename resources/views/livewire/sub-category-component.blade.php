<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-light">
                                    <a href="{{route('products.index')}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                                    </a>
                                </button>
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
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.lazy='name' placeholder="Nombre">
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror  
        <label for="nombre" class="form-label">Description</label>
        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" wire:model.lazy='description' placeholder="Descripcion">
        @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    @include('components.modalfooter')
</div>
