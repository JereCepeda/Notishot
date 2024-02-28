@extends('app')
@section('content')

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            @if(session('message'))
                <div class="alert alert-success">
                    {{session ('message')}}
                </div>
            @endif
            <div class="card pub_image">
                <div class="card-header">
                    @if($imagen->user->image)
                        <div class="container-avatar">
                            <img src="{{route ('user.avatar',['filename'=>$imagen->user->image])}}" class="avatar">
                        </div>
                    @endif
                    <div class="data-user" style="float: left">
                        &nbsp; {{$imagen->user->name.' '.$imagen->user->surname.' | @'.$imagen->user->nick}}
                    </div>
                    @can('publicacion.eliminar')
                        @if($imagen->user->id == Auth::user()->id)
                            <div class="dropstart d-flex justify-content-end">
                                <button class="btn " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Compartir</a></li>
                                    <li><a class="dropdown-item" href="{{ route('image.eliminar',['id'=>$imagen->id])}}">Eliminar</a></li>
                                </ul>
                            </div>
                        @endif
                    @endcan
                </div>
                <div class="card-body">
                    <div class="image-container-detail">
                        <img src="{{ route('image.Get_img',['filename'=>$imagen->image_path])}}">
                    </div>
                    @php
                        $user_like = false;
                        $user =  Auth::user();
                        foreach($imagen->likes as $like){
                            if($user)if($like->user->id ==$user->id){$user_like = true;}
                        }
                    @endphp
                    @if ($user_like)
                    <button type="button" data-env="{{env('APP_URL')}}" data-id="{{ $imagen->id }}" class="btn btn-dislike p-2"><i class="bi bi-heart-fill" style="color:red" ></i></button>
                    @elseif($user && $user->can('publicacion.like'))
                        <button type="button" data-env="{{env('APP_URL')}}" data-id="{{ $imagen->id }}" class="btn btn-like p-2"><i class="bi bi-heart-fill" ></i></button>
                    @else
                        <img src="{{ url(env('APP_URL').'/uploadsimg/public/storage/img/heartgray.png')}}"/>
                    @endif
                    <span class="number_likes">{{count($imagen->likes)}}</span>
                </div>
                <span class="nickname">{{"@".$imagen->user->nick .' | '. \FormatTime::LongTimeFilter($imagen->created_at)}}</span> 
                <p>{{$imagen->description}}</p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="comments">
                        <h2>Comentarios ({{count($imagen->comments)}})</h2>
                        @can('publicacion.comentar')
                        <hr>
                            <form method="POST" action="{{route('comment.store')}}">
                                @csrf
                                <input type="hidden" name="image_id" value="{{$imagen->id}}" />
                                <p>
                                    <textarea name="content" class="form-control {{$errors->has('content') ? 'is-invalid' : ''}}"></textarea>
                                    @if($errors->has('content'))
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        <strong>{{$errors->first('content')}}</strong>
                                    </span>
                                    @endif
                                </p>
                                <button type="submit" class="btn btn-sm btn-primary">Enviar Comentario</button>
                            </form>
                        @endcan
                        @foreach ($imagen->comments->reverse() as $comentario)
                            <hr>
                            <div class="comentario card">
                                <span class="nickname">{{"@".$comentario->user->nick .' | '. \FormatTime::LongTimeFilter($comentario->created_at)}}</span> 
                                <p>{{$comentario->content}}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection