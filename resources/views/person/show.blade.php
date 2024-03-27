{{--  @extends('layouts.app')

@section('template_title')
    {{ $person->name ?? __('Show') . " " . __('Person') }}
@endsection

@section('content')  --}}
@auth

@include('include.barra', ['modo'=>'Ferreteria la excelencia'])
    <section class="content container-fluid">
        <div class="page-body">
            <div class="container-x1">
                <div class="row row-cards">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-default">
                                <div class="card-header style="display: flex">
                                    <h3 class="card-title">
                                        {{__('Visualización persona')}}
                                    </h3>                                    
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <div class="row row-cards">
                                    {{--  Rol  --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="rol" class="form-label" style="font-weight: bolder">
                                                    {{ __('Tercero') }}  
                                                    <span class="text-info">*</span>                                  
                                                </label>
                                                <input type="text" class="form-control" id="rol" value="{{ $person->rol }}" readonly>                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="rol" class="form-label" style="font-weight: bolder">
                                                    {{ __('Tipo de identificación') }}
                                                    <span class="text-info">*</span>                                      
                                                </label>
                                                <input type="text" class="form-control" id="rol" value="{{ $person->identification_type }}" readonly>                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="rol" class="form-label" style="font-weight: bolder">
                                                    {{ __('Numero de identificación') }}  
                                                    <span class="text-info">*</span>                                    
                                                </label>
                                                <input type="text" class="form-control" id="rol" value="{{ $person->identification_number }}" readonly>                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="rol" class="form-label" style="font-weight: bolder">
                                                    {{ __('Tipo de persona') }}  
                                                    <span class="text-info">*</span>                                    
                                                </label>
                                                <input type="text" class="form-control" id="rol" value="{{ $person->person_type }}" readonly>                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="rol" class="form-label" style="font-weight: bolder">
                                                    {{ __('Razón social') }}  
                                                    <span class="text-info">*</span>                                    
                                                </label>
                                                <input type="text" class="form-control" id="rol" value="{{ $person->company_name }}" readonly>                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="rol" class="form-label" style="font-weight: bolder">
                                                    {{ __('Primer nombre') }} 
                                                    <span class="text-info">*</span>                                     
                                                </label>
                                                <input type="text" class="form-control" id="rol" value="{{$person->first_name }}" readonly>                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="rol" class="form-label" style="font-weight: bolder">
                                                    {{ __('Otro nombre') }}   
                                                    <span class="text-info">*</span>                                   
                                                </label>
                                                <input type="text" class="form-control" id="rol" value="{{$person->other_name }}" readonly>                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="rol" class="form-label" style="font-weight: bolder">
                                                    {{ __('Apellido') }} 
                                                    <span class="text-info">*</span>                                     
                                                </label>
                                                <input type="text" class="form-control" id="rol" value="{{$person->surname}}" readonly>                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="rol" class="form-label" style="font-weight: bolder">
                                                    {{ __('Segundo apellido') }} 
                                                    <span class="text-info">*</span>                                     
                                                </label>
                                                <input type="text" class="form-control" id="rol" value="{{$person->second_surname}}" readonly>                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="rol" class="form-label" style="font-weight: bolder">
                                                    {{ __('DV') }}  
                                                    <span class="text-info">*</span>                                    
                                                </label>
                                                <input type="text" class="form-control" id="rol" value="{{$person->digit_verification}}" readonly>                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="rol" class="form-label" style="font-weight: bolder">
                                                    {{ __('Correo electrónico') }}  
                                                    <span class="text-info">*</span>                                    
                                                </label>
                                                <input type="text" class="form-control" id="rol" value="{{$person->email_address}}" readonly>                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="rol" class="form-label" style="font-weight: bolder">
                                                    {{ __('Ciudad') }} 
                                                    <span class="text-info">*</span>                                     
                                                </label>
                                                <input type="text" class="form-control" id="rol" value="{{$person->city}}" readonly>                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="rol" class="form-label" style="font-weight: bolder">
                                                    {{ __('Dirección') }}
                                                    <span class="text-info">*</span>                                      
                                                </label>
                                                <input type="text" class="form-control" id="rol" value="{{$person->address}}" readonly>                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="rol" class="form-label" style="font-weight: bolder">
                                                    {{ __('Celular') }}  
                                                    <span class="text-info">*</span>                                    
                                                </label>
                                                <input type="text" class="form-control" id="rol" value="{{$person->phone}}" readonly>                                               
                                            </div>
                                        </div>                                   
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="rol" class="form-label" style="font-weight: bolder">
                                                    {{ __('Estado') }}  
                                                    <span class="text-info">*</span>                                    
                                                </label>
                                                <input type="text" class="form-control" id="rol" value="{{$person->status}}" readonly>                                               
                                            </div>
                                        </div>      
                                                        
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
         </div>
    </section>
{{--  @endsection  --}}
<div class="card-footer text-end">
        <a class="btn btn-primary" style="margin-right: 5rem" href="{{ route('person.index') }}">Regresar</a>
</div>
@endauth
@guest
    @include('include.falta_sesion')
@endguest
