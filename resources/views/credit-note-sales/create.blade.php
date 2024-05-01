@extends('template')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

<div class="bread_crumb">
    {{ Breadcrumbs::render('credit.note.sales.create') }}
</div>
<br>
@section('content')

<div class="content container-fluid">
    <div class="page-body">
        <div class="container-x1">
            <div class="row row-cards">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-default">
                                <div class="card-header" style="display: flex">
                                    <h3 class="card-title">
                                        {{__('Nota Crédito Ventas')}}
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                  
                                <form action="{{ route('credit-note-sales.store') }}" method="post">
                                    @csrf
                                <div class="row row-cards">
                                {{--  Buscar Un Numero De Factura  --}}
                                    <div class="col-sm-6 md-6">
                                        <div class="md-3" style="margin-bottom: 16px">
                                            <label for="datos" class="form-label" style="font-weight: bolder">
                                                {{ __('Venta') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="datos" id="datos" class="form-control selectpicker" data-live-search="true" data-size="3" title="Busque una venta aquí">
                                                @foreach ($sales as $key => $sale)
                                                    <option value="{{$sale->id}}-{{$sale->dates}}-{{$sale->sellers}}-{{$sale->clients_id}}-{{$sale->payments_methods}}">{{$sale->bill_numbers}}</option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('datos', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
<<<<<<< HEAD
                                
                                
                                
                              
                                
=======








>>>>>>> 28dcad2768f553706a950b44c1e4806c0bb4d4c9
                                        {{--  Fecha De Elaboracion Nota Credito  --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="md-3" style="margin-bottom: 16px">
                                                <label for="date_credit_notes" class="form-label" style="font-weight: bolder">
                                                    {{ __('Fecha de Creación Nota Credito') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="date" id="date_credit_notes" name="date_credit_notes" value="{{ date('Y-m-d') }}" class="form-control{{ $errors->has('date_invoice') ? ' is-invalid' : '' }}">
                                                {!! $errors->first('date_credit_notes', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
<<<<<<< HEAD
                                        
 {{--  Motivo --}}
           
    
=======


>>>>>>> 28dcad2768f553706a950b44c1e4806c0bb4d4c9

                                    {{--  Cliente  --}}
                                    <div class="col-sm-6 md-6">
                                        <div class="mb-3">
                                            <label for="clients_id" class="form-label" style="font-weight: bolder">
                                                {{ __('Cliente') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="clients_id" id="clients_id" class="form-control">
                                            {!! $errors->first('clients_id', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
<<<<<<< HEAD
                                    
                                       
=======

                                        {{--  Motivo --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="reason" class="form-label" style="font-weight: bolder">
                                                    {{ __('Motivo')}}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select name="reason" id="reason" class="form-control selectpicker" data-live-search="true" data-size="6" title="Motivo ...">
                                                    <option value="Devolucion de parte de los bienes">Devolución de parte de los bienes</option>
                                                    <option value="Anulacion de factura electronica">Anulación de factura electrónica</option>
                                                    <option value="Rebaja o descuento parcial o total">Rebaja o descuento parcial o total</option>
                                                    <option value="Ajuste de precio">Ajuste de precio</option>
                                                    <option value="Otros">Otros</option>
                                                </select>
                                                {!! $errors->first('reason', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
>>>>>>> 28dcad2768f553706a950b44c1e4806c0bb4d4c9

                                    {{--  Vendedor --}}

                                            <div class="col-sm-6 md-6">
                                                <div class="mb-3">
                                                    <label for="sellers" class="form-label" style="font-weight: bolder">
                                                        {{ __('Vendedor') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="sellers" id="sellers" class="form-control">
                                                    {!! $errors->first('sellers', '<div class="invalid-feedback">:message</div>') !!}
                                                </div>
                                            </div>
<<<<<<< HEAD
    
                                        
        
=======


>>>>>>> 28dcad2768f553706a950b44c1e4806c0bb4d4c9
                                    {{--  Metodo de pago --}}
                                    <div class="col-sm-6 md-6">
                                        <div class="mb-3">
                                            <label for="payments_methods" class="form-label" style="font-weight: bolder">
                                                {{ __('Método de Pago')}}
                                                <span class="text-danger">*</span>
                                            </label>
<<<<<<< HEAD
                                            <input  type="text" name="payments_methods" id="payments_methods" class="form-control">  
=======
                                            <input type="text" name="payments_methods" id="payments_methods" class="form-control">
>>>>>>> 28dcad2768f553706a950b44c1e4806c0bb4d4c9
                                            {!! $errors->first('payments_methods', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
<<<<<<< HEAD
                                    
                                 
                                    
=======




>>>>>>> 28dcad2768f553706a950b44c1e4806c0bb4d4c9
                                    {{--  Fecha Detalle De Compra  --}}

                                    <div class="col-sm-6 md-6">
                                        <div class="md-3" style="margin-bottom: 16px">
                                            <label for="date_invoice" class="form-label" style="font-weight: bolder">
                                                {{ __('Fecha de Compra') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" name="date_invoice" id="date_invoice" class="form-control">
                                            {!! $errors->first('date_invoice', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>

<<<<<<< HEAD
                                    

                                   
                                    <div class="col-sm-6 md-6">
                                        <div class="mb-3">
                                            <label for="reason" class="form-label" style="font-weight: bolder">
                                                {{ __('Motivo')}}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="reason" id="reason" class="form-control selectpicker" data-live-search="true" data-size="6" title="Motivo ...">
                                                <option value="Devolucion de parte de los bienes">Devolución de parte de los bienes</option>
                                                <option value="Anulacion de factura electronica">Anulación de factura electrónica</option>
                                                <option value="Rebaja o descuento parcial o total">Rebaja o descuento parcial o total</option>
                                                <option value="Ajuste de precio">Ajuste de precio</option>
                                                <option value="Otros">Otros</option>
                                            </select>
                                            {!! $errors->first('reason', '<div class="invalid-feedback">:message</div>') !!}
                                        </div> 
                                        <br>
                                    </div>
                                    
=======
>>>>>>> 28dcad2768f553706a950b44c1e4806c0bb4d4c9
                                    <div class="col-12">
                                        <table id="tablaDetalleVenta" class="table table-hover w-100">
                                            <style>
                                                .bg-dark-blue {
                                                    background-color: #004080; /* Este es el código de color hexadecimal para azul oscuro */
                                                }
                                            </style>

                                            <thead class="bg-dark-blue">

                                                <tr>
                                                    <th class="text-white">Id</th>
                                                    <th class="text-white">Producto</th>
                                                    <th class="text-white">Referencia</th>
                                                    <th class="text-white">Cantidad</th>
                                                    <th class="text-white">Precio de Venta</th>
                                                    <th class="text-white">Descuento</th>
                                                    <th class="text-white">Impuesto</th>
                                                    <th class="text-white">Subtototal</th>
                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-md-12 text-end">
                                                <div class="row">
                                                    <div class="col-md-6 text-end">
                                                        <label for="gross_totals" class="form-label">Sumas:</label>
                                                    </div>
                                                    <div class="col-md-6 text-end">
                                                        <input type="number" id="gross_totals" name="gross_totals" value="0" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 text-end">
                                                        <label for="taxes_total" class="form-label">Impuesto:</label>
                                                    </div>
                                                    <div class="col-md-6 text-end">
                                                        <input type="number" id="taxes_total" name="taxes_total" value="0" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 text-end">
                                                        <label for="net_total" class="form-label">Total:</label>
                                                    </div>
                                                    <div class="col-md-6 text-end">
                                                        <input type="number" id="net_total" name="net_total" value="0" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
<<<<<<< HEAD
                                        <input type="hidden" name="sale_id" id="sale_id">
                                        <div class="card-footer text-end">
                                            <a class="btn btn-primary" style="margin-right: 2rem" href="{{ route('credit-note-sales.index') }}">Regresar</a>
                                            <button type="submit" class="btn btn-success">Realizar Nota</button>
                                        </div>
                                    </form> 
                                        
                                    @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                
                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                    </div>

                                
=======

                                        <div class="card-footer text-end">

                                                <a class="btn btn-primary" style="margin-right: 2rem" href="{{ route('credit-note-sales.index') }}">Regresar</a>
                                                <input type="submit" class="btn btn-success" value="Realizar Nota">

                                        </div>

                                    </div>
                                </form>

>>>>>>> 28dcad2768f553706a950b44c1e4806c0bb4d4c9
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
<script>
<<<<<<< HEAD
    $(document).ready(function() {
        // Capturar el evento change del select #sale_id
        $('#datos').change(mostrarValores);
        
        // Adjuntar evento input a los inputs de cantidad
        $(document).on('input', 'input[name="amount[]"]', recalcularPrecios);
    });

    
    function mostrarValores() {
        let dataVenta = document.getElementById('datos').value.split('-');
        let fecha = dataVenta.slice(1, 4).join('-');
        $('#clients_id').val(dataVenta[5]); // suponiendo que dataVenta[3] es el ID del cliente
        $('#date_invoice').val(fecha);
        $('#sellers').val(dataVenta[4]); // suponiendo que dataVenta[2] es el ID del vendedor
        $('#payments_methods').val(dataVenta[6]); // suponiendo que dataVenta[4] es el método de pago
        let selectedSaleId = dataVenta[0]; // Obtener el ID de la venta seleccionada
        $('#sale_id').val(selectedSaleId); // Guardar el ID de la venta seleccionada en la variable selectedSaleId
            
        console.log(dataVenta);
        console.log(selectedSaleId); // Esto imprimirá el ID de la venta seleccionada en la consola 
    
        // Realizar una solicitud AJAX al servidor para obtener el detalle de la venta
        $.ajax({
    url: '/obtener-detalle-venta',
    type: 'GET',
    data: { sale_id: selectedSaleId },
    success: function(response) {
        // Limpiar la tabla de productos antes de agregar los nuevos
        $('#tablaDetalleVenta tbody').empty();
=======
     $(document).ready(function() {

$('#sale_id').change(mostrarValores);
>>>>>>> 28dcad2768f553706a950b44c1e4806c0bb4d4c9


<<<<<<< HEAD
        // Iterar sobre los detalles de venta y agregarlos a la tabla
        response.detallesVenta.forEach(function(detalle) {
            // Calcular subtotal
            var subtotal = (detalle.amount * detalle.selling_price) - detalle.discounts;
            totalSubtotales += subtotal;

            // Calcular impuesto
            var impuesto = (detalle.selling_price * detalle.tax) / 100;
            totalImpuestos += impuesto;

            $('#tablaDetalleVenta tbody').append(`  
                <tr>
                    <td><input type="text" name="arrayidproducto[]" class="form-control" value="${detalle.product_id}"></td>
                    <td><input type="text" name="arrayname[]" class="form-control" value="${detalle.producto.name_product}"></td>
                    <td><input type="text" name="arrayreference[]" class="form-control" value="${detalle.references}"></td>
                    <td><input type="text" name="amount[]" class="form-control" value="${detalle.amount}"></td>
                    <td><input type="text" name="selling_price[]" class="form-control" value="${detalle.selling_price}"></td>
                    <td><input type="text" name="discounts[]" class="form-control" value="${detalle.discounts}"></td>
                    <td><input type="text" name="tax[]" class="form-control" value="${detalle.tax}"></td>
                    <input type="hidden" class="td-impuesto" value="${impuesto.toFixed(2)}">
                    <td class="td-subtotal">${subtotal.toFixed(2)}</td>
                </tr>   
            `);
        });

        // Calcular el total final sumando el total de subtotales y el total de impuestos
        var total = totalSubtotales + totalImpuestos;

        // Actualizar el valor del input de total de subtotales
        $('#gross_totals').val(totalSubtotales.toFixed(2));

        // Actualizar el valor del input de total de impuestos
        $('#taxes_total').val(totalImpuestos.toFixed(2));

        // Actualizar el valor del input de total final
        $('#net_total').val(total.toFixed(2));
    },
    error: function(xhr, status, error) {
        console.error(error);
    }
=======
>>>>>>> 28dcad2768f553706a950b44c1e4806c0bb4d4c9
});

function mostrarValores() {
        let dataVenta= document.getElementById('sale_id').value.split('-');
        console.log(dataVenta)
        let fecha = dataVenta.slice(1, 4).join('-'); // Unir los elementos de la fecha con '-'
         console.log(fecha);
        $('#clients_id').val(dataVenta[5]);
        $('#dates').val(fecha);
        $('#sellers').val(dataVenta[4]);
        $('#payments_methods').val(dataVenta[6]);

    }

<<<<<<< HEAD
    function recalcularPrecios() {
            $('#tablaDetalleVenta tbody tr').each(function() {
                var fila = $(this);

                var cantidad = parseInt(fila.find('input[name="amount[]"]').val());
                var precioVenta = parseFloat(fila.find('input[name="selling_price[]"]').val());
                var descuento = parseFloat(fila.find('input[name="discounts[]"]').val());
                var impuesto = parseFloat(fila.find('input[name="tax[]"]').val());

                var subtotal = (cantidad * precioVenta) - descuento;
                var impuestoTotal = (precioVenta * impuesto * cantidad) / 100; // El impuesto se calcula con la cantidad original

                fila.find('.td-subtotal').text(subtotal.toFixed(2));
                fila.find('.td-impuesto').text(impuestoTotal.toFixed(2));
            });

            recalcularTotales(); // Se deben recalcular los totales después de recalcular los precios
        }

        function recalcularTotales() {
            var totalSubtotales = 0;
            var totalImpuestos = 0;

            $('#tablaDetalleVenta tbody tr').each(function() {
                var subtotalFila = parseFloat($(this).find('.td-subtotal').text());
                var impuestoFila = parseFloat($(this).find('.td-impuesto').text());

                totalSubtotales += subtotalFila;
                totalImpuestos += impuestoFila;
            });

            var totalFinal = totalSubtotales + totalImpuestos;

            $('#gross_totals').val(totalSubtotales.toFixed(2));
            $('#taxes_total').val(totalImpuestos.toFixed(2));
            $('#net_total').val(totalFinal.toFixed(2));
        }

  
=======
>>>>>>> 28dcad2768f553706a950b44c1e4806c0bb4d4c9
</script>
@endpush
