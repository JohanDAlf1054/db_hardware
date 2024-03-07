@extends('layouts.app')

@section('template_title')
    {{ $measurementUnit->name ?? "{{ __('Show') Measurement Unit" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Measurement Unit</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('measurement-units.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Code:</strong>
                            {{ $measurementUnit->code }}
                        </div>
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $measurementUnit->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
