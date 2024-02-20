@extends('app')
@include('layout/header')
@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Registro de Usuario') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{route('validar-registro')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required autocomplete="disable">
                        </div>
                        <div class="mb-3">
                            <label for="surname" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="surname" name="surname" required autocomplete="disable">
                        </div>
                        <div class="mb-3">
                            <label for="nick" class="form-label">Nick</label>
                            <input type="text" class="form-control" id="nick" name="nick" required autocomplete="disable">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required autocomplete="disable">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required autocomplete="disable">
                        </div>
                        <div class="mb-3">
                            <label for="confpassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confpassword" name="confpassword" required autocomplete="disable">
                        </div>
                        <button type="submit" class="btn btn-primary">Registrarse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection