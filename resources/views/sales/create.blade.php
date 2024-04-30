@extends('template')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

<div class="bread_crumb">
    {{ Breadcrumbs::render('sales.create') }}
</div>
<br>
@section('content')
<div class="card">
    <div class="card-header">
        <h2 id="card_title">
            {{ __('Detalle de Venta') }}
        </h2>
    </div>
    </div>


<form action="{{ route('sales.store') }}" method="post">
    @csrf
    <div class="container-lg mt-4">
        <div class="row gy-4">

            <!------venta producto---->
            <div class="col-xl-8">
                <div class="text-white bg-primary p-1 text-center">
                    Detalles de la venta
                </div>
                <div class="p-3 border border-3 border-primary">
                    <div class="row gy-4">


                        <!-----Producto---->
                        <div class="col-12">
                            <select name="product_id" id="product_id" class="form-control selectpicker" data-live-search="true" data-size="3" title="Busque un producto aquí">
                                @foreach ($products as $item)
                                <option value="{{$item->id}}-{{$item->stock}}-{{$item->selling_price}}-{{$item->classification_tax}}-{{$item->factory_reference}}">{{$item->name_product}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-----Impuesto---->
                        <div class="col-sm-4">
                            <label for="tax" class="form-label">Impuesto:</label>
                             <input disabled type="text" name="tax" id="tax" class="form-control" step="0.1">
                             @error('tax')
                             <small class="text-danger">{{ '*'.$message }}</small>
                             @enderror
                        </div>


                        <!-----Stock--->
                        <div class="col-sm-4">
                            <label for="stock" class="form-label">Stock:</label>
                             <input disabled type="number" name="stock" id="stock" class="form-control" step="0.1">
                        </div>

                        <!-----Precio de venta---->
                        <div class="col-sm-4">
                            <label for="selling_price" class="form-label">Precio de venta:</label>
                             <input type="number" name="selling_price" id="selling_price" class="form-control" step="0.1">
                        </div>

                        <!-----Cantidad---->
                        <div class="col-sm-4">
                            <label for="amount" class="form-label">Cantidad:</label>
                            <input type="number" name="amount" id="amount" class="form-control">
                        </div>

                        <!----Descuento---->
                        <div class="col-sm-4">
                            <label for="discounts" class="form-label">Descuento:</label>
                            <input type="number" name="discounts" id="discounts" class="form-control">
                        </div>



                        <!-----botón para agregar--->
                        <div class="col-12 text-end">
                            <button id="btn_agregar" class="btn btn-primary" type="button">Agregar</button>
                        </div>

                        <!-----Tabla para el detalle de la venta--->
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="tabla_detalle" class="table table-hover">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Producto</th>
                                            <th>Referencia</th>
                                            <th>Cant</th>
                                            <th>Valor Unitario</th>
                                            <th>% Desc</th>
                                            <th>Impuesto</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">Total Bruto</th>
                                            <th colspan="2"><input type="hidden" name="gross_totals" value="0" id="inputGross"><span id="gross_totals">0</span></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">Total Iva %</th>
                                            <th colspan="2"><input type="hidden" name="taxes_total" value="0" id="inputTaxes"><span id="taxes_total">0</span></th>
                                        </tr>

                                        <tr>
                                            <th></th>
                                            <th colspan="4">Total Neto</th>
                                            <th colspan="2"> <input type="hidden" name="net_total" value="0" id="inputTotal"><span id="net_total">0</span></th>
                                        </tr>

                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!--Boton para cancelar venta--->
                        <div class="col-12">
                            <button id="cancelar" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Cancelar venta
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <!-----Venta---->
            <div class="col-xl-4">
                <div class="text-white bg-success p-1 text-center">
                    Datos generales
                </div>
                <div class="p-3 border border-3 border-success">
                    <div class="row gy-4">

                        <!--Cliente-->
                        <div class="col-12">
                            <label for="clients_id" class="form-label">Cliente:</label>
                            <select name="clients_id" id="clients_id" class="form-control selectpicker show-tick" data-live-search="true" title="Selecciona" data-size='3'>
                                @foreach ($clients as $item)
                                <option value="{{$item->id}}">{{$item->identification_number}}</option>
                                @endforeach
                            </select>
                            @error('clients_id')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>

                        <!--Fecha--->
                        <div class="col-sm-12">
                            <label for="dates" class="form-label">Fecha:</label>
                            <input readonly type="date" name="dates" id="dates" class="form-control border-success" value="<?php echo date("Y-m-d") ?>">
                            <?php

                            use Carbon\Carbon;

                            $fecha_hora = Carbon::now()->toDateTimeString();
                            ?>
                            <input type="hidden" name="dates" value="{{$fecha_hora}}">
                        </div>



                        <!--Numero de comprobante-->
                        <div class="col-12">
                            <label for="bill_numbers" class="form-label">Prefijo y Número:</label>
                            <div class="input-group">
                                <select name="bill_prefix" class="form-control selectpicker">
                                    <option value="Pre-">Pre</option>
                                    <option value="Po-">Po</option>
                                    <option value="Es-">Es</option>
                                </select>
                                <input required type="text" name="bill_numbers" id="bill_numbers" class="form-control" placeholder="Número">
                            </div>
                            @error('bill_numbers')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>

                        <!--Forma de pago-->
                        <div class="col-12">
                            <label for="payments_methods" class="form-label">Forma de pago:</label>
                            <select name="payments_methods" class="form-control selectpicker">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Consignacion">Consignación</option>
                                <option value="Tarjeta">Tarjeta</option>
                            </select>
                            @error('payments_methods')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>

                         <!--Vendedor-->
                         <div class="col-12">
                            <label for="sellers" class="form-label">Vendedor:</label>
                            <select name="sellers" class="form-control selectpicker">
                                <option value="Camilo">Camilo</option>
                                <option value="Brayan">Brayan</option>
                                <option value="Maira">Maira</option>
                            </select>
                            @error('sellers')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>


                     <input type="hidden" name="factory_reference"  id="factory_reference">


                        <!--Botones--->
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success" id="guardar">Realizar venta</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para cancelar la venta -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Advertencia</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Seguro que quieres cancelar la venta?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="btnCancelarVenta" type="button" class="btn btn-danger" data-bs-dismiss="modal">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function() {

        $('#product_id').change(mostrarValores);


        $('#btn_agregar').click(function() {
            agregarProducto();
        });

        $('#btnCancelarVenta').click(function() {
            cancelarVenta();
        });

        disableButtons();


    });

    //Variables
    let cont = 0;
    let subtotal = [];
    let sumas = 0;
    let sumasdescuento=0;
    let igv = 0;
    let total = 0;



    function mostrarValores() {
        let dataProducto = document.getElementById('product_id').value.split('-');
        console.log(dataProducto)
        $('#stock').val(dataProducto[1]);
        $('#selling_price').val(dataProducto[2]);
        $('#tax').val(dataProducto[3]);
        $('#factory_reference').val(dataProducto[4]);
    }

    function agregarProducto() {
    let dataProducto = document.getElementById('product_id').value.split('-');
    // Obtener valores de los campos
    let idProducto = dataProducto[0];
    let nameProducto = $('#product_id option:selected').text();
    let cantidad = $('#amount').val();
    let precioVenta = $('#selling_price').val();
    let descuento = $('#discounts').val();
    let stock = $('#stock').val();
    let factoryreference = $('#factory_reference').val();
    let impuesto = parseFloat(dataProducto[3]); // Obtener el impuesto del array

    if (descuento == '') {
        descuento = 0;
    }

    // Validaciones
    if (idProducto != '' && cantidad != '') {
        if (parseInt(cantidad) > 0 && (cantidad % 1 == 0) && parseFloat(descuento) >= 0) {
            if (parseInt(cantidad) <= parseInt(stock)) {
                // Calcular subtotal del producto
                let subtotalProducto = round(cantidad * precioVenta - descuento);
                subtotal[cont] = subtotalProducto;
                sumas += subtotal[cont];
                igv += round(subtotalProducto / 100 * impuesto); // Ajustar el impuesto acumulativo
                total = round(sumas + igv);

                // Crear la fila
                let fila = '<tr id="fila' + cont + '">' +
                    '<th>' + (cont + 1) + '</th>' +
                    '<td><input type="hidden" name="arrayidproducto[]" value="' + idProducto + '">' + nameProducto + '</td>' +
                    '<td><input type="hidden" name="arrayname[]" value="' + factoryreference + '">' + factoryreference + '</td>' +
                    '<td><input type="hidden" name="arraycantidad[]" value="' + cantidad + '">' + cantidad + '</td>' +
                    '<td><input type="hidden" name="arrayprecioventa[]" value="' + precioVenta + '">' + precioVenta + '</td>' +
                    '<td><input type="hidden" name="arraydescuento[]" value="' + descuento + '">' + descuento + '</td>' +
                    '<td><input type="hidden" name="arrayimpuesto[]" value="' + impuesto + '">' + impuesto + '%'+ '</td>' +
                    '<td>' + subtotalProducto + '</td>' +
                    '<td><button class="btn btn-danger" type="button" onClick="eliminarProducto(' + cont + ', ' + subtotalProducto + ', ' + impuesto + ')"><i class="fa-solid fa-trash"></i></button></td>' +
                    '</tr>';

                // Acciones después de añadir la fila
                $('#tabla_detalle').append(fila);
                limpiarCampos();
                cont++;
                disableButtons();

                // Actualizar los campos calculados
                $('#gross_totals').html(sumas);
                $('#inputGross').val(sumas);
                $('#taxes_total').html(igv);
                $('#inputTaxes').val(igv);
                $('#net_total').html(total);
                $('#inputTotal').val(total);
            } else {
                showModal('Cantidad incorrecta');
            }
        } else {
            showModal('Valores incorrectos');
        }
    } else {
        showModal('Le faltan campos por llenar');
    }
}

