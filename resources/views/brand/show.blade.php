@extends('layouts.app')

@section('template_title')
    {{ $brand->name ?? "{{ __('Show') Brand" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Brand</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('brands.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Abbrevation:</strong>
                            {{ $brand->abbrevation }}
                        </div>
                        <div class="form-group">
                            <strong>Code:</strong>
                            {{ $brand->code }}
                        </div>
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $brand->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
