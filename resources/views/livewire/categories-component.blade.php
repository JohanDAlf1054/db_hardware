<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h2 id="card_title">
                            {{ Breadcrumbs::render('category.index') }}
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <button type="button" class="btn btn-light">
                                <a href="{{route('products.index')}}" class="back">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                                </a>
                            </button>
                            <button type="button" class="btn btn-primary mx-2 rounded" data-bs-toggle="modal" data-bs-target="#Modal">Crear Categoría</button>
                            <input type="text" wire:model.live='search'  class="form-control col-sm-5" placeholder="Buscar...">
                            <button type="button" class="btn btn-success mx-2 rounded" id="all"><a class="boton_sub" href="{{route('indexAll')}}">Todas las Subcategorías</button></a>
                            <button type="button" class="btn btn-warning mx-2 rounded" tooltip="tooltip" title="Importar" data-bs-toggle="modal" data-bs-target="#importCategory">
                                <i class="fa-solid fa-folder-open" style="color: #0a0a0a; width=24; height=24"; ></i>
                            </button>
                        </div>
                        <div class="table_container">
                            <div>
                                <table class="table table-striped table-hover"  style="justify-content: center;width:100%" id="datatable">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="text-align: center">Id</th>
                                            <th style="text-align: center">Nombre</th>
                                            <th style="text-align: center">Descripción</th>
                                            <th style="text-align: center">Estado</th>
                                            <th style="text-align: center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td style="text-align: center">{{ $category->id}}</td>
                                                <td style="text-align: center">{{ $category->name}}</td>
                                                <td style="text-align: center">{{ $category->description }}</td>
                                                <td style="text-align: center">
                                                    @if ($category->status == 1)
                                                        <p class="badge rounded-pill bg-success text-white" style="font-size: 15px">Activo</p>
                                                    @else
                                                        <p class="badge rounded-pill bg-danger"  style="font-size: 15px">Inactivo</p>
                                                    @endif
                                                </td>
                                                <td style="text-align: center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-sm btn-warning rounded" tooltip="tooltip" title="Crear Subcategorías" wire:click='show("{{ $category->id }}")'>Crear Subcategorías</button>
                                                        <button type="button" class="btn btn-sm btn-success mx-2 rounded" tooltip="tooltip" title="Modificar"  data-bs-toggle="modal" data-bs-target="#Modal"  wire:click='edit("{{ $category->id }}")'><i class="fa fa-fw fa-edit"></i> </i> </button>
                                                        <!-- Modal de Confirmacion -->
                                                        @if ($category->status == true)
                                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" tooltip="tooltip"
                                                        title="Inactivar" data-bs-target="#confirmationDestroy-{{$category->id}}"><i class="fa fa-fw fa-trash"></i></button>
                                                        @else
                                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"  tooltip="tooltip"
                                                        title="Activar" data-bs-target="#confirmationDestroy-{{$category->id}}"><i class="fa-solid fa-rotate"></i></button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- {{$categories->links() }} --}}
            </div>
        </div>
    </div>
    @include('components.modalheader')
    <div class="mb-3">
        <label for="name" class="form-label" style="font-weight: bolder">Nombre de la Categoria <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model='name' placeholder="Nombre" required>
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <label for="Description" class="form-label" style="font-weight: bolder">Descripción <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" wire:model='description' placeholder="Breve descripción" required>
        @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    @include('components.modalfooter')
    @include('category-product.modalImport')
    @include('category-product.modal')
</div>