function eliminarProducto(indice, subtotalProducto, impuesto) {
    // Restar el subtotal del producto eliminado de la suma total
    sumas -= round(subtotalProducto);
    igv -= round(subtotalProducto / 100 * impuesto); // Restar el impuesto correspondiente al producto eliminado
    total = round(sumas + igv);

    // Actualizar los campos mostrados
    $('#gross_totals').html(sumas);
    $('#inputGross').val(sumas);
    $('#taxes_total').html(igv);
    $('#inputTaxes').val(igv);
    $('#net_total').html(total);
    $('#inputTotal').val(total);

    // Eliminar el fila de la tabla
    $('#fila' + indice).remove();

    disableButtons();
}


    function cancelarVenta() {
        //Elimar el tbody de la tabla
        $('#tabla_detalle tbody').empty();

        //Añadir una nueva fila a la tabla
        let fila = '<tr>' +
            '<th></th>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '</tr>';
        $('#tabla_detalle').append(fila);

        //Reiniciar valores de las variables
        cont = 0;
        subtotal = [];
        sumas = 0;
        igv = 0;
        total = 0;

        //Mostrar los campos calculados
        $('#gross_totals').html(sumas);
        $('#inputGross').val(sumas);
        $('#taxes_total').html(igv);
        $('#inputTaxes').val(igv);
        $('#net_total').html(total);
        $('#inputTotal').val(total);

        limpiarCampos();
        disableButtons();
    }

    function disableButtons() {
        if (total == 0) {
            $('#guardar').hide();
            $('#cancelar').hide();
        } else {
            $('#guardar').show();
            $('#cancelar').show();
        }
    }

    function limpiarCampos() {
        let select = $('#product_id');
        select.selectpicker('val', '');
        $('#amount').val('');
        $('#selling_price').val('');
        $('#discounts').val('');
        $('#stock').val('');
        $('#tax').val('');
    }

    function showModal(message, icon = 'error') {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: icon,
            title: message
        })
    }

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
    //Fuente: https://es.stackoverflow.com/questions/48958/redondear-a-dos-decimales-cuando-sea-necesario
</script>
@endpush
