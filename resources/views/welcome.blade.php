@extends('app')
@section('content')

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            @if(session('message'))
                <div class="alert alert-success">
                    {{session ('message')}}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Contenido pagina') }}
                </div>
                <div class="card-body">
                    <div class="card-body">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Aca iria la imagen en una card') }}</label>
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Aca la descripcion dela card') }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection