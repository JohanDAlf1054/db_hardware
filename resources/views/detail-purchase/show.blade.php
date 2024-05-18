@auth
@include('include.barra', ['modo'=>'Detalle de Compra'])
@can('detail-purchases')

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Accesos Dirrectos </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

 <!-- Bootstrap CSS -->
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"> --}}


</head>
<body>
    <div class="bread_crumb">
        {{ Breadcrumbs::render('detail.purchase.show', $detailPurchase) }}
    </div>
    @push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script>
        // Tu código JavaScript aquí
    </script>
    @endpush

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{--
<div class="float-right">
    <a class="btn btn-primary" href="{{ route('detail-purchases.index') }}"> {{ __('Back') }}</a>
</div>--}}

        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">



                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">


                        </ul> <br>
                    </div>
                </div>
            </nav>
            <div class="container">
                <form action="{{ route('detail-purchases.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="container-lg mt-4">
        <div class="row gy-4">
            <!------Compra producto---->
            <div class="col-xl-8">
                <div class="text-white bg-primary p-1 text-center">
                    Detalles de la compra
                </div>
                <div class="p-3 border border-3 border-primary">
                    <div class="row">

                        <div class="col-12 mb-4">
                            <label for="producto_id" class="form-label">Producto:</label>
                            <select name="producto_id" id="producto_id" class="form-control selectpicker {{ $errors->has('producto_id') ? ' is-invalid' : '' }}" data-live-search="true" data-size="5" title="Seleccione un producto" disabled>
                                <option value="{{ $detailPurchase->product->id }}" selected>{{ $detailPurchase->product->name_product }}</option>
                            </select>
                            {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        
                        <div class="col-sm-4 mb-2">
                            <label for="precio_compra" class="form-label">Precio de Unitario:</label>
                            <input type="text" id="precio_compra" name="precio_compra" class="form-control" value="{{ isset($detailPurchase) ? $detailPurchase->price_unit : '' }}" readonly>
                        </div>
                        
                        <div class="col-sm-4 mb-2">
                            <label for="cantidad" class="form-label">Cantidad:</label>
                            <input type="text" id="cantidad" name="cantidad" class="form-control" value="{{ isset($detailPurchase) ? $detailPurchase->quantity_units : '' }}" readonly>
                        </div>

                        <div class="col-sm-4 mb-2">
                            <label for="descripcion" class="form-label">Descripcion:</label>
                            <input type="text" id="descripcion" name="descripcion" class="form-control" value="{{ isset($detailPurchase) ? $detailPurchase->description : '' }}" readonly>
                        </div>
                        
                        <div class="col-6 mb-2">
                            <label for="discount_total" class="form-label">Descuento Total</label>
                            <input type="number" id="discount_total" name="discount_total" class="form-control" value="{{ isset($detailPurchase) ? $detailPurchase->discount_total : '' }}" readonly>
                        </div>

                        <div class="col-6 mb-4">
                            <label for="product_tax" class="form-label">Impuesto a cargo del producto</label>
                            <input type="text" id="product_tax" name="product_tax" class="form-control" value="{{ isset($detailPurchase) ? $detailPurchase->product_tax.'%' : '' }}" readonly>
                        </div>

                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="tabla_detalle" class="table table-hover">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Descripcion</th>
                                            <th>Impuesto</th>
                                            <th>Descuento</th>
                                            <th>Precio Unitario</th>
                                            <th>Sub Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detailPurchases as $detailPurchase)
                                            <tr class="detailPurchase">
                                               {{-- <th>{{ $detailPurchase->id }}</th>--}}
                                               <td></td>
                                                <td>{{ $detailPurchase->product->name_product }}</td>
                                                <td class="quantity_units">{{ $detailPurchase->quantity_units }}</td>
                                                <td>{{ $detailPurchase->description }}</td>
                                                <td>{{ $detailPurchase->discount_total }}</td>
                                                <td class="product_tax">{{ round($detailPurchase->product_tax, 2).'%' }}</td>
                                                <td class="price_unit">{{ round($detailPurchase->price_unit, 2) }}</td>
                                                <td class="subtotal">{{ $detailPurchase->quantity_units * $detailPurchase->price_unit }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">Sumas</th>
                                            <th colspan="2"><span id="sumas">0</span></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">IGV %</th>
                                            <th colspan="2"><span id="igv">0</span></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">Total</th>
                                            <th colspan="2"><input type="hidden"name="total" value="0" id="inputTotal"><span id="total">0</span></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">Total Bruto</th>
                                            <th colspan="2"><span id="totalBruto">
                                                0</span></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">Total Neto</th>
                                            <th colspan="2"><span id="totalNeto">{{ $totalNeto->net_total }}</span></th>
                                        </tr>

                                    </tfoot>

                                </table>
                            </div>
                        </div>

                       {{-- <div class="col-12 mt-2">
                            <button id="cancelar" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Cancelar compra
                            </button>
                        </div>--}}
                    </div>
                </div>
            </div>

            <!-----Compra---->
            <div class="col-xl-4">
                <div class="text-white bg-success p-1 text-center">
                    Datos generales
                </div>
                <div class="p-3 border border-3 border-success">
                    <div class="row">
                        <!--Proveedor-->
                        <div class="col-12">
                            <label for="people_id" class="form-label">Proveedor:</label>
                            <select name="people_id" id="people_id" class="form-control selectpicker show-tick" data-live-search="true" title="Selecciona el cliente" data-size="3">
                                @foreach ($people as $person)
                                    <option value="{{ $person->id }}">{{ $person->identification_number }} - {{ $person->first_name }} {{ $person->other_name }} {{ $person->surname }} {{ $person->second_surname }} {{ $person->company_name }}</option>
                                @endforeach
                            </select>
                            @error('people_id')
                            <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        

                        <div class="col-6 mb-2">
                            <label for="user_id" class="form-label">Empleado a cargo:</label>
                            <input type="text" id="user_id" name="user_id" class="form-control" value="{{ isset($detailPurchase) && isset($detailPurchase->purchaseSupplier) && isset($detailPurchase->purchaseSupplier->user) ? $detailPurchase->purchaseSupplier->user->name : '' }}" readonly>
                        </div>

                            <div class="col-sm-6 mb-2">
                                <label for="fecha" class="form-label">Fecha:</label>
                                <input readonly type="date" name="fecha" id="fecha" class="form-control border-success" value="<?php echo date("Y-m-d") ?>">
                            </div>

                            <div class="col-6 mb-2">
                                <label for="code" class="form-label">Prefijo:</label>
                                <div class="input-group">
                                    <select name="code" id="code" class="form-control selectpicker" disabled>
                                        <option value="Pre-" {{ isset($detailPurchase) && isset($detailPurchase->purchaseSupplier) && $detailPurchase->purchaseSupplier->code == 'Pre-' ? 'selected' : '' }}>Pre</option>
                                        <option value="Po-" {{ isset($detailPurchase) && isset($detailPurchase->purchaseSupplier) && $detailPurchase->purchaseSupplier->code == 'Po-' ? 'selected' : '' }}>Po</option>
                                        <option value="Es-" {{ isset($detailPurchase) && isset($detailPurchase->purchaseSupplier) && $detailPurchase->purchaseSupplier->code == 'Es-' ? 'selected' : '' }}>Es</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6 mb-2">
                                <label for="factura" class="form-label">Número de factura</label>
                                <input type="text" id="factura" name="factura" class="form-control" value="{{ isset($detailPurchase) && isset($detailPurchase->purchaseSupplier) ? $detailPurchase->purchaseSupplier->invoice_number_purchase : '' }}" readonly>
                            </div>
                            
                            <div class="col-6 mb-2">
                                <label for="form_of_payment" class="form-label">Formas de pago:</label>
                                <input type="text" id="form_of_payment" name="form_of_payment" class="form-control" value="{{ isset($detailPurchase) ? $detailPurchase->form_of_payment : '' }}" readonly>
                            </div>


                            <div class="col-6 mb-2">
                                <label for="method_of_payment" class="form-label">Método de Pago:</label>
                                <input type="text" id="method_of_payment" name="method_of_payment" class="form-control" value="{{ isset($detailPurchase) ? $detailPurchase->method_of_payment : '' }}" readonly>
                            </div>


                             {{-- <div class="col-12 mt-4 text-center">
                                    <button type="submit" class="btn btn-success" id="guardar">Realizar compra</button>
                                </div>--}}

                            </div>
                        </div>
                       <br>
                        <div class="float-right text-end" >
                            <a class="btn btn-primary" href="{{ route('detail-purchases.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                </div>

            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Advertencia</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Seguro que quieres cancelar la compra?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button id="btnCancelarCompra" type="button" class="btn btn-danger" data-bs-dismiss="modal">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script> --}}
    <script>
