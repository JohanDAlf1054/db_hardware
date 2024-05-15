@auth
@include('include.barra', ['modo' => 'Historial De Movimientos'])
<!DOCTYPE html>
<br>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
<link href="css/estilos_notificacion.css" rel="stylesheet"/>
<script src="{{ asset('js/notificaciones.js')}}" defer></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">
<script src="{{ asset('js/tooltips.js') }}" defer></script>
</head>
<div class="container-fluid">
    
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-default">
                <div class="card-header" style="display: flex">
                    <button type="button" class="btn btn-light">
                        <a href="{{route('index_informes')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                        </a>
                    </button>
                    <h2 id="card_title">
                        {{ __('Informe Historial de Precios') }}
                    </h2>
                </div>
                
                <div class="card-body">
                    <div class="row border border-light p-2 mb-3 d-flex align-items-start">
                        <div class="col-12 col-md-6">
                            <div class="form-group d-flex align-items-center">
                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                    <label for="subcategoria" class="form-label">SubCategoria Del Producto</label>
                                    <select id="subcategoria" class="selectpicker form-control" data-live-search="true" style="text-align-last:center;">
                                        <option>Categoría 1</option>
                                        <option>Categoría 2</option>
                                        <option>Categoría 3</option>
                                        <!-- Agrega más opciones según sea necesario -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center mt-3">
                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                    <label for="categoria" class="form-label">Categoria De Productos</label>
                                    <select id="categoria" class="selectpicker form-control" data-live-search="true" style="text-align-last:center;">
                                        <option>Subcategoría 1</option>
                                        <option>Subcategoría 2</option>
                                        <option>Subcategoría 3</option>
                                        <!-- Agrega más opciones según sea necesario -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center mt-2">
                                <div class="d-flex flex-column flex-grow-1 mr-2 mb-3">
                                    <label for="producto" class="form-label">Producto</label>
                                    <select id="producto" class="selectpicker form-control ml-2" data-live-search="true" style="text-align-last:center;">
                                        <option>Producto 1</option>
                                        <option>Producto 2</option>
                                        <option>Producto 3</option>
                                        <!-- Agrega más opciones según sea necesario -->
                                    </select>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-start">
                                <button type="button" class="btn btn-primary">Buscar</button>
                                <span class="mx-3"></span> <!-- Agregar un elemento span con margen horizontal -->
                                <button type="button" class="btn btn-secondary">Limpiar</button>
                              </div>
                                                  
                                
                            </div>
                            
                            <div class="col-12 col-md-6">
                                <div class="form-group d-flex align-items-center">
                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                        <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                                        <input id="fecha_inicio" type="date" class="form-control" style="text-align-last:center;">
                                    </div>
                                </div>
                                <div class="form-group d-flex align-items-center mt-3">
                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                        <label for="fecha_cierre" class="form-label">Fecha de cierre</label>
                                        <input id="fecha_cierre" type="date" class="form-control" style="text-align-last:center;">
                                    </div>
                                </div>
                                <div class="form-group d-flex align-items-center mt-2">
                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                        <label for="estado" class="form-label">Estado</label>
                                        <select id="estado" class="selectpicker form-control ml-2" data-live-search="true" style="text-align-last:center;">
                                            <option>Activo</option>
                                            <option>Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                    </div>
                    
                        <div class="table_container">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" style="justify-content: center; width: 100%;" id="example">
                                    <thead class="table-dark">
                                        <tr style="text-align: center">
                                            <th>Nombre Del Producto</th>
                                            <th>Referencia De Fabrica</th>
                                            <th>Cantidad Inicial</th>
                                            <th>Cantidad Entrada</th>
                                            <th>Fecha Inicial </th>
                                            <th>Fecha Final</th>
                                            <th>Fecha De La Factura</th>
                                            <th>Cantidad De Salida</th>
                                            <th>Saldo De Cantidades</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                </table>
                            </div>
                        </div> 
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
<script>
    new DataTable('#example',{
        responsive: true,
        lengthChange: false,
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
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        }
    });
</script>
</html>
@endauth
@guest
    @include('include.falta_sesion')
@endguest