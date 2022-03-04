@extends('layouts.nav')
@section('title') Register @stop
@section('style') @parent @stop
@section('body') @parent
@section('menu')  @parent  @stop
@section('contenido')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="color: black;">Registrar Datos</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row tituloLabel">
                            <label for="registerNombre" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input id="registerNombre" type="text" class="form-control @error('registerNombre') is-invalid @enderror" name="registerNombre" value="{{ old('registerNombre') }}" autofocus placeholder="Ingrese su nombre" maxlength="20">

                                @error('registerNombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row tituloLabel">
                            <label for="registerApellido" class="col-md-4 col-form-label text-md-right">Apellido</label>

                            <div class="col-md-6">
                                <input id="registerApellido" type="text" class="form-control @error('registerApellido') is-invalid @enderror" name="registerApellido" value="{{ old('registerApellido') }}" placeholder="Ingrese su apellido" maxlength="40">

                                @error('registerApellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row tituloLabel">
                            <label for="registerDni" class="col-md-4 col-form-label text-md-right">DNI</label>

                            <div class="col-md-6">
                                <input id="registerDni" type="text" class="form-control @error('registerDni') is-invalid @enderror" name="registerDni" value="{{ old('registerDni') }}" placeholder="Ejemplo: 12345678G" maxlength="9">

                                @error('registerDni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row tituloLabel">
                            <label for="registerCorreo" class="col-md-4 col-form-label text-md-right">Correo Electrónico</label>
                            <div class="col-md-6">
                                <input id="registerCorreo" type="email" class="form-control @error('registerCorreo') is-invalid @enderror" name="registerCorreo" value="{{ old('registerCorreo') }}" placeholder="Ingrese un correo con formato valido">

                                @error('registerCorreo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row tituloLabel">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}">
                            </div>
                        </div>
                        <div class="form-group row tituloLabel">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Repetir Contraseña</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" @error('password_confirmation') is-invalid @enderror" name="password_confirmation" onpaste="return false" value="{{ old('password_confirmation') }}">
                            </div>
                        </div>
                        <?php
                            $jsonData = file_get_contents(public_path()."/contryCodePhone.json");
                            $data= json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $jsonData));
                        ?>
                        <div class="form-group row tituloLabel">
                            <label for="registerPais" class="col-md-4 col-form-label text-md-right">Pais</label>
                            <div class="col-md-6">
                                @isset($data)
                                    <select id="registerPais" name="registerPais" class="form-control"">
                                        <option value=null>Sin Asignar</option>
                                        @foreach($data as $datoPais)
                                        <option value="{{$datoPais->nombre}}" {{ (old("registerPais") == $datoPais->nombre ? "selected":"") }}>{{$datoPais->nombre}}</option>
                                        @endforeach
                                    </select>
                                @endisset
                            </div>
                        </div>
                        <div class="form-group row tituloLabel">
                            <label for="registerTelefono" class="col-md-4 col-form-label text-md-right">Teléfono</label>
                            <div class="col-md-6">
                                <input id="registerTelefono" type="text" class="form-control @error('registerTelefono') is-invalid @enderror" name="registerTelefono" value="{{ old('registerTelefono') }}" placeholder="Ej. +593997543714">

                                @error('registerTelefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                        
                        <div class="form-group row tituloLabel">
                            <label for="registerIban" class="col-md-4 col-form-label text-md-right">IBAN</label>
                            <div class="col-md-6">
                                <input id="registerIban" type="text" class="form-control @error('registerIban') is-invalid @enderror" name="registerIban" value="{{ old('registerIban') }}" placeholder="Ej. ES91 2100 0418 45 0200051332" maxlength="28">
                                @error('registerIban')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row tituloLabel">
                            <label for="registerPersonalInfo" class="col-md-4 col-form-label text-md-right">Acerca de ti</label>
                            <div class="col-md-6">
                                <textarea id="registerPersonalInfo" name="registerPersonalInfo" class="form-control" @error('registerPersonalInfo') is-invalid @enderror" placeholder="Introduce una breve descripción de ti">{{old('registerPersonalInfo')}}</textarea>
                                @error('registerPersonalInfo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" class="btn btn-secondary" name="createBtn" value="Registrar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@stop
@section('footer')  @parent @stop
@section('script')  @parent @stop
@stop
