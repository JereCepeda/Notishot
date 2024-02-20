@extends('app')
@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Subir nueva Notishot  </div>    
                <div class="card-body">
                    <form action="{{route ('image.Post_create')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">Imagen</label>
                            <div class="col-md-6">
                                <input type="file" id="image_path" name="image_path" class="form-control {{$errors->has('image_path') ? 'is-invalid' : ''}}" required>
                                @if($errors->has('image_path'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('image_path')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="titulo" class="col-md-3 col-form-label text-md-right">Titulo</label>
                            <div class="col-md-6">
                                <input id="title" name="title" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" required>
                                    @if($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$errors->first('title')}}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="descripcion" class="col-md-3 col-form-label text-md-right">Descripcion</label>
                            <div class="col-md-6">
                                <textarea id="descripcion" name="descripcion" class="form-control {{$errors->has('descripcion') ? 'is-invalid' : ''}}" required></textarea>
                                    @if($errors->has('descripcion'))
                                        <span class="invalid-feedvack" role="alert">
                                            <strong>{{$errors->first('descripcion')}}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input type="submit" class="btn btn-primary text-md-right">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
