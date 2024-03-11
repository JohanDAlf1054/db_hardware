{{--  @extends('layouts.app')

@section('template_title')
    {{ $person->name ?? __('Show') . " " . __('Person') }}
@endsection

@section('content')  --}}
@auth

@include('include.barra', ['modo'=>'Personas'])
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Personas</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('person.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Tercero:</strong>
                            {{ $person->rol }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo de identificacion:</strong>
                            {{ $person->identification_type }}
                        </div>
                        <div class="form-group">
                            <strong>Numero de identificacion:</strong>
                            {{ $person->identification_number }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo de persona:</strong>
                            {{ $person->person_type }}
                        </div>
                        <div class="form-group">
                            <strong>Razon social:</strong>
                            {{ $person->company_name }}
                        </div>
                        <div class="form-group">
                            <strong>Primer nombre:</strong>
                            {{ $person->first_name }}
                        </div>
                        <div class="form-group">
                            <strong>Otro nombre:</strong>
                            {{ $person->other_name }}
                        </div>
                        <div class="form-group">
                            <strong>Apellido:</strong>
                            {{ $person->surname }}
                        </div>
                        <div class="form-group">
                            <strong>Segundo apellido:</strong>
                            {{ $person->second_surname }}
                        </div>
                        <div class="form-group">
                            <strong>DV:</strong>
                            {{ $person->digit_verification }}
                        </div>
                        <div class="form-group">
                            <strong>Correo electronico:</strong>
                            {{ $person->email_address }}
                        </div>
                        <div class="form-group">
                            <strong>Ciudad:</strong>
                            {{ $person->city }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion:</strong>
                            {{ $person->address }}
                        </div>
                        <div class="form-group">
                            <strong>Celular:</strong>
                            {{ $person->phone }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $person->status }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
{{--  @endsection  --}}
@endauth
@guest
    @include('include.falta_sesion')
@endguest
