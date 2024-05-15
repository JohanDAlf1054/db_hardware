@auth
@can('products')

@include('include.barra', ['modo'=>'Productos'])
<body>
    <div class="bread_crumb">
        {{ Breadcrumbs::render('product.show', $producto) }}
    </div>
    <br>
<div class="container-fluid">
<div class="page-body">
        <div class="row row-cards">
                <div class="row">
                    <div class="col-lg-4" style="margin-bottom: 1rem">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" style="text-align: center;">
                                    {{ __('Imagen Producto') }}
                                </h3>
                            </div>
                            <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                                <tbody>
                                    <tr>
                                        <td style="text-align: center">
                                            @if ($producto->photo)
                                                <img class="rounded mx-auto d-block" src="{{ asset('storage/' . $producto->photo) }}"  width="250" height="250">
                                            @else
                                                <img class="rounded mx-auto d-block" src="{{ asset('img/products/default.webp') }}"  width="250" height="250">
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    {{ __('Detalles del Producto') }}
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table   text-nowrap datatable">
                                    <tbody>
                                        <tr>
                                            <td>    
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class='bx bxs-package'></i></span>
                                                    <input disabled type="text" class="form-control" value="Nombre: ">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <span title="Número de comprobante" id="icon-form" class="input-group-text"><i class='bx bxs-package'></i></span>
                                                    <input disabled type="text" class="form-control" value="{{ $producto->name_product }}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class='bx bx-text'></i></span>
                                                    <input disabled type="text" class="form-control" value="Descripción: ">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class='bx bx-text'></i></span>
                                                    <input disabled type="text" class="form-control" value="{{ $producto->description_long }}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class='bx bxs-category' ></i></span>
                                                    <input disabled type="text" class="form-control" value="Categoría: ">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class='bx bxs-category' ></i></span>
                                                    <input disabled type="text" class="form-control" value="{{ $producto->categoryProduct->name }}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class='bx bxs-category-alt' ></i></span>
                                                    <input disabled type="text" class="form-control" value="Subcategoría: ">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class='bx bxs-category-alt' ></i></span>
                                                    <input disabled type="text" class="form-control" value="{{ $producto->subcategory_product}}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class='bx bx-hive'></i></span>
                                                    <input disabled type="text" class="form-control" value="Existencias: ">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class='bx bx-hive'></i></span>
                                                    <input disabled type="text" class="form-control" value="{{ $producto->stock }}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class="fa-solid fa-cube"></i></span>
                                                    <input disabled type="text" class="form-control" value="Unidad de Medida: ">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class="fa-solid fa-cube"></i></span>
                                                    <input disabled type="text" class="form-control" value="{{ $producto->measurementUnit->name }}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class='bx bx-refresh'></i></span>
                                                    <input disabled type="text" class="form-control" value="Estado: ">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class='bx bx-refresh'></i></span>
                                                    <input disabled type="text" class="form-control" value=" {{ ($producto->status == 1) ? 'Activo' : 'Inactivo' }} ">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class="fa-solid fa-newspaper"></i></i></span>
                                                    <input disabled type="text" class="form-control" value="Referencia Fabrica: ">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class="fa-solid fa-newspaper"></i></span>
                                                    <input disabled type="text" class="form-control" value=" {{ $producto->factory_reference}} ">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class='bx bxs-label' ></i></span>
                                                    <input disabled type="text" class="form-control" value="Clasificacion Tributaria: ">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class='bx bxs-label' ></i></span>
                                                    <input disabled type="text" class="form-control" value=" {{ $producto->classification_tax}} ">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class='bx bx-dollar-circle'></i></span>
                                                    <input disabled type="text" class="form-control" value="Precio de Venta: ">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class='bx bx-dollar-circle'></i></span>
                                                    <input disabled type="text" class="form-control" value=" {{ $producto->selling_price}} ">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class='bx bxs-label' ></i></span>
                                                    <input disabled type="text" class="form-control" value="Marca: ">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" id="hide-group">
                                                    <span class="input-group-text"><i class='bx bxs-label' ></i></span>
                                                    <input disabled type="text" class="form-control" value=" {{ $producto->brand->name}} ">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer text-end">
                                <a class="btn btn-dark" href="{{ route('products.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                                    {{ __('Regresar') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
</div>
</div>
</body>
@endcan
@endauth

@guest
    @include('include.falta_sesion')
@endguest

