@extends('layouts.app')

@section('template_title')
    {{ $subCategory->name ?? "{{ __('Show') Sub Category" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Sub Category</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('sub-categories.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $subCategory->name }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $subCategory->description }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
