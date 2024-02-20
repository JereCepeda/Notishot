@extends('app')
@section('content')


<div class="row justify-content-md-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('Configuracion') }}</div>
            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message')}}
                </div>
            @endif
            <div class="card-body">
                <form action="{{route('user.update')}}" enctype="multipart/form-data" method="POST">
                    @csrf

                    <div class="form-group row">
                        <label for="nombre" class="col-sm-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="name" name="name" required value="{{ Auth::user()->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="apellido" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="surname" name="surname" required value="{{ Auth::user()->surname }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" id="email" name="email" required value="{{ Auth::user()->email }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nick" class="col-md-4 col-form-label text-md-right">{{ __('Nick') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="nick" name="nick" required value="{{ Auth::user()->nick }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                        </div>
                        <div class="col-6">
                            @if (Auth::user()->image)
                            <div class="avatar">
                                <img src="{{ route ('user.avatar',['filename'=>Auth::user()->image]) }}" class="avatar"/>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>
                        <div class="col-6">
                            <input type="file" class="form-control" id="image" name="image" value="{{ Auth::user()->image }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Guardar Cambios') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection