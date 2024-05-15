@auth
@can('category')

@extends('layouts.app')

@section('template_title')
    {{ $categoryProduct->name ?? __('Show') . " " . __('Category Product') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Category Product</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('category-products.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $categoryProduct->name }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $categoryProduct->description }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@endcan
@endauth
@guest
    @include('include.falta_sesion')
@endguest
