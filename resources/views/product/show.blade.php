{{-- @extends('layouts.app')

@section('template_title')
    {{ $producto->name ?? "{{ __('Show') Producto" }}
@endsection

@section('content') --}}
@include('product.barra', ['modo'=>'Productos'])
<body>
    <br>
<div class="container-fluid">
<div class="page-body">
    {{-- <div class="container-xl"> --}}
        <div class="row row-cards">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" style="text-align: center;">
                                    {{ __('imagen Producto') }}
                                </h3>
                            </div>
                            <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                                <tbody>
                                    <tr>
                                        <td><img class="rounded mx-auto d-block"  src="{{ asset('storage'.'/' . $producto->photo) }}"  width="250" height="250" ></td>
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
                                <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                                    <tbody>
                                        <tr>
                                            <td>Nombre</td>
                                            <td>{{ $producto->name_product }}</td>
                                        </tr>
                                        <tr>
                                            <td>Categoria</td>
                                            <td>{{ $producto->categoryProduct->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Descripcion</td>
                                            <td>{{ $producto->description_long }}</td>
                                        </tr>
                                        <tr>
                                            <td>Unidad</td>
                                            <td>{{ $producto->measurementUnit->name }}</td>
                                        </tr>
    
                                        <tr>
                                            <td>Estado</td>
                                            <td>{{ $producto->status }}</td>
                                        </tr>
                                        <tr>
                                            <td>Referencia Fabrica</td>
                                            <td>
                                                {{ $producto->factory_reference }}
                                            </td>
                                        </tr>
    
                                        <tr>
                                            <td>Clasificacion Tributaria</td>
                                            <td>{{ $producto->classification_tax }}</td>
                                        </tr>
                                        <tr>
                                            <td> Marca</td>
                                            <td>{{ $producto->brand->name}}</td>
                                        </tr>
                                        {{-- 
                                        <tr>
                                            <td>Tax Type</td>
                                            <td>{{ $product->tax_type->label() }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Notes') }}</td>
                                            <td>{{ $product->notes }}</td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer text-end">
                                <a class="btn btn-info" href="{{ route('products.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                                    {{ __('Back') }}
                                </a>
                                {{-- <a class="btn btn-warning" href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                                    {{ __('Edit') }}
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    {{-- </div> --}}
</div>
</div>
</body>

