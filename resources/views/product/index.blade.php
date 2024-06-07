@auth
@include('include.barra', ['modo'=>'Productos'])
<br>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
<link href="{{asset('css/products/all.css')}}" rel="stylesheet" />
<link href="css/estilos_notificacion.css" rel="stylesheet"/>
<script src="{{ asset('js/notificaciones.js')}}" defer></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">
<script src="{{ asset('js/tooltips.js') }}" defer></script>
</head>
@can('products')


<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-default">
                <div class="card-header">
                    <h2 id="card_title">
                        {{--  {{ __('Productos') }}  --}}
                        {{ Breadcrumbs::render('products') }}
                    </h2>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-12" >
                            <button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">Acciones
                                <span class="visually-hidden">Nuevo</span>
                            </button>
                            <ul class="dropdown-menu desplegable_acciones">
                                <div class="acciones_boton">
                                    <li><a class="dropdown-item" href="{{ route('brand.index') }}">Crear Marca</a></li>
                                    <li><a class="dropdown-item" href="{{ route('category.index') }}">Crear Categoría</a></li>
                                    <li><a class="dropdown-item" href="{{ route('products.create') }}">Crear Producto</a></li>
                                </div>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-12" >
                            <form action="{{ route('products.index') }}" method="GET">
                                <div class="mb-3 row">
                                    <div class="col-sm-9">
                                        <select name="category_filter" id="category_filter" class="form-control selectpicker" data-live-search="true">
                                            <option value="">Filtrar por Categorias</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ request('category_filter') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3 ">
                                        <button type="submit" class=" btn btn-dark">Filtrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12"  >
                            <form action="{{ route('products.index') }}" method="GET" >
                                <div class="mb-3 row" >
                                    <div class="col-sm-6" style="display: flex; margin-left: 1rem">
                                        <input name="check" class="form-check-input" type="checkbox" style="padding: 0.7rem; " {{ request('check') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkActivos" style="font-size: 1.1em; padding: 0.2rem; " >Activos</label>
                                        <button type="submit" class=" btn btn-dark">Filtrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <form action="{{ route('products.index') }}" method="get">
                                <div class="mb-3 row">
                                    <div class="col-sm-12" style="display: flex">
                                        <input name="filtervalue" type="text" class="form-control"
                                        aria-label="Text input with segmented dropdown button"  placeholder="Buscar Producto....">
                                        <button type="submit" class=" btn btn-dark  ms-2">Buscar</button>
                                        <a type="button" class="btn btn-success ms-2 rounded" tooltip="tooltip" title="Excel"
                                            href="{{route('export')}}">
                                            <i class="fa-solid fa-file-excel"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger ms-2 rounded" tooltip="tooltip"
                                            title="PDF" onclick="window.location.href='{{ route('products.pdf') }}'">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning ms-2 rounded" tooltip="tooltip"
                                            title="Importar" data-bs-toggle="modal" data-bs-target="#importProducts">
                                            <i class="fa-solid fa-folder-open" style="color: #0a0a0a; width:24; height:24"; ></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table_container">
                    <div >
                        <table class="table table-striped table-hover" style="width:100%" id="example">
                            <thead class="table-dark" >
                                <tr>
                                    <th style="text-align: center">Categoría </th>
                                    <th style="text-align: center">Subcategoría</th>
                                    <th style="text-align: center">Nombre</th>
                                    <th style="text-align: center">Referencia Fabrica</th>
                                    <th style="text-align: center">Clasificación Tributaria</th>
                                    <th style="text-align: center">Precio de Compra</th>
                                    <th style="text-align: center">Precio de Venta sin IVA</th>
                                    <th style="text-align: center">Marca</th>
                                    <th style="text-align: center">Unidad de Medida</th>
                                    <th style="text-align: center">Existencias</th>
                                    <th style="text-align: center">Foto</th>
                                    <th style="text-align: center">Estado</th>
                                    <th style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $producto)
                                    <tr >
                                        <td style="text-align: center">{{ $producto->categoryProduct->name}}</td>
                                        <td style="text-align: center">{{ $producto->subcategory_product}}</td>
                                        <td style="text-align: center">{{ $producto->name_product }}</td>
                                        <td style="text-align: center">{{ $producto->factory_reference }}</td>
                                        <td style="text-align: center">{{ $producto->classification_tax }}</td>
                                        <td style="text-align: center">${{ number_format ($producto->purchase_price,2,'.',',') }}</td>
                                        <td style="text-align: center">${{ number_format ($producto->selling_price,2,'.',',') }}</td>
                                        <td style="text-align: center">{{ $producto->brand->name }}</td>
                                        <td style="text-align: center">{{ $producto->measurementUnit->name }}</td>
                                        <td style="text-align: center">
                                            @if ($producto->stock < 5)
                                                <span class="badge rounded-pill bg-danger" style="font-size: 14px" tooltip="tooltip"
                                                title="Pocas Existencias" >{{ $producto->stock }}</span>
                                            @else
                                                <span>{{ $producto->stock }}</span>
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            @if ($producto->photo)
                                                <img src="{{ asset('storage/' . $producto->photo) }}" width="80" height="80">
                                            @else
                                                <img src="{{ asset('img/products/default.webp') }}" width="80" height="80">
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            @if ($producto->status == 1)
                                                <p class="badge rounded-pill bg-success text-white" style="font-size: 15px">Activo</p>
                                            @else
                                                <p class="badge rounded-pill bg-danger"  style="font-size: 15px">Inactivo</p>
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            <a class="btn btn-sm btn-primary " tooltip="tooltip"
                                            title="Visualizar" href="{{ route('products.show',$producto->id) }}"><i class="fa fa-fw fa-eye"></i> </a>
                                            <a class="btn btn-sm btn-success" tooltip="tooltip"
                                            title="Modificar" href="{{ route('products.edit',$producto->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                <!-- Modal de Confirmacion -->
                                            @if ($producto->status == true)
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" tooltip="tooltip"
                                            title="Inactivar" data-bs-target="#confirmationDestroy-{{$producto->id}}"><i class="fa fa-fw fa-trash"></i></button>
                                            @else
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"  tooltip="tooltip"
                                            title="Activar" data-bs-target="#confirmationDestroy-{{$producto->id}}"><i class="fa-solid fa-rotate"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $productos->links() }} --}}
                    </div>
                </div>
                </div>
                {{-- Script  para mostrar la notificacion --}}
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const mensajeFlash = {!! json_encode(Session::get('notificacion')) !!};
                        if (mensajeFlash) {
                            agregarnotificacion(mensajeFlash);
                        }
                    });
                </script>
                <div class="contenedor-notificacion" id="contenedor-notificacion">
                </div>

            </div>
        </div>
    </div>
</div>
{{-- @include('sweetalert::alert') --}}
@include('product.modal')
@include('product.modalImport')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
<script>
    new DataTable('#example',{
        responsive: true,
        lengthChange: true,
        // paging: false,
        searching: false,
        language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "<<",
                "sLast":     ">>",
                "sNext":     ">",
                "sPrevious": "<"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
</script>
@else
    <div class="mensaje_Rol">
        <img src="{{ asset('img/Rol_no_asignado.png')}}" class="img_rol"/>
        <h2 class="texto_noRol">Pídele al administrador que se te asigne un rol.</h2>
    </div>
@endcan
@endauth
@guest
    @include('include.falta_sesion')
@endguest