function round(num, decimales = 2) {
    var signo = (num >= 0 ? 1 : -1);
    num = num * signo;
    if (decimales === 0) //con 0 decimales
        return signo * Math.round(num);
    // round(x * 10 ^ decimales)
    num = num.toString().split('e');
    num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
    // x * 10 ^ (-decimales)
    num = num.toString().split('e');
    return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
}

$(document).ready(function() {
    var sumas = 0;
    var totalTax = 0;

    $('.detailPurchase').each(function() {
        var priceUnit = parseFloat($(this).find('.price_unit').text());
        var quantityUnits = parseFloat($(this).find('.quantity_units').text());
        var productTax = parseFloat($(this).find('.product_tax').text()) / 100;
        var descuento = parseFloat($('#discount_total').text());
        var subtotal = round(priceUnit * quantityUnits);
        $(this).find('.subtotal').text(subtotal);

        sumas += subtotal;
        totalTax += round(subtotal * productTax);

    });

    $('#sumas').text(round(sumas));
    $('#igv').text(round(totalTax));

    var total = round(sumas + totalTax);
    $('#total').text(total);
    $('#totalBruto').text(round(sumas));

    console.log(totalBruto)
});

    </script>
    <script>
    $(document).ready(function(){
    $('#btn_agregar').click(function(){
        agregarProducto();
    });
    });
    let cont=0;
    let subtotal=[];
    let sumas=0;
    let igv=0;
    let total=0;
    let totalBruto=0;
    let totalNeto = 0;

    function agregarProducto(){
        let idProducto = $('#producto_id').val();
        let nameProducto = $('#producto_id option:selected').text();
        let cantidad=$('#cantidad').val();
        let descripcion=$('#precio_venta').val();
        let impuesto=$('#product_tax').val();
        let precioCompra=$('#precio_compra').val();
        let descuento=$('#discount_total').val();
    //calcular valores
    subtotal[cont] = cantidad * precioCompra;
    sumas += subtotal[cont];
    igv = sumas * impuesto / 100;
    total = sumas + igv;
    totalBruto = sumas;
    totalNeto = totalBruto-descuento;
    $('#gross_total').val(totalBruto);

    let fila='<tr>'+
        '<th>'+ (cont+1) +'</th>'+
        '<td>'+ nameProducto +'</td>'+
        '<td>'+ cantidad +'</td>'+
        '<td>'+ descripcion +'</td>'+
        '<td>'+ impuesto +'</td>'+
        '<td>'+ precioCompra +'</td>'+
        '<td>'+ subtotal[cont] +'</td>'+

        '</tr>';
        $('#tabla_detalle').append(fila);
        limpiarCampos();
        cont++;
        $('#sumas').html(sumas);
        $('#igv').html(igv);
        $('#total').html(total);
        $('#totalBruto').html(totalBruto);
        $('#totalNeto').html(totalNeto);
    }
    function limpiarCampos(){
        //let select=$('#producto_id');
        //select.val(''); // Restablece el valor a vacío
        //$('#cantidad').val('');
        //$('#precio_venta').val('');
        //$('#precio_compra').val('');
    }

        </script>
        <script>
            document.getElementById('factura').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var date = selectedOption.getAttribute('data-date');
            document.getElementById('fecha').value = date;
            });
        </script>
        <script>
            document.getElementById('people_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var identificationType = selectedOption.getAttribute('data-identification-type');
            var identificationNumber = selectedOption.getAttribute('data-identification-number');
            document.getElementById('identification_type').value = identificationType;
            document.getElementById('identification_number').value = identificationNumber;
            });
        </script>
        <script>
            document.getElementById('producto_id').addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var sellingPrice = selectedOption.getAttribute('data-selling-price');
                var classificationTax = selectedOption.getAttribute('data-classification-tax');

                // Si classificationTax es nulo o vacío, establecerlo en 0
                if (classificationTax === null || classificationTax === '') {
                    classificationTax = 0;
                }

                document.getElementById('precio_compra').value = sellingPrice;
                document.getElementById('product_tax').value = classificationTax;
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
