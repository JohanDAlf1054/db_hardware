<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2 id="card_title">
                            {{ Breadcrumbs::render('brand.index') }}
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <button type="button" class="btn btn-light">
                                <a href="{{ route('products.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l14 0" />
                                        <path d="M5 12l6 6" />
                                        <path d="M5 12l6 -6" />
                                    </svg>
                                </a>
                            </button>
                            <button type="button" class="btn btn-primary ms-2 rounded" data-bs-toggle="modal"
                                data-bs-target="#Modal">Crear Marca</button>
                            <button type="button" class="btn btn-warning ms-2 rounded" tooltip="tooltip"
                                title="Importar" data-bs-toggle="modal" data-bs-target="#importBrands">
                                <i class="fa-solid fa-folder-open" style="color: #0a0a0a; width=24; height=24";></i>
                            </button>
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger">
                                <p>{{ session('error') }}</p>
                            </div>
                        @endif
                        <div class="table_container">
                            <div>
                                <table id="datatable" class="table table-striped table-hover" style="width: 100%;">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="text-align: center">Id</th>
                                            <th style="text-align: center">Abreviación</th>
                                            <th style="text-align: center">Codigo</th>
                                            <th style="text-align: center">Nombre</th>
                                            <th style="text-align: center">Estado</th>
                                            <th style="text-align: center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brands as $brand)
                                            <tr>
                                                <td style="text-align: center">{{ $brand->id }}</td>
                                                <td style="text-align: center">{{ $brand->abbrevation }}</td>
                                                <td style="text-align: center">{{ $brand->code }}</td>
                                                <td style="text-align: center">{{ $brand->name }}</td>
                                                <td style="text-align: center">
                                                    @if ($brand->status == 1)
                                                        <p class="badge rounded-pill bg-success text-white"
                                                            style="font-size: 15px">Activo</p>
                                                    @else
                                                        <p class="badge rounded-pill bg-danger" style="font-size: 15px">
                                                            Inactivo</p>
                                                    @endif
                                                </td>
                                                <td style="text-align: center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button"
                                                            class="btn btn-sm btn-success mx-2 rounded"
                                                            tooltip="tooltip" title="Modificar" data-bs-toggle="modal"
                                                            data-bs-target="#Modal"
                                                            wire:click='edit("{{ $brand->id }}")'><i
                                                                class="fa fa-fw fa-edit"></i> </i> </button>
                                                        <!-- Modal de Confirmacion -->
                                                        @if ($brand->status == true)
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                data-bs-toggle="modal" tooltip="tooltip"
                                                                title="Inactivar"
                                                                data-bs-target="#confirmationDestroy-{{ $brand->id }}"><i
                                                                    class="fa fa-fw fa-trash"></i></button>
                                                        @else
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                data-bs-toggle="modal" tooltip="tooltip" title="Activar"
                                                                data-bs-target="#confirmationDestroy-{{ $brand->id }}"><i
                                                                    class="fa-solid fa-rotate"></i></button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- {{ $brands->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.modalheader')
    <div class="mb-3">
        <label for="nombre" class="form-label" style="font-weight: bolder">Abreviación <span
                class="text-danger">*</span></label>
        <input type="text" class="form-control @error('abbrevation') is-invalid @enderror" id="abbrevation"
            wire:model.lazy='abbrevation' placeholder="Abreviación">
        @error('abbrevation')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <label for="nombre" class="form-label" style="font-weight: bolder">Codigo <span
                class="text-danger">*</span></label>
        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
            wire:model.lazy='code' placeholder="Codigo">
        @error('code')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <label for="nombre" class="form-label" style="font-weight: bolder">Nombre <span
                class="text-danger">*</span></label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
            wire:model.lazy='name' placeholder="Nombre">
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    @include('components.modalfooter')
    @include('brand.modalImport')
    @include('brand.modal')
</div>
