@extends('template')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
<form action="{{ route('credit-note-sales.store') }}" method="post">
    @csrf
<div class="content container-fluid">
    <div class="page-body">
        <div class="container-x1">
            <div class="row row-cards">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-default">
                                <div class="card-header" style="display: flex">
                                    <h3 class="card-title">
                                        {{__('Nota Credito Ventas')}}
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row row-cards">
                                {{--  Buscar Un Numero De Factura  --}}
                                    <div class="col-sm-6 md-6">
                                        <div class="md-3" style="margin-bottom: 16px">
                                            <label for="sale_id" class="form-label" style="font-weight: bolder">
                                                {{ __('Venta') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="sale_id" id="sale_id" class="form-control selectpicker" data-live-search="true" data-size="3" title="Busque una venta aquí">
                                                @foreach ($sales as $key => $sale)
                                                    <option value="{{$sale->id}}-{{$sale->dates}}-{{$sale->sellers}}-{{$sale->cliente->identification_number}}-{{$sale->payments_methods}}">{{$sale->bill_numbers}}</option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('sale_id', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                
                                
                                
                                
                                
                                
                                
                                
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
                                        


                                    {{--  Cliente  --}}
                                    <div class="col-sm-6 md-6">
                                        <div class="mb-3">
                                            <label for="clients_id" class="form-label" style="font-weight: bolder">
                                                {{ __('Cliente') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input disabled type="text" name="clients_id" id="clients_id" class="form-control">
                                            {!! $errors->first('clients_id', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                    
                                        {{--  Motivo --}}
                                        

                                    {{--  Vendedor --}}
                                    
                                            <div class="col-sm-6 md-6">
                                                <div class="mb-3">
                                                    <label for="sellers" class="form-label" style="font-weight: bolder">
                                                        {{ __('Vendedor') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input disabled type="text" name="sellers" id="sellers" class="form-control">
                                                    {!! $errors->first('sellers', '<div class="invalid-feedback">:message</div>') !!}
                                                </div>
                                            </div>
    
                                            
                                    {{--  Metodo de pago --}}
                                    <div class="col-sm-6 md-6">
                                        <div class="mb-3">
                                            <label for="payments_methods" class="form-label" style="font-weight: bolder">
                                                {{ __('Metodo de Pago')}}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input disabled type="text" name="payments_methods" id="payments_methods" class="form-control">  
                                            {!! $errors->first('payments_methods', '<div class="invalid-feedback">:message</div>') !!}
                                        </div> 
                                    </div>
                                    


                                    
                                    {{--  Fecha Detalle De Compra  --}}
                                    
                                    <div class="col-sm-6 md-6">
                                        <div class="md-3" style="margin-bottom: 16px">
                                            <label for="dates" class="form-label" style="font-weight: bolder">
                                                {{ __('Fecha de Compra') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input disabled type="date" name="dates" id="dates" class="form-control">
                                            {!! $errors->first('date_invoice', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>

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
                                    
                                    <div class="col-12">
                                        <table id="tablaDetalleVenta" class="table table-hover w-100">
                                            <style>
                                                .bg-dark-blue {
                                                    background-color: #004080; /* Este es el código de color hexadecimal para azul oscuro */
                                                }
                                            </style>
                                            
                                            <thead class="bg-dark-blue">
                                            
                                                <tr>
                                                    <th class="text-white">Producto</th>
                                                    <th class="text-white">Referencia</th>
                                                    <th class="text-white">Cantidad</th>
                                                    <th class="text-white">Precio de Venta</th>
                                                    <th class="text-white">Descuento</th>
                                                    <th class="text-white">Impuesto</th>
                                                    <th class="text-white">Impuesto Unit.</th>
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
                                                        <label for="th-suma" class="form-label">Sumas:</label>
                                                    </div>
                                                    <div class="col-md-6 text-end">
                                                        <input type="number" id="th-suma" name="th-suma" value="0" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 text-end">
                                                        <label for="th-impuesto" class="form-label">Impuesto:</label>
                                                    </div>
                                                    <div class="col-md-6 text-end">
                                                        <input type="number" id="th-impuesto" name="th-impuesto" value="0" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 text-end">
                                                        <label for="total" class="form-label">Total:</label>
                                                    </div>
                                                    <div class="col-md-6 text-end">
                                                        <input type="number" id="total" name="total" value="0" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card-footer text-end">
                                          
                                                <a class="btn btn-primary" style="margin-right: 2rem" href="{{ route('credit-note-sales.index') }}">Regresar</a>
                                                <input type="submit" class="btn btn-success" value="Realizar Nota">
                                                                        
                                        </div>
                                        
                                    </div>
    </form>
                                
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function() {
        // Capturar el evento change del select #sale_id
        $('#sale_id').change(mostrarValores);
        
        // Adjuntar evento input a los inputs de cantidad
        $(document).on('input', 'input[name="amount"]', recalcularPrecios);
    });

    
    function mostrarValores() {
        let dataVenta = document.getElementById('sale_id').value.split('-');
        let fecha = dataVenta.slice(1, 4).join('-');
        $('#clients_id').val(dataVenta[5]); // suponiendo que dataVenta[3] es el ID del cliente
        $('#dates').val(fecha);
        $('#sellers').val(dataVenta[4]); // suponiendo que dataVenta[2] es el ID del vendedor
        $('#payments_methods').val(dataVenta[6]); // suponiendo que dataVenta[4] es el método de pago
        let selectedSaleId = dataVenta[0]; // Guardar el ID de la venta seleccionada en la variable selectedSaleId
            
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

        // Variables para almacenar el total de los subtotales, el total de impuestos y el total final
        var totalSubtotales = 0;
        var totalImpuestos = 0;

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
                    <td>${detalle.producto.name_product}</td>
                    <td>${detalle.references}</td>
                    <td><input type="text" name="amount" class="form-control" value="${detalle.amount}"></td>
                    <td>${detalle.selling_price}</td>
                    <td>${detalle.discounts}</td>
                    <td>${detalle.tax}</td>
                    <td class="td-impuesto">${impuesto.toFixed(2)}</td>
                    <td class="td-subtotal">${subtotal.toFixed(2)}</td>
                </tr>   
            `);
        });

        // Calcular el total final sumando el total de subtotales y el total de impuestos
        var total = totalSubtotales + totalImpuestos;

        // Actualizar el valor del input de total de subtotales
        $('#th-suma').val(totalSubtotales.toFixed(2));

        // Actualizar el valor del input de total de impuestos
        $('#th-impuesto').val(totalImpuestos.toFixed(2));

        // Actualizar el valor del input de total final
        $('#total').val(total.toFixed(2));
    },
    error: function(xhr, status, error) {
        console.error(error);
    }
});
    }

    
    function recalcularPrecios() {
        var fila = $(this).closest('tr');

        var cantidad = parseInt(fila.find('input[name="amount"]').val());
        var precioVenta = parseFloat(fila.find('td:eq(3)').text());
        var descuento = parseFloat(fila.find('td:eq(4)').text());
        var impuesto = parseFloat(fila.find('td:eq(5)').text());

        var subtotal = (cantidad * precioVenta) - descuento;
        var impuestoTotal = (precioVenta * impuesto * cantidad) / 100;

        fila.find('.td-subtotal').text(subtotal.toFixed(2));
        fila.find('.td-impuesto').text(impuestoTotal.toFixed(2));

        recalcularTotales();
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

        $('#th-suma').val(totalSubtotales.toFixed(2));
        $('#th-impuesto').val(totalImpuestos.toFixed(2));
        $('#total').val(totalFinal.toFixed(2));
    }
</script>

@endpush    